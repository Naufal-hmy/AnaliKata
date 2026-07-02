<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Author;
use App\Models\Comment;
use App\Models\CommentSentiment;
use App\Models\Ngram;
use App\Models\Lexicon;
use Carbon\Carbon;

class ImportDataCommand extends Command
{
    protected $signature = 'data:import';
    protected $description = 'Import, clean, and load CSV data into database';

    public function handle()
    {
        $this->info('Starting Data Pipeline...');
        
        $basePath = base_path('dataset');
        
        // Log Before
        $this->info("Counting raw rows before cleaning...");
        $rawCountComments = count(file("$basePath/youtube_comments_with_wordcount.csv")) - 1;
        $rawCountSentiment = count(file("$basePath/sentiment_analysis_final.csv")) - 1;
        $this->info("Raw youtube_comments_with_wordcount.csv: $rawCountComments rows");
        $this->info("Raw sentiment_analysis_final.csv: $rawCountSentiment rows");
        
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        CommentSentiment::truncate();
        Comment::truncate();
        Author::truncate();
        Ngram::truncate();
        Lexicon::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        
        $this->info('Truncated tables.');
        
        // 1. Process Authors and Comments
        $this->info('Extracting & Transforming Comments and Authors...');
        $handle = fopen("$basePath/youtube_comments_with_wordcount.csv", "r");
        fgetcsv($handle); // header
        
        $authorsCache = [];
        $insertedComments = 0;
        $insertedSentiments = 0;
        
        DB::beginTransaction();
        while (($data = fgetcsv($handle)) !== FALSE) {
            // [0] tanggal_baca, [1] clean_author, [2] clean_text, [3] like_count, [4] id, [5] word_count
            if (count($data) < 6) continue;
            
            $published_at = trim($data[0]);
            $authorName = trim($data[1]);
            $content = trim($data[2]);
            $like_count = (int)$data[3];
            $youtube_id = trim($data[4]);
            $word_count = (int)$data[5];
            
            if (empty($youtube_id)) continue;
            
            if (!isset($authorsCache[$authorName])) {
                $author = Author::firstOrCreate(['username' => $authorName]);
                $authorsCache[$authorName] = $author->id;
            }
            
            // Check if comment exists to prevent duplicates
            if (Comment::where('id', $youtube_id)->exists()) continue;
            
            Comment::create([
                'id' => $youtube_id,
                'author_id' => $authorsCache[$authorName],
                'content' => $content,
                'published_at' => Carbon::parse($published_at)->format('Y-m-d H:i:s'),
                'like_count' => $like_count,
                'word_count' => $word_count,
            ]);
            $insertedComments++;
        }
        fclose($handle);
        DB::commit();
        $this->info("Inserted $insertedComments cleaned comments (duplicates/invalid removed).");
        
        // 2. Process Sentiments
        $this->info('Extracting & Transforming Sentiments...');
        $handle = fopen("$basePath/sentiment_analysis_final.csv", "r");
        fgetcsv($handle); // header
        DB::beginTransaction();
        while (($data = fgetcsv($handle)) !== FALSE) {
            // [0] tanggal_baca, [1] id, [2] clean_author, [3] clean_text, [4] score, [5] sentiment
            if (count($data) < 6) continue;
            
            $youtube_id = trim($data[1]);
            $score = (int)$data[4];
            $sentiment_label = trim($data[5]);
            
            if (Comment::where('id', $youtube_id)->exists() && !CommentSentiment::where('comment_id', $youtube_id)->exists()) {
                CommentSentiment::create([
                    'comment_id' => $youtube_id,
                    'score' => $score,
                    'sentiment_label' => $sentiment_label,
                ]);
                $insertedSentiments++;
            }
        }
        fclose($handle);
        DB::commit();
        $this->info("Inserted $insertedSentiments sentiment records.");

        // 3. Process Ngrams (Unigram & Bigram)
        $this->info('Extracting Ngrams...');
        $this->importNgrams("$basePath/unigram_per_date.csv", 'unigram');
        $this->importNgrams("$basePath/bigram_per_date.csv", 'bigram');
        
        // 4. Process Lexicons
        $this->info('Extracting Lexicons...');
        $handle = fopen("$basePath/lexicon_dictionary.csv", "r");
        fgetcsv($handle, 1000, ";"); // header
        DB::beginTransaction();
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            if (count($data) < 3) continue;
            Lexicon::create([
                'word' => trim($data[0]),
                'weight' => (int)$data[2],
            ]);
        }
        fclose($handle);
        DB::commit();

        $this->info("Data Pipeline Finished Successfully!");
        
        // Log After
        $this->info("=== DATA CLEANING LOG (BEFORE VS AFTER) ===");
        $this->info("Rows Before (Comments): $rawCountComments");
        $this->info("Rows After (Comments & Sentiments): " . Comment::count());
    }
    
    private function importNgrams($file, $type)
    {
        $handle = fopen($file, "r");
        fgetcsv($handle); // header
        DB::beginTransaction();
        while (($data = fgetcsv($handle)) !== FALSE) {
            if (count($data) < 3) continue;
            Ngram::create([
                'date' => Carbon::parse(trim($data[0]))->format('Y-m-d'),
                'phrase' => trim($data[1]),
                'frequency' => (int)$data[2],
                'type' => $type,
            ]);
        }
        fclose($handle);
        DB::commit();
    }
}
