@extends('layouts.app')
@section('title', 'Latar Belakang & Problem Statement - AnaliKata PRO')

@section('content')
<div class="row g-2 align-items-center mb-4">
  <div class="col">
    <div class="page-pretitle">Tahap Awal: Project Initiation</div>
    <h2 class="page-title">Latar Belakang & Problem Statement</h2>
  </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h3 class="mb-3">1. Apa masalah yang ingin dianalisis?</h3>
        <p>Di era digital, media sosial seperti YouTube sering kali menjadi medium utama bagi masyarakat (netizen) untuk menyuarakan opini, terutama terkait isu-isu politik yang sensitif seperti Pemilu, masuknya Tenaga Kerja Asing (TKA), atau kebijakan publik lainnya. Namun, <strong>opini ini tersebar secara acak dan sangat tidak terstruktur</strong> di kolom komentar. Masalahnya adalah, sulit untuk menarik kesimpulan yang representatif (apakah sentimen publik positif atau negatif) secara manual karena volume data yang sangat masif (ribuan hingga jutaan komentar per hari).</p>
        
        <h3 class="mt-4 mb-3">2. Kenapa masalah ini penting?</h3>
        <p>Bagi pembuat kebijakan, politisi, atau tim <i>Public Relations</i> (Humas), opini publik adalah metrik krusial. Jika sentimen negatif (seperti kecemasan berlebih terhadap isu proteksionisme/asing) tidak segera terdeteksi dan diatasi, hal itu dapat memicu krisis kepercayaan (*Trust Deficit*) hingga <i>echo chamber</i> misinformasi. Mengubah data teks mentah menjadi wawasan berbasis angka (kuantitatif) sangat penting untuk <strong>mitigasi krisis dan perumusan strategi kampanye yang objektif.</strong></p>

        <h3 class="mt-4 mb-3">3. Siapa yang membutuhkan insight dari analisis ini?</h3>
        <div class="row row-cards mt-2">
            <div class="col-md-4">
                <div class="card bg-primary-lt">
                    <div class="card-body text-center">
                        <div class="h3 mb-1">Pemerintah & Humas</div>
                        <div class="text-secondary">Untuk memantau seberapa efektif komunikasi publik terkait suatu kebijakan dan mendeteksi adanya gejolak sosial (*social unrest*).</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success-lt">
                    <div class="card-body text-center">
                        <div class="h3 mb-1">Tim Kampanye Politik</div>
                        <div class="text-secondary">Untuk mengetahui topik apa (<i>N-Grams</i>) yang paling sensitif bagi pemilih sehingga narasi (*counter-narrative*) dapat disesuaikan.</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning-lt">
                    <div class="card-body text-center">
                        <div class="h3 mb-1">Akademisi & Peneliti</div>
                        <div class="text-secondary">Sebagai studi kasus empiris mengenai pola penyebaran sentimen dan polarisasi di lanskap digital Indonesia.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
