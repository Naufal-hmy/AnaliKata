# AnaliKata PRO - Analitik Sentimen Opini Publik

## Summary
AnaliKata PRO adalah aplikasi *dashboard* analitik berbasis web yang berfungsi untuk menambang, membersihkan, dan menganalisis sentimen ribuan opini publik dari YouTube secara otomatis. Aplikasi ini mempermudah pengambil keputusan dalam memetakan gejolak polarisasi sosial secara cepat melalui visualisasi data interaktif.

## Tech Stack / Teknis
* **Bahasa Pemrograman:** PHP (Backend MVC), JavaScript (Frontend DataViz)
* **Framework:** Laravel 11 (Backend), Tabler UI berbasis Bootstrap 5 (Frontend)
* **AI Recommendation & NLP:** Pemrosesan teks (ETL) dan penilaian sentimen menggunakan metode NLP berbasis **Dictionary-Based Lexicon Scoring** (Algoritma *Machine Learning Rules-Based* secara *native*, tanpa memerlukan *API* eksternal seperti OpenAI).
* **Database:** SQLite (Relational Database Serverless yang portabel dan sangat ringan).

## Flow Aplikasi
1. **Data Preparation:** Sistem menerima dataset mentah (berupa file CSV hasil *scraping* YouTube API), kemudian melakukan proses ETL (*Extract, Transform, Load*) untuk membuang data duplikat dan kosong.
2. **NLP Preprocessing:** Teks dibersihkan secara otomatis melalui proses *Case Folding*, *Regex* (pembersihan tanda baca), dan *Stopwords* (penghapusan kata hubung yang tidak bermakna).
3. **Sentiment Scoring & Analysis:** Teks yang telah bersih dicocokkan dengan Kamus Leksikon (*Lexicon Dictionary*) untuk mendapatkan bobot sentimen kata demi kata (Positif, Negatif, atau Netral).
4. **Knowledge Discovery:** Hasil agregasi skor sentimen dikalkulasi ke dalam *dashboard* visual (*Line Chart*, *Donut Chart*, *Bar Chart*, *Word Cloud*) untuk kemudian ditarik *Insight* otomatis dan saran keputusan bisnisnya.

## Cara Menjalankan Aplikasi
Buka Terminal / Command Prompt, arahkan ke dalam folder utama project ini (`analitik_app`), lalu jalankan perintah berikut secara berurutan:

1. Instalasi seluruh *library* dan dependensi PHP:
```bash
composer install
```
2. Buat file environment lokal baru:
```bash
cp .env.example .env
```
*(Bagi pengguna CMD Windows klasik, gunakan perintah: `copy .env.example .env`)*

3. Generate *Application Key* sistem keamanan:
```bash
php artisan key:generate
```
4. Nyalakan server lokal:
```bash
php artisan serve
```
5. Buka aplikasi Anda dengan mengakses alamat ini di *Browser*:
[http://127.0.0.1:8000](http://127.0.0.1:8000)
