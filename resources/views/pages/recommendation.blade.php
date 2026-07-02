@extends('layouts.app')
@section('title', 'Business Recommendation - AnaliKata PRO')

@section('content')
<div class="row g-2 align-items-center mb-4">
  <div class="col">
    <div class="page-pretitle">Tahap Akhir: Actionable Decisions</div>
    <h2 class="page-title">Rekomendasi Bisnis & Strategi Kebijakan</h2>
  </div>
  <div class="col-auto ms-auto d-print-none">
    <button onclick="window.print()" class="btn btn-primary">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
      Cetak Halaman Ini
    </button>
  </div>
</div>

<div class="card mb-4 border-success">
    <div class="card-status-start bg-success"></div>
    <div class="card-body">
        <p>Berdasarkan <strong>Insight Lexicon</strong> yang ditemukan pada halaman sebelumnya (tentang pola sentimen negatif akibat isu tenaga kerja / campur tangan asing), berikut adalah rekomendasi taktis (<i>Data-Driven Recommendations</i>):</p>
        
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <div class="card bg-success-lt h-100">
                    <div class="card-body">
                        <h4 class="card-title">1. Mitigasi Kampanye Negatif (PR Strategy)</h4>
                        <p class="text-secondary">Tingginya frekuensi kata bersentimen -0.8 seperti "asing" menuntut pemerintah atau tim kampanye untuk segera merilis klarifikasi terbuka berbasis data guna meredam kekhawatiran masyarakat soal proteksionisme ekonomi.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card bg-info-lt h-100">
                    <div class="card-body">
                        <h4 class="card-title">2. Counter-Narrative Otomatis (Timing)</h4>
                        <p class="text-secondary">Berdasarkan Line Chart (Tren Waktu), tim analis dapat memantau kapan tepatnya garis sentimen negatif melonjak tinggi. Pada tanggal tersebut, tim Humas harus merespons dengan narasi penyeimbang (<i>Counter-Narrative</i>) pada platform yang sama di jam *Prime Time*.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card bg-warning-lt h-100">
                    <div class="card-body">
                        <h4 class="card-title">3. Upgrade Arsitektur Machine Learning (Iterasi Berikutnya)</h4>
                        <p class="text-secondary">Metode <i>Lexicon (Kamus Dasar)</i> masih memiliki kelemahan: tidak dapat memahami konteks sindiran atau sarkasme ganda. Disarankan untuk memutakhirkan arsitektur <i>Backend</i> ini menggunakan Model <strong>Naive Bayes Classifier</strong> atau <strong>Deep Learning (LSTM / BERT)</strong> agar sistem dapat mengerti konteks kalimat utuh secara sekuensial.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
