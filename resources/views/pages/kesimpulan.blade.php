@extends('layouts.app')
@section('title', 'Kesimpulan Akhir - AnaliKata PRO')

@section('content')
<div class="row g-2 align-items-center mb-4">
  <div class="col">
    <div class="page-pretitle">Tahap Akhir: Finalisasi Laporan</div>
    <h2 class="page-title">Kesimpulan Project Analitik Data</h2>
  </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h3 class="mb-3">Kesimpulan Eksekutif</h3>
        <p>Berdasarkan seluruh rangkaian proses Analitik Data mulai dari pengumpulan dataset (<i>Scraping</i>), pembersihan ETL (<i>Extract, Transform, Load</i>), Pemrosesan Bahasa Alami (<i>NLP Preprocessing</i>), hingga pemodelan <i>Lexicon Sentiment Analysis</i>, kami dapat menyimpulkan beberapa poin utama:</p>
        
        <ol class="fs-4">
            <li class="mb-3"><strong>Dominasi Sentimen Negatif:</strong> Proporsi sentimen netizen cenderung sangat negatif, hal ini divalidasi oleh tingginya kemunculan frasa bermakna peyoratif. Emosi publik lebih mudah terpancing oleh isu sentimen dibandingkan narasi prestasi.</li>
            <li class="mb-3"><strong>Akurasi Algoritma NLP:</strong> Pendekatan menggunakan <i>Lexicon-Based Dictionary</i> terbukti mampu menangani klasifikasi teks dalam skala besar secara <i>real-time</i> (Asynchronous Processing). Teks yang awalnya kotor sukses dibersihkan melalui tahapan <i>Case Folding, Stopword Removal</i>, dan <i>Regex</i>.</li>
            <li class="mb-3"><strong>Validitas Outlier (Efek Viralitas):</strong> Dalam tahap Exploratory Data Analysis (EDA), terbukti bahwa distribusi interaksi <i>Likes</i> tidak merata. Adanya komentar ekstrem yang menembus batas kuartil atas (Outlier) membuktikan keberadaan "Buzzer" atau efek <i>echo chamber</i> yang mengorkestrasi opini massa.</li>
            <li class="mb-3"><strong>Pencapaian Tujuan (Problem Solved):</strong> Dashboard visualisasi interaktif (Bar Chart, Line Chart, Pie Chart, dan Word Cloud) ini secara sukses memecahkan *Problem Statement* awal, yaitu memberikan instrumen analitik kuantitatif yang solid bagi para pengambil kebijakan (Pemerintah/Humas) untuk mendeteksi gejolak opini secara objektif.</li>
        </ol>

        <div class="alert alert-info mt-4" role="alert">
            <h4 class="alert-title">🎯 Penutup</h4>
            <div class="text-secondary">Project ini secara utuh telah mendemonstrasikan implementasi nyata dari konsep <strong>Data Mining dan Analitik Visual</strong>. Dimulai dari hulu (Data Mentah) hingga ke hilir (<i>Actionable Insight</i>), arsitektur ini siap untuk diekstensi lebih jauh menggunakan algoritma Deep Learning pada iterasi pengembangan di masa depan.</div>
        </div>
    </div>
</div>
@endsection
