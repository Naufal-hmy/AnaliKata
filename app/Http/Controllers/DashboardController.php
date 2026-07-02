<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentSentiment;
use App\Models\Ngram;
use App\Models\Author;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function applyFilters($query, Request $request, $dateColumn = 'published_at')
    {
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween($dateColumn, [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }
        return $query;
    }

    public function summary(Request $request)
    {
        $query = Comment::query();
        $query = $this->applyFilters($query, $request);
        
        $totalComments = (clone $query)->count();
        $avgLikes = (clone $query)->avg('like_count');
        $maxLikes = (clone $query)->max('like_count');
        $avgWords = (clone $query)->avg('word_count');
        
        return response()->json([
            'total_comments' => $totalComments,
            'avg_likes' => round($avgLikes, 2),
            'max_likes' => $maxLikes,
            'avg_word_count' => round($avgWords, 2)
        ]);
    }

    public function distribution(Request $request)
    {
        $query = Comment::join('comment_sentiments', 'comments.id', '=', 'comment_sentiments.comment_id');
        $query = $this->applyFilters($query, $request, 'comments.published_at');
        
        $distribution = $query->select('sentiment_label', DB::raw('count(*) as count'))
                              ->groupBy('sentiment_label')
                              ->get();
                              
        return response()->json($distribution);
    }

    public function trend(Request $request)
    {
        $query = Comment::join('comment_sentiments', 'comments.id', '=', 'comment_sentiments.comment_id');
        $query = $this->applyFilters($query, $request, 'comments.published_at');
        
        $trend = $query->select(
                            DB::raw('DATE(published_at) as date'),
                            'sentiment_label',
                            DB::raw('count(*) as volume')
                        )
                        ->groupBy('date', 'sentiment_label')
                        ->orderBy('date', 'asc')
                        ->get();
                        
        $grouped = [];
        foreach ($trend as $t) {
            $grouped[$t->date][$t->sentiment_label] = $t->volume;
        }
        
        $result = [];
        foreach ($grouped as $date => $sentiments) {
            $result[] = [
                'date' => $date,
                'Positif' => $sentiments['Positif'] ?? 0,
                'Negatif' => $sentiments['Negatif'] ?? 0,
                'Netral' => $sentiments['Netral'] ?? 0,
                'Total' => array_sum($sentiments)
            ];
        }
        
        return response()->json($result);
    }

    public function wordcloud(Request $request)
    {
        $query = Ngram::where('type', 'unigram');
        
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
        
        $topPhrases = $query->select('phrase', DB::raw('sum(frequency) as total_freq'))
                            ->groupBy('phrase')
                            ->orderByDesc('total_freq')
                            ->limit(40)
                            ->get();
                            
        $formatted = $topPhrases->map(function ($item) {
            return [
                'x' => $item->phrase,
                'value' => $item->total_freq
            ];
        });
        
        return response()->json($formatted);
    }

    public function topCommenter(Request $request)
    {
        $query = Comment::query();
        $query = $this->applyFilters($query, $request);
        
        $topAuthor = $query->select('author_id', DB::raw('count(*) as total_comments'))
                           ->groupBy('author_id')
                           ->orderByDesc('total_comments')
                           ->first();
                           
        if (!$topAuthor) {
            return response()->json(null);
        }
        
        $author = Author::find($topAuthor->author_id);
        
        // Get their top comment by likes
        $topComment = Comment::where('author_id', $topAuthor->author_id)
                             ->orderByDesc('like_count')
                             ->first();
                             
        return response()->json([
            'author' => $author ? $author->username : 'Unknown',
            'total_comments' => $topAuthor->total_comments,
            'top_comment_text' => $topComment ? $topComment->content : '',
            'likes' => $topComment ? $topComment->like_count : 0
        ]);
    }

    public function topPhrasePerDate(Request $request)
    {
        $query = Ngram::where('type', 'unigram');
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
        
        // SQLite doesn't have ROW_NUMBER() over partition if old version, but Laravel 11 uses a modern one.
        // For simplicity and 100% compatibility, we can group by date and find max in PHP or using subquery.
        $ngrams = $query->select('date', 'phrase', DB::raw('sum(frequency) as freq'))
                        ->groupBy('date', 'phrase')
                        ->get();
                        
        $groupedByDate = [];
        foreach ($ngrams as $n) {
            if (!isset($groupedByDate[$n->date]) || $n->freq > $groupedByDate[$n->date]['freq']) {
                $groupedByDate[$n->date] = [
                    'date' => $n->date,
                    'phrase' => $n->phrase,
                    'freq' => $n->freq
                ];
            }
        }
        
        usort($groupedByDate, function($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });
        
        return response()->json(array_values($groupedByDate));
    }
}
