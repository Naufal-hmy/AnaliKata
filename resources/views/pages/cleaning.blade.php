@extends('layouts.app')
@section('title', 'Data Cleaning & ETL - AnaliKata PRO')

@section('content')
<div class="row g-2 align-items-center mb-4">
  <div class="col">
    <div class="page-pretitle">Tahap 1: Data Preparation</div>
    <h2 class="page-title">Data Cleaning & Algoritma ETL</h2>
  </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <p>Proses pembersihan (<i>Data Cleaning</i>) berjalan secara asinkron menggunakan arsitektur <strong>ETL (Extract, Transform, Load)</strong> berbasis Laravel Artisan. Skrip otomatis akan menelan CSV kotor, mendeteksi duplikat, membersihkan anomali, dan menyimpannya (Load) ke SQLite.</p>
        
        <div class="row text-center my-5">
            <div class="col-6 border-end position-relative">
                <div class="text-secondary mb-2 text-uppercase font-weight-bold tracking-wide">Data Mentah (Raw Kaggle)</div>
                <h2 class="display-3 text-danger font-weight-bold mb-1">1.616</h2>
                <div class="text-muted">Baris Komentar Kotor</div>
                <span class="badge bg-red-lt mt-3 px-3 py-2">Terindikasi Redudansi / Spam</span>
            </div>
            <div class="col-6">
                <div class="text-secondary mb-2 text-uppercase font-weight-bold tracking-wide">Data Bersih (Database SQL)</div>
                <h2 class="display-3 text-success font-weight-bold mb-1">1.204</h2>
                <div class="text-muted">Baris Unik & Tervalidasi</div>
                <span class="badge bg-green-lt mt-3 px-3 py-2">Siap untuk Machine Learning</span>
            </div>
        </div>

        <h3 class="mb-3">Tabel Before vs After (Sample Data)</h3>
        <div class="table-responsive mb-4 rounded border">
            <table class="table table-vcenter table-bordered mb-0">
                <thead>
                    <tr class="bg-dark text-white">
                        <th class="w-1">Status</th>
                        <th>ID YouTube</th>
                        <th>Teks Komentar</th>
                        <th>Timestamp (Waktu)</th>
                        <th>Keterangan / Aksi Sistem</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Before -->
                    <tr class="table-danger">
                        <td><span class="badge bg-danger">Before</span></td>
                        <td><code>UgzH1V...</code></td>
                        <td><i>Anies selalu di hati</i></td>
                        <td><code>2026-01-25T14:32:00Z</code></td>
                        <td class="text-danger">Baris ini muncul 2x di file CSV akibat <i>Scraping Error</i>. Format waktu ISO tidak terbaca SQL.</td>
                    </tr>
                    <tr class="table-danger">
                        <td><span class="badge bg-danger">Before</span></td>
                        <td><code>UgzH1V...</code></td>
                        <td><i>Anies selalu di hati</i></td>
                        <td><code>2026-01-25T14:32:00Z</code></td>
                        <td class="text-danger">Akan didrop oleh algoritma (Duplicate PK).</td>
                    </tr>
                    <tr class="table-danger">
                        <td><span class="badge bg-danger">Before</span></td>
                        <td><code>NULL</code></td>
                        <td><i>(Kosong)</i></td>
                        <td><code>NULL</code></td>
                        <td class="text-danger">Missing Value (Anomali).</td>
                    </tr>
                    
                    <!-- Divider -->
                    <tr><td colspan="5" class="text-center bg-light text-secondary py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5v14" /><path d="M18 13l-6 6" /><path d="M6 13l6 6" /></svg>
                        <strong>PROSES TRANSFORMASI ETL</strong>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5v14" /><path d="M18 13l-6 6" /><path d="M6 13l6 6" /></svg>
                    </td></tr>

                    <!-- After -->
                    <tr class="table-success">
                        <td><span class="badge bg-success">After</span></td>
                        <td><code>UgzH1V...</code></td>
                        <td><strong>Anies selalu di hati</strong></td>
                        <td><strong>2026-01-25 14:32:00</strong></td>
                        <td class="text-success">Sisa 1 baris unik (Duplikat hilang). Waktu dikonversi ke format <i>Time-Series</i> SQL standar.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="mt-5 mb-3">Arsitektur Pipeline ETL (Kode Sumber PHP)</h3>
        <p class="text-secondary">Berikut adalah <i>logic snippet</i> di balik pembersihan data (File: <code>app/Console/Commands/ImportDataCommand.php</code>):</p>
<pre><code class="language-php">&lt;?php
// EKSTRAKSI (Extract)
$file = fopen(storage_path('app/Dataset_Pilpres.csv'), 'r');

while (($data = fgetcsv($file)) !== false) {
    $youtube_id = trim($data[4]);

    // TRANSFORMASI: 1. Penanganan Missing Value
    if (empty($youtube_id)) continue; // Drop baris kosong

    // TRANSFORMASI: 2. Filter Duplikat (Anti-Spam / Redudansi)
    // Cek apakah ID sudah ada di Database SQLite (O(1) lookup index)
    if (Comment::where('id', $youtube_id)->exists()) {
        continue; // Baris dilewati
    }

    // TRANSFORMASI: 3. Parsing Format Waktu (ISO 8601 -> SQL DateTime)
    $tanggal_bersih = \Carbon\Carbon::parse($published_at)->format('Y-m-d H:i:s');

    // LOAD (Memasukkan ke Data Warehouse)
    Comment::create([
        'id'           => $youtube_id,
        'content'      => $content,
        'published_at' => $tanggal_bersih,
        'like_count'   => (int) $likes,
        'word_count'   => str_word_count($content)
    ]);
}
fclose($file);
?&gt;</code></pre>
    </div>
</div>
@endsection
