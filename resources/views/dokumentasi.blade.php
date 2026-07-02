<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Laporan Project Akhir - AnaliKata</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root { --tblr-font-sans-serif: 'Inter Var', sans-serif; }
      body { font-feature-settings: "cv03", "cv04", "cv11"; background-color: #f4f6fa; }
      .icon { width: 24px; height: 24px; stroke-width: 2; stroke: currentColor; fill: none; stroke-linecap: round; stroke-linejoin: round; }
      .report-section { margin-bottom: 2rem; }
      .section-title { border-bottom: 2px solid #206bc4; padding-bottom: 0.5rem; margin-bottom: 1.5rem; color: #206bc4; }
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
      </header>

      <div class="page-wrapper">
        <div class="page-header d-print-none">
          <div class="container-xl text-center">
            <h1 class="page-title justify-content-center" style="font-size: 2rem;">LAPORAN PROJECT BESAR</h1>
            <h2 class="text-secondary mt-2">Analitik dan Visualisasi Data Sentimen Opini Publik di YouTube</h2>
          </div>
        </div>
        
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="card-body">
                
                <!-- 1. Latar Belakang -->
                <div class="report-section">
                    <h2 class="section-title">1. Latar Belakang & Problem Statement</h2>
                    <p>Di era digital, platform YouTube menjadi salah satu media utama penyebaran informasi dan diskursus publik, termasuk dalam ranah politik dan kebijakan negara. Tingginya volume komentar sering kali memicu polarisasi opini dan misinformasi. Membaca ribuan komentar secara manual untuk mengetahui arah opini publik adalah hal yang mustahil, sehingga diperlukan pendekatan komputasional.</p>
                    <ul>
                        <li><strong>Apa masalah yang ingin dianalisis?</strong> Masalah utamanya adalah bagaimana mengolah dan memetakan arah sentimen publik (Positif, Negatif, Netral) serta mengidentifikasi narasi dominan (Trending Topic) dari data komentar YouTube yang berserakan (tidak terstruktur).</li>
                        <li><strong>Kenapa masalah ini penting?</strong> Mengukur sentimen publik secara akurat sangat penting untuk meredam hoaks, memitigasi polarisasi ekstrem, serta memahami kekhawatiran masyarakat di akar rumput.</li>
                        <li><strong>Siapa yang membutuhkan insight ini?</strong> Insight ini sangat krusial bagi analis kebijakan, tim kampanye politik, instansi humas pemerintah, serta jurnalis data.</li>
                    </ul>
                </div>

                <!-- 2. Dataset -->
                <div class="report-section">
                    <h2 class="section-title">2. Dataset yang Digunakan</h2>
                    <ul>
                        <li><strong>Sumber Data:</strong> Platform Data Science Terbuka (Kaggle).</li>
                        <li><strong>Jumlah Data:</strong> 1.616 baris sebelum pembersihan, 1.204 baris setelah pembersihan (Sesuai syarat minimal &gt; 500 baris).</li>
                        <li><strong>Deskripsi Kolom:</strong>
                            <ul>
                                <li><code>id</code>: Identifier unik untuk setiap komentar.</li>
                                <li><code>clean_author</code>: Nama pengguna (akun) anonim yang memposting komentar.</li>
                                <li><code>clean_text</code>: Teks komentar yang sudah melalui <i>case folding</i> dan penghapusan <i>stopword</i>.</li>
                                <li><code>published_at</code>: Timestamp (waktu) ketika komentar dipublikasikan.</li>
                                <li><code>like_count</code>: Jumlah <i>likes</i> yang diterima komentar tersebut.</li>
                                <li><code>word_count</code>: Total kata dalam teks komentar.</li>
                                <li><code>sentiment</code>: Klasifikasi emosi teks (Positif / Negatif / Netral) yang diekstrak dari analisis leksikon NLP.</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- 3. Data Cleaning -->
                <div class="report-section">
                    <h2 class="section-title">3. Data Cleaning (Pembersihan Data)</h2>
                    <p>Proses pembersihan dilakukan secara otomatis menggunakan arsitektur <strong>ETL (Extract, Transform, Load)</strong> berbasis PHP. Berikut adalah penanganan masalah datanya:</p>
                    <ul>
                        <li><strong>Missing Value:</strong> Baris yang tidak memiliki <code>id</code> (null) akan langsung di-<i>drop</i> saat proses parsing CSV.</li>
                        <li><strong>Data Duplikat:</strong> Karena proses <i>scraping</i> Kaggle sering menghasilkan data ganda, algoritma akan melakukan validasi ke <i>Database</i>. Jika <code>id</code> sudah ada (exists), maka baris tersebut diabaikan (<i>skipped</i>).</li>
                        <li><strong>Format Tanggal (Transformasi):</strong> Kolom <code>published_at</code> yang awalnya bertipe string ISO dikonversi menjadi format standar <i>DateTime</i> relasional <code>Y-m-d H:i:s</code> menggunakan <i>library</i> Carbon.</li>
                    </ul>
                    
                    <h4 class="mt-4">Kondisi Data (Before vs After)</h4>
                    <div class="row text-center mb-3">
                        <div class="col-6 border-end">
                            <h3 class="text-danger">Before (Raw CSV)</h3>
                            <h2 class="display-6">1.616 Baris</h2>
                            <p class="text-secondary">Terdapat duplikasi ID dan outlier kosong</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-success">After (SQLite Database)</h3>
                            <h2 class="display-6">1.204 Baris</h2>
                            <p class="text-secondary">Unik, bersih, format seragam</p>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-vcenter table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Fase</th>
                                    <th>ID YouTube</th>
                                    <th>Komentar</th>
                                    <th>Tanggal</th>
                                    <th>Masalah / Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-danger">
                                    <td><span class="badge bg-danger">Before</span></td>
                                    <td><code>UgzH1V...</code></td>
                                    <td>Anies selalu di hati</td>
                                    <td>2026-01-25T14:32:00Z</td>
                                    <td>Duplikasi (Baris ini muncul 2x di dataset mentah).</td>
                                </tr>
                                <tr class="table-success">
                                    <td><span class="badge bg-success">After</span></td>
                                    <td><code>UgzH1V...</code></td>
                                    <td>Anies selalu di hati</td>
                                    <td>2026-01-25 14:32:00</td>
                                    <td>Disimpan 1x. Tanggal sukses dikonversi ke format <i>Time-Series</i>.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 4. EDA -->
                <div class="report-section">
                    <h2 class="section-title">4. Exploratory Data Analysis (EDA)</h2>
                    <ul>
                        <li><strong>Statistik Deskriptif:</strong> Rata-rata komentar mendapatkan <strong>3.81 likes</strong> dan memiliki panjang <strong>19 kata</strong>. Rentang waktu dataset mencakup 25 Januari 2026 hingga 1 Februari 2026.</li>
                        <li><strong>Distribusi Data:</strong> Sebagian besar komentar memiliki distribusi normal (likes mendekati nol atau belasan).</li>
                        <li><strong>Identifikasi Outlier:</strong> Ditemukan adanya <i>outlier</i> berupa komentar sangat viral yang meraup hingga <strong>785 likes</strong> dalam satu waktu.</li>
                        <li><strong>Tren Waktu:</strong> Trafik interaksi sangat fluktuatif dari hari ke hari, dengan lonjakan sentimen negatif pada hari-hari tertentu ketika isu sensitif dibahas.</li>
                    </ul>
                </div>

                <!-- 5. Visualisasi -->
                <div class="report-section">
                    <h2 class="section-title">5. Visualisasi Data</h2>
                    <p>Dalam proyek ini, telah dibuat 4 jenis visualisasi utama sesuai standar rubrik:</p>
                    <ol>
                        <li><strong>Bar Chart (10 Kata Terpopuler):</strong> Menyoroti kata yang paling banyak disebut oleh publik, dilengkapi pewarnaan semantik (Hijau=Positif, Merah=Negatif).</li>
                        <li><strong>Multi-Line Chart (Tren Sentimen Harian):</strong> Visualisasi deret waktu (<i>time-series</i>) yang membedah volume komentar ke dalam 3 garis sentimen berbeda.</li>
                        <li><strong>Donut Chart (Proporsi Sentimen):</strong> Grafik lingkaran untuk melihat perbandingan (persentase) kue opini publik.</li>
                        <li><strong>Word Cloud / Tag Cloud (Grafik Bebas):</strong> Ekspansi dari Bar Chart untuk memetakan 40 kata populer sekaligus secara visual dan spasial.</li>
                    </ol>
                </div>

                <!-- 6. Dashboard -->
                <div class="report-section">
                    <h2 class="section-title">6. Dashboard Interaktif (Laravel)</h2>
                    <p>Analitik di atas dikemas ke dalam Dashboard Interaktif menggunakan <strong>Laravel (Backend)</strong> dan <strong>Tabler UI (Frontend)</strong>. Fitur unggulannya meliputi:</p>
                    <ul>
                        <li><strong>Filter (Slicer) Rentang Waktu:</strong> Pengguna dapat menentukan rentang tanggal tertentu (misalnya, hanya melihat data tanggal 25-28 Januari).</li>
                        <li><strong>Interaksi Antar Grafik (AJAX):</strong> Tanpa perlu <i>refresh</i> halaman, perubahan pada Filter Waktu akan memicu Backend secara asinkron untuk menghitung ulang seluruh elemen grafik, tabel, dan angka <i>summary</i>.</li>
                        <li><strong>Menampilkan Ringkasan Data:</strong> Panel KPI (Key Performance Indicator) menampilkan metrik agregasi seperti Total Komentar, Rata-rata Likes, dan Top Commenter paling aktif.</li>
                    </ul>
                </div>

                <!-- 7. Insight -->
                <div class="report-section">
                    <h2 class="section-title">7. Insight (Hasil Analisis)</h2>
                    <ul>
                        <li><strong>Sentimen Kritis Mendominasi:</strong> Dari Donut Chart, terlihat pola sentimen netizen didominasi oleh kelas Negatif dan Netral. Hal ini lumrah dalam debat politik karena masyarakat cenderung vokal saat mengkritik dibanding memuji.</li>
                        <li><strong>Pola Xenofobia / Proteksionisme:</strong> Kemunculan kata-kata berlabel merah (negatif) seperti "asing" dan "antek" di puncak peringkat Word Cloud dan Bar Chart mengindikasikan kuatnya kecemasan publik terhadap isu campur tangan asing atau tenaga kerja luar negeri.</li>
                        <li><strong>Viralitas Opini Ekstrem:</strong> Komentar dengan nilai likes <i>outlier</i> rata-rata memuat retorika emosional, menunjukkan bahwa polarisasi adalah alat pemicu interaksi (<i>engagement</i>) tertinggi di media sosial.</li>
                    </ul>
                </div>

                <!-- 8. Rekomendasi -->
                <div class="report-section">
                    <h2 class="section-title">8. Rekomendasi</h2>
                    <p>Berdasarkan <i>insight</i> faktual tersebut, keputusan yang dapat diambil adalah:</p>
                    <ul>
                        <li><strong>Bagi Pembuat Kebijakan:</strong> Tingginya frekuensi kata "asing" menuntut pemerintah atau tim kampanye untuk segera merilis klarifikasi terbuka dan transparan terkait kebijakan luar negeri atau investasi guna meredam kekhawatiran proteksionisme publik.</li>
                        <li><strong>Mitigasi Kampanye Negatif:</strong> Tim analisis dapat memantau grafik tren (Line Chart). Jika garis sentimen Negatif melonjak pada tanggal tertentu, tim humas dapat melakukan <i>Counter-Narrative</i> pada hari itu juga.</li>
                    </ul>
                </div>

                <!-- 9. Kesimpulan -->
                <div class="report-section border-0">
                    <h2 class="section-title">9. Kesimpulan</h2>
                    <p>Proyek ini membuktikan bahwa <i>Unstructured Data</i> (komentar teks) dapat diolah menjadi sistem intelijen yang sangat taktis melalui metode Exploratory Data Analysis dan NLP. Penggunaan ETL berbasis Laravel yang digabungkan dengan visualisasi interaktif Chart.js berhasil mengubah 1.616 data bising menjadi 1.204 data valid. Dashboard ini tidak hanya sekadar indah, namun secara <i>real-time</i> mampu mendeteksi isu harian, sentimen publik, dan tokoh-tokoh netizen yang paling berpengaruh.</p>
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
