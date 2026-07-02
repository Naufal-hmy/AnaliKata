<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Proses ETL & Data Cleaning - AnaliKata</title>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
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
                <h2 class="page-title">Dokumentasi: Proses Data Cleaning & Algoritma ETL</h2>
              </div>
            </div>
          </div>
        </div>
        
        <div class="page-body">
          <div class="container-xl">
            
            <div class="row g-4">
              <!-- Before vs After Data -->
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Kondisi Data: Sebelum vs Sesudah Cleaning (Before vs After)</h3>
                  </div>
                  <div class="card-body">
                    <div class="row text-center mb-4">
                        <div class="col-6 border-end">
                            <div class="text-secondary mb-2">Sebelum Cleaning (Raw CSV Kaggle)</div>
                            <h2 class="display-5 text-danger">1.616 Baris</h2>
                            <p>Terdapat duplikasi (Scraping berulang) & Format Tanggal Tidak Konsisten</p>
                        </div>
                        <div class="col-6">
                            <div class="text-secondary mb-2">Sesudah Cleaning (Database SQLite)</div>
                            <h2 class="display-5 text-success">1.204 Baris</h2>
                            <p>Duplikat dihapus, Nilai Kosong didrop, Tanggal dikonversi ke DateTime</p>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-vcenter table-bordered">
                            <thead>
                                <tr class="bg-light">
                                    <th>Status</th>
                                    <th>ID YouTube</th>
                                    <th>Komentar</th>
                                    <th>Tanggal</th>
                                    <th>Masalah yang Diperbaiki</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Before -->
                                <tr class="table-danger">
                                    <td><span class="badge bg-danger">Before (Duplikat)</span></td>
                                    <td><code>UgzH1V...</code></td>
                                    <td>Anies selalu di hati</td>
                                    <td>2026-01-25T14:32:00Z</td>
                                    <td>Baris ini muncul 2x di dataset mentah akibat <i>Scraping Error</i>.</td>
                                </tr>
                                <tr class="table-danger">
                                    <td><span class="badge bg-danger">Before (Duplikat)</span></td>
                                    <td><code>UgzH1V...</code></td>
                                    <td>Anies selalu di hati</td>
                                    <td>2026-01-25T14:32:00Z</td>
                                    <td>Akan didrop oleh algoritma karena ID sudah terdaftar.</td>
                                </tr>
                                <tr class="table-danger">
                                    <td><span class="badge bg-danger">Before (Format)</span></td>
                                    <td><code>UgyK9...</code></td>
                                    <td>Prabowo mantap</td>
                                    <td>25/01/2026</td>
                                    <td>Format tanggal string yang berantakan tidak bisa diolah *Time-Series*.</td>
                                </tr>
                                
                                <!-- After -->
                                <tr class="table-success mt-4">
                                    <td><span class="badge bg-success">After (Bersih)</span></td>
                                    <td><code>UgzH1V...</code></td>
                                    <td>Anies selalu di hati</td>
                                    <td>2026-01-25 14:32:00</td>
                                    <td>Sisa 1 baris unik. Tanggal sukses dikonversi ke format standar SQL.</td>
                                </tr>
                                <tr class="table-success">
                                    <td><span class="badge bg-success">After (Bersih)</span></td>
                                    <td><code>UgyK9...</code></td>
                                    <td>Prabowo mantap</td>
                                    <td>2026-01-25 00:00:00</td>
                                    <td>Tanggal telah dibakukan (*Time-Series Ready*).</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Kode Snippet -->
              <div class="col-lg-12">
                <div class="card card-lg">
                  <div class="card-body markdown">
                    <h2>Snippets Algoritma ETL (PHP / Laravel)</h2>
                    <p>
                        Proses <i>Data Cleaning</i> dilakukan menggunakan perintah konsol <code>php artisan data:import</code> yang mengeksekusi file <code>ImportDataCommand.php</code>. Algoritma ini berjalan secara otomatis untuk mendeteksi missing value, menghilangkan data duplikat berdasarkan ID unik, dan memodifikasi format waktu.
                    </p>
                    
<pre><code class="language-php">// File: app/Console/Commands/ImportDataCommand.php

// 1. Identifikasi Missing Value (Data Kosong)
$youtube_id = trim($data[4]);
if (empty($youtube_id)) continue; // Drop baris jika ID kosong

// 2. Filter Data Duplikat (Spam / Double Count)
// Mengecek apakah ID Komentar sudah pernah dimasukkan ke dalam Database
if (Comment::where('id', $youtube_id)->exists()) {
    continue; // Jika ada, abaikan (buang) baris CSV ini
}

// 3. Transformasi Data (Format Tanggal & Resolusi Relasi)
// Mengubah string tanggal berantakan menjadi format DateTime baku (Y-m-d H:i:s)
$tanggal_bersih = Carbon::parse($published_at)->format('Y-m-d H:i:s');

// 4. Load ke Database (Menyimpan Data Bersih)
Comment::create([
    'id' => $youtube_id,
    'author_id' => $authorsCache[$authorName], // Normalisasi Relasi Penulis
    'content' => $content,
    'published_at' => $tanggal_bersih,
    'like_count' => $like_count,
    'word_count' => $word_count,
]);</code></pre>
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
