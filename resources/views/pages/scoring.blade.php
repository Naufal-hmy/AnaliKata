@extends('layouts.app')
@section('title', 'Lexicon Sentiment Scoring - AnaliKata PRO')

@section('content')
<div class="row g-2 align-items-center mb-4">
  <div class="col">
    <div class="page-pretitle">Tahap 3: Analisis & Modeling</div>
    <h2 class="page-title">Lexicon Sentiment Scoring (Pemberian Bobot)</h2>
  </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <p>Setelah teks dibersihkan oleh algoritma NLP, sistem menggunakan metode <strong>Dictionary-Based NLP (Lexicon)</strong>. Algoritma akan mencari kata-kata hasil NLP di dalam database Kamus Sentimen, lalu memberikan skor matematika kepadanya.</p>
        
        <div class="row text-center my-4">
            <div class="col-4">
                <div class="h1 text-success mb-1">+1 hingga +5</div>
                <div class="text-secondary">Indikasi Sentimen Positif</div>
            </div>
            <div class="col-4 border-start border-end">
                <div class="h1 text-muted mb-1">0</div>
                <div class="text-secondary">Kata Netral / Tidak Dikenali</div>
            </div>
            <div class="col-4">
                <div class="h1 text-danger mb-1">-1 hingga -5</div>
                <div class="text-secondary">Indikasi Sentimen Negatif</div>
            </div>
        </div>

        <h3 class="mt-5 mb-3">Tabel Before vs After (Proses Scoring Sentimen)</h3>
        <div class="table-responsive mb-4 rounded border">
            <table class="table table-vcenter table-bordered mb-0">
                <thead>
                    <tr class="bg-dark text-white">
                        <th class="w-1">Status</th>
                        <th>Potongan Kata (Unigram)</th>
                        <th>Bobot Lexicon</th>
                        <th>Klasifikasi Warna Bar/Chart</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-secondary">Before</span></td>
                        <td><strong>"asing"</strong></td>
                        <td><i>(Belum dinilai)</i></td>
                        <td>Oren Tua (Netral)</td>
                    </tr>
                    <tr class="bg-red-lt">
                        <td><span class="badge bg-danger">After Algoritma</span></td>
                        <td><strong>"asing"</strong></td>
                        <td><strong class="text-danger">-3.5</strong></td>
                        <td><span class="badge bg-danger">Merah (Negatif)</span></td>
                    </tr>
                    <tr><td colspan="4"></td></tr>
                    <tr>
                        <td><span class="badge bg-secondary">Before</span></td>
                        <td><strong>"dukung"</strong></td>
                        <td><i>(Belum dinilai)</i></td>
                        <td>Oren Tua (Netral)</td>
                    </tr>
                    <tr class="bg-green-lt">
                        <td><span class="badge bg-success">After Algoritma</span></td>
                        <td><strong>"dukung"</strong></td>
                        <td><strong class="text-success">+4.2</strong></td>
                        <td><span class="badge bg-success">Hijau (Positif)</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="mt-5 mb-3">Kode Sumber Algoritma Lexicon Scoring (PHP)</h3>
        <p class="text-secondary">Berikut adalah <i>logic snippet</i> (File: <code>app/Services/LexiconScorer.php</code>):</p>
<pre><code class="language-php">&lt;?php
namespace App\Services;
use App\Models\Lexicon;

class LexiconScorer {
    
    public function calculateScore(array $cleanWords) {
        $totalScore = 0;
        $wordScores = [];

        // Lakukan iterasi pada setiap kata hasil NLP
        foreach ($cleanWords as $word) {
            // Pencarian O(1) atau Indexing Database
            $lexicon = Lexicon::where('word', $word)->first();
            
            if ($lexicon) {
                $totalScore += $lexicon->weight;
                $wordScores[$word] = $lexicon->weight;
            } else {
                $wordScores[$word] = 0; // Kata OOV (Out of Vocabulary) = Netral
            }
        }

        // Tentukan sentimen akhir untuk keseluruhan kalimat
        $finalSentiment = 'Netral';
        if ($totalScore > 0) $finalSentiment = 'Positif';
        if ($totalScore < 0) $finalSentiment = 'Negatif';

        return [
            'total_score' => $totalScore,
            'sentiment' => $finalSentiment,
            'details' => $wordScores
        ];
    }
}
?&gt;</code></pre>
    </div>
</div>
@endsection
