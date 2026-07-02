@extends('layouts.app')
@section('title', 'Insights & Output - AnaliKata PRO')

@section('content')
<div class="row g-2 align-items-center mb-4">
  <div class="col">
    <div class="page-pretitle">Tahap Akhir: Knowledge Discovery</div>
    <h2 class="page-title">Insight Otomatis & Rekomendasi ML</h2>
  </div>
</div>

<div class="card mb-4 border-warning">
    <div class="card-status-start bg-warning"></div>
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <span class="bg-warning text-white avatar me-3"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg></span>
            <h3 class="m-0">Insight Ekstraktif (Data Driven)</h3>
        </div>
        
        <p><strong>Bagaimana cara mendapatkan insight ini?</strong><br>
        Insight bukan berasal dari opini subjektif, melainkan dari <strong>Algoritma Machine Learning (Lexicon Mapping)</strong>. Kami menanamkan kamus bobot sentimen (*Dictionary Based NLP*) ke dalam arsitektur Backend. Algoritma ini akan membaca setiap <i>N-Grams</i> (potongan kata) terbanyak, lalu mewarnainya (Merah/Hijau/Netral) berdasarkan kedekatan semantiknya secara matematis.</p>

        <div class="alert alert-danger" role="alert">
            <h4 class="alert-title">🔥 Pola Xenofobia / Proteksionisme Terdeteksi!</h4>
            <div class="text-secondary">Dari hasil *Word Cloud* dan *Bar Chart*, frekuensi kemunculan kata <strong>"asing"</strong> dan <strong>"antek"</strong> mendominasi peringkat teratas secara absolut. Sistem NLP kami memetakan kata tersebut dengan warna <strong>Merah (Sentimen Negatif -0.8 Bobot)</strong>. Hal ini membuktikan tingginya tingkat kecemasan (*anxiety*) publik terhadap campur tangan asing atau isu TKA dalam diskursus politik YouTube.</div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h3 class="mb-3">Logika Klasifikasi Sentimen (PHP NLP Lexicon)</h3>
        <p class="text-secondary">Berikut adalah <i>logic snippet</i> di balik otomatisasi penemuan insight tersebut (File: <code>DashboardController.php</code>):</p>
<pre><code class="language-php">&lt;?php
// 1. Ekstraksi Top N-Grams (Kata Terbanyak) via SQL
$topPhrases = DB::table('ngrams')
    ->select('phrase', DB::raw('SUM(frequency) as total_freq'))
    ->groupBy('phrase')
    ->orderByDesc('total_freq')
    ->take(40)->get();

// 2. Lexicon Mapping (Mencocokkan kata dengan Kamus Data Leksikon)
$lexicons = Lexicon::whereIn('word', $topPhrases->pluck('phrase'))->get()->keyBy('word');

// 3. Machine Learning (Rules-Based Classification)
$visualData = $topPhrases->map(function ($item) use ($lexicons) {
    $color = '#6c7a91'; // Default: Netral (Abu-abu)
    
    if (isset($lexicons[$item->phrase])) {
        $weight = $lexicons[$item->phrase]->weight;
        
        // Klasifikasi Semantik berdasar batas threshold (0.0)
        if ($weight > 0.0) $color = '#2fb344'; // Positif -> Hijau
        if ($weight < 0.0) $color = '#d63939'; // Negatif -> Merah
    }
    
    // Output JSON untuk digambar oleh library AnyChart Tag Cloud
    return [
        'x' => $item->phrase, 
        'value' => $item->total_freq, 
        'normal' => ['fill' => $color] 
    ];
});
?&gt;</code></pre>
    </div>
</div>

<div class="card mb-4 border-success">
    <div class="card-status-start bg-success"></div>
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <span class="bg-success text-white avatar me-3"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 11v11" /><path d="M8 14.5l4 -2.5l4 2.5" /><path d="M12 2l-3 5h6z" /></svg></span>
            <h3 class="m-0">Rekomendasi Bisnis & Kebijakan</h3>
        </div>
        <ul>
            <li class="mb-2"><strong>Mitigasi Kampanye Negatif:</strong> Tingginya frekuensi kata "asing" menuntut pemerintah atau tim Humas untuk segera merilis klarifikasi terbuka berbasis data guna meredam kekhawatiran masyarakat soal proteksionisme ekonomi.</li>
            <li class="mb-2"><strong>Counter-Narrative Otomatis:</strong> Berdasarkan Line Chart (Tren Waktu), tim analis kampanye dapat memantau kapan hari di mana garis sentimen negatif melonjak tinggi. Pada tanggal tersebut, tim harus membanjiri sosial media dengan narasi penyeimbang (*Counter-Narrative*).</li>
            <li><strong>Pengembangan Machine Learning Lanjutan:</strong> Metode Leksikon masih kaku (tidak paham konteks sindiran/sarkasme). Disarankan untuk meng-<i>upgrade</i> model ini menggunakan <strong>Klasifikasi Naive Bayes</strong> atau <strong>Deep Learning (LSTM/Transformer)</strong> di iterasi <i>sprint</i> berikutnya.</li>
        </ul>
    </div>
</div>
@endsection
