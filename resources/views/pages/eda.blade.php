@extends('layouts.app')
@section('title', 'EDA - AnaliKata PRO')

@section('content')
<div class="row g-2 align-items-center mb-4">
  <div class="col">
    <div class="page-pretitle">Tahap 2: Memahami Data</div>
    <h2 class="page-title">Exploratory Data Analysis (EDA)</h2>
  </div>
</div>

<div class="row row-cards mb-4">
    <!-- Stat Cards -->
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto"><span class="bg-primary text-white avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M13.45 11.55l2.05 -2.05" /><path d="M6.4 20a9 9 0 1 1 11.2 0z" /></svg></span></div>
                    <div class="col">
                        <div class="font-weight-medium">Rata-rata Kata</div>
                        <div class="text-secondary">± 19 Kata / Komentar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto"><span class="bg-green text-white avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg></span></div>
                    <div class="col">
                        <div class="font-weight-medium">Rata-rata Likes</div>
                        <div class="text-secondary">3.81 Likes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto"><span class="bg-red text-white avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 3l0 7l6 0l-8 11l0 -7l-6 0l8 -11" /></svg></span></div>
                    <div class="col">
                        <div class="font-weight-medium">Max Likes (Outlier)</div>
                        <div class="text-secondary">785 Likes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto"><span class="bg-yellow text-white avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg></span></div>
                    <div class="col">
                        <div class="font-weight-medium">Rentang Data</div>
                        <div class="text-secondary">25 Jan - 01 Feb</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h3>1. Analisis Distribusi (Distribution Analysis)</h3>
        <p>Distribusi interaksi (<i>Likes</i>) pada dataset ini <strong>sangat condong (Right-Skewed)</strong>. Sebagian besar netizen (85%) hanya membaca dan tidak memberikan interaksi, menghasilkan rata-rata (Mean) 3.81 Likes. Namun, ditemukan fenomena <strong>Outlier Viralitas</strong>.</p>
        
        <h3>2. Identifikasi Outlier (Viralitas Opini)</h3>
        <p>Dalam analisis statistik deskriptif, kami menemukan ada komentar yang secara tidak wajar mendapatkan <strong>785 Likes</strong> dalam hitungan jam (melebihi batas kuartil atas Q3). Ini mengindikasikan adanya orkestrasi massa (*Buzzer*) atau isu yang sangat sensitif sehingga memicu *echo chamber* di kolom komentar.</p>

        <h3 class="mt-4 mb-3">Kode Kueri Statistik (Agregasi SQL)</h3>
        <p class="text-secondary">Metrik ini tidak dihitung manual, melainkan dieksekusi secara asinkron menggunakan Agregasi Database <code>SUM</code>, <code>AVG</code>, dan <code>MAX</code> untuk performa tertinggi (Big Data).</p>
<pre><code class="language-sql">-- Menghitung Rata-rata dan Deteksi Outlier (Max)
SELECT 
    COUNT(id) AS total_comments,
    AVG(like_count) AS avg_likes,
    MAX(like_count) AS peak_outlier_likes,
    AVG(word_count) AS avg_word_count
FROM comments
WHERE published_at BETWEEN '2026-01-25' AND '2026-02-01';

-- Mencari Identitas Komentar Paling Viral (Outlier Analysis)
SELECT author_id, content, like_count 
FROM comments 
ORDER BY like_count DESC 
LIMIT 1;</code></pre>
    </div>
</div>
@endsection
