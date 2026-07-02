@extends('layouts.app')
@section('title', 'Sumber Dataset - AnaliKata PRO')

@section('content')
<div class="row g-2 align-items-center mb-4">
  <div class="col">
    <div class="page-pretitle">Tahap 0: Data Sourcing</div>
    <h2 class="page-title">Sumber Dataset & Karakteristik Data</h2>
  </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="row align-items-center mb-4">
            <div class="col-auto">
                <span class="bg-dark text-white avatar avatar-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-16z" /><path d="M12 4v7l-2 -2l-2 2v-7" /></svg>
                </span>
            </div>
            <div class="col">
                <h3 class="mb-1">Platform Data Science Terbuka (Kaggle)</h3>
                <div class="text-secondary">Data mentah didapatkan melalui metode <i>Web Scraping</i> dari YouTube API yang telah dipublikasikan di platform Kaggle.</div>
            </div>
        </div>

        <h3 class="mt-4">Metadata Dataset Mentah (Raw)</h3>
        <table class="table table-bordered">
            <tr>
                <th width="30%" class="bg-light">Jumlah Baris Mentah (Raw)</th>
                <td><span class="badge bg-red text-red-fg">1.616 Baris</span> (Memenuhi kualifikasi minimal 500 baris)</td>
            </tr>
            <tr>
                <th class="bg-light">Format Berkas</th>
                <td>Comma Separated Values (.CSV)</td>
            </tr>
            <tr>
                <th class="bg-light">Rentang Waktu Scraping</th>
                <td>25 Januari 2026 - 1 Februari 2026</td>
            </tr>
        </table>

        <h3 class="mt-5 mb-3">Deskripsi Kolom Database (Data Dictionary)</h3>
        <p>Sebelum diproses, struktur data mentah dikonversi menjadi Skema Relasional (SQL) untuk keperluan analitik. Berikut adalah penjabaran fiturnya:</p>
        <div class="table-responsive">
            <table class="table table-vcenter table-bordered text-nowrap">
                <thead>
                    <tr class="bg-dark text-white">
                        <th>Nama Kolom</th>
                        <th>Tipe Data (SQL)</th>
                        <th>Deskripsi Fungsional</th>
                        <th>Contoh Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>id</code></td>
                        <td><span class="badge bg-primary-lt">VARCHAR(255)</span></td>
                        <td>Primary Key. Identifier unik dari YouTube API untuk mencegah duplikasi komentar.</td>
                        <td class="text-secondary">UgzH1Vf5...</td>
                    </tr>
                    <tr>
                        <td><code>author_name</code></td>
                        <td><span class="badge bg-primary-lt">VARCHAR(100)</span></td>
                        <td>Nama channel pengguna (Anonimitas dijaga dalam agregasi).</td>
                        <td class="text-secondary">UserPolitik123</td>
                    </tr>
                    <tr>
                        <td><code>content</code></td>
                        <td><span class="badge bg-warning-lt">TEXT</span></td>
                        <td>Isi teks komentar mentah yang ditulis oleh netizen. Membutuhkan NLP.</td>
                        <td class="text-secondary">Ini adalah opini saya!!!</td>
                    </tr>
                    <tr>
                        <td><code>published_at</code></td>
                        <td><span class="badge bg-success-lt">DATETIME</span></td>
                        <td>Waktu spesifik publikasi komentar. Digunakan untuk Time-Series Line Chart.</td>
                        <td class="text-secondary">2026-01-25 14:32:00</td>
                    </tr>
                    <tr>
                        <td><code>like_count</code></td>
                        <td><span class="badge bg-info-lt">INTEGER</span></td>
                        <td>Jumlah impresi positif dari pengguna lain terhadap komentar tersebut.</td>
                        <td class="text-secondary">45</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
