<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Dokumentasi & Demo Guide - AnaliKata</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root { --tblr-font-sans-serif: 'Inter Var', sans-serif; }
      body { font-feature-settings: "cv03", "cv04", "cv11"; }
      .icon { width: 24px; height: 24px; stroke-width: 2; stroke: currentColor; fill: none; stroke-linecap: round; stroke-linejoin: round; }
    </style>
  </head>
  <body class="layout-fluid">
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-tabler text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l3 3l-3 3" /><line x1="13" y1="15" x2="16" y2="15" /><rect x="4" y="4" width="16" height="16" rx="4" /></svg>
              AnaliKata
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <a href="/" class="btn btn-outline-primary">
                Kembali ke Dashboard
              </a>
            </div>
          </div>
        </div>
      </header>

      <div class="page-wrapper">
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">Panduan Presentasi & Dokumentasi Kode</h2>
              </div>
            </div>
          </div>
        </div>
        
        <div class="page-body">
          <div class="container-xl">
            <div class="row g-4">
              
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body markdown">
                    <h2>Logika Algoritma ETL (Extract, Transform, Load)</h2>
                    <p>
                        Aplikasi ini tidak menggunakan script Python terpisah untuk <i>Data Cleaning</i> demi menjaga arsitektur <b>Monolithic</b>.
                        Semua pemrosesan data dilakukan murni menggunakan PHP (Laravel Artisan Command) agar bisa langsung terhubung dengan ORM (Object Relational Mapping) dan SQLite.
                    </p>
                    
                    <h4>1. Filter Duplikat & Penanganan Data Kotor</h4>
                    <p>
                        Saat data diimpor dari file CSV Kaggle, algoritma akan memverifikasi setiap <code>youtube_id</code> untuk mencegah adanya duplikasi komentar (Spam). Jika terdeteksi ID yang sama, baris tersebut akan dibuang secara otomatis (<i>continue</i>).
                    </p>
<pre><code class="language-php">// File: app/Console/Commands/ImportDataCommand.php
// Lokasi: Baris 60 - 80

$youtube_id = trim($data[4]);
$word_count = (int)$data[5];

if (empty($youtube_id)) continue; // Buang data kosong

// Algoritma Pengecekan Duplikat (Spam Filter)
if (Comment::where('id', $youtube_id)->exists()) {
    continue; // Tolak dan lompat ke baris berikutnya
}

// Transform & Load ke Database
Comment::create([
    'id' => $youtube_id,
    'author_id' => $authorsCache[$authorName],
    'content' => $content,
    'published_at' => Carbon::parse($published_at)->format('Y-m-d H:i:s'),
    'like_count' => $like_count,
    'word_count' => $word_count,
]);</code></pre>

                    <h4>2. Logika Pembuatan Word Cloud & Proporsi Warna (Semantic)</h4>
                    <p>
                        Grafik <b>Word Cloud</b> dan <b>Bar Chart</b> di Dashboard tidak hanya menampilkan kata teratas (agregasi <code>SUM</code> & <code>GROUP BY</code>), namun warnanya juga dikalkulasi dari tabel leksikon sentimen.
                    </p>
<pre><code class="language-php">// File: app/Http/Controllers/DashboardController.php

// Algoritma Pencocokan Kamus (Lexicon Mapping)
$phrasesArray = $topPhrases->pluck('phrase')->toArray();
$lexicons = \App\Models\Lexicon::whereIn('word', $phrasesArray)->get()->keyBy('word');

$formatted = $topPhrases->map(function ($item) use ($lexicons) {
    $color = '#6c7a91'; // default grey
    if (isset($lexicons[$item->phrase])) {
        $weight = $lexicons[$item->phrase]->weight;
        if ($weight > 0) {
            $color = '#2fb344'; // Hijau (Positif)
        } elseif ($weight < 0) {
            $color = '#d63939'; // Merah (Negatif)
        } else {
            $color = '#f59f00'; // Oranye (Netral)
        }
    }
    return [
        'x' => $item->phrase,
        'value' => $item->total_freq,
        'normal' => ['fill' => $color]
    ];
});</code></pre>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Antisipasi Pertanyaan Dosen</h3>
                  </div>
                  <div class="card-body">
                    <div class="mb-4">
                        <h4>Q: Pakai algoritma apa untuk Data Cleaning? Python?</h4>
                        <p class="text-secondary text-sm">A: "Tidak, Pak/Bu. Saya menggunakan Algoritma <b>ETL Pipeline</b> berbasis PHP. Alasannya adalah efisiensi arsitektur. Daripada membuat script Python terpisah, saya menanamkannya langsung ke Backend agar bisa berkomunikasi dan menyimpan data ke dalam Database SQLite dengan seketika."</p>
                    </div>
                    <div class="mb-4">
                        <h4>Q: Di mana tabel database-nya?</h4>
                        <p class="text-secondary text-sm">A: "Skema relasinya bisa dilihat di folder <code>database/migrations/</code>, sedangkan isi data bersihnya tersimpan persis di <code>database/database.sqlite</code>."</p>
                    </div>
                    <div class="mb-0">
                        <h4>Q: Kenapa jumlah datanya berkurang setelah di-cleaning?</h4>
                        <p class="text-secondary text-sm">A: "Pengurangan data (dari 1616 menjadi 1204) murni karena penghapusan Duplikasi Baris (Data kotor dari proses Scraping Kaggle). Jika saya biarkan, 1 opini bisa memiliki bobot berlipat ganda dan merusak validitas agregasi NLP kita."</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
  </body>
</html>
