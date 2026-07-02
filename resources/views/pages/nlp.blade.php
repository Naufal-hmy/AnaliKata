@extends('layouts.app')
@section('title', 'NLP Preprocessing - AnaliKata PRO')

@section('content')
<div class="row g-2 align-items-center mb-4">
  <div class="col">
    <div class="page-pretitle">Tahap 2: Natural Language Processing</div>
    <h2 class="page-title">NLP Text Preprocessing (Before vs After Algoritma)</h2>
  </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <p>Setelah lolos proses ETL (hapus duplikat), data teks (komentar) masih sangat kotor dan tidak terstruktur. Kita harus menggunakan algoritma NLP dasar untuk membersihkan teks sebelum dapat diolah oleh <i>Machine Learning Lexicon</i>.</p>
        
        <h3 class="mb-3">Tahapan Pipeline NLP:</h3>
        <ol>
            <li><strong>Case Folding:</strong> Merubah semua huruf kapital menjadi huruf kecil (Lowercasing).</li>
            <li><strong>Regex Cleansing:</strong> Menghapus tanda baca, angka, simbol emoji, dan *whitespace* berlebih menggunakan <i>Regular Expression</i>.</li>
            <li><strong>Stopword Removal:</strong> Menghapus kata hubung yang tidak memiliki makna (seperti: "yang", "dan", "di", "ke", "itu") menggunakan kamus <i>Stopwords</i> Bahasa Indonesia.</li>
            <li><strong>Tokenisasi & N-Grams:</strong> Memecah kalimat menjadi potongan-potongan frasa (<i>Unigram & Bigram</i>).</li>
        </ol>

        <h3 class="mt-5 mb-3">Tabel Before vs After (Hasil Algoritma NLP)</h3>
        <div class="table-responsive mb-4 rounded border">
            <table class="table table-vcenter table-bordered mb-0">
                <thead>
                    <tr class="bg-dark text-white">
                        <th class="w-1">Status</th>
                        <th width="40%">Teks Komentar</th>
                        <th>Penjelasan Algoritma yang Bekerja</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample 1 -->
                    <tr class="bg-red-lt">
                        <td><span class="badge bg-danger">Before</span></td>
                        <td><strong>"Menurut saya, yang bikin hancur itu antek ASING!!! 😡👎 #Politik2026"</strong></td>
                        <td class="text-danger">Teks mentah penuh dengan huruf kapital, simbol, hashtag, emoji, dan kata hubung.</td>
                    </tr>
                    <tr class="bg-green-lt">
                        <td><span class="badge bg-success">After</span></td>
                        <td><strong>"hancur antek asing"</strong></td>
                        <td class="text-success">
                            <ul>
                                <li><i>Regex:</i> Koma, seru, hashtag, angka, dan emoji dihapus.</li>
                                <li><i>Case Folding:</i> "ASING" menjadi "asing".</li>
                                <li><i>Stopwords:</i> Kata "menurut", "saya", "yang", "bikin", "itu" dihapus karena tidak punya bobot sentimen.</li>
                            </ul>
                        </td>
                    </tr>
                    
                    <!-- Divider -->
                    <tr><td colspan="3" class="bg-light"></td></tr>

                    <!-- Sample 2 -->
                    <tr class="bg-red-lt">
                        <td><span class="badge bg-danger">Before</span></td>
                        <td><strong>"Wahai bapak/ibu, KERJA KERAS lah demi bangsa dan negara ini... 100% didukung"</strong></td>
                        <td class="text-danger">Karakter spesial (garis miring, persen, titik tiga) dan angka mengotori dataset teks.</td>
                    </tr>
                    <tr class="bg-green-lt">
                        <td><span class="badge bg-success">After</span></td>
                        <td><strong>"wahai kerja keras bangsa negara dukung"</strong></td>
                        <td class="text-success">
                            <ul>
                                <li><i>Regex:</i> "/ % ..." dihapus.</li>
                                <li><i>Stopwords:</i> "bapak", "ibu", "lah", "demi", "dan", "ini" dibuang.</li>
                                <li><i>Stemming (Opsional):</i> "didukung" menjadi akar kata "dukung".</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="mt-5 mb-3">Kode Sumber Algoritma NLP (PHP)</h3>
        <p class="text-secondary">Berikut adalah <i>logic snippet</i> (File: <code>app/Services/NLPService.php</code>):</p>
<pre><code class="language-php">&lt;?php
namespace App\Services;

class NLPService {
    
    // Kamus Stopwords statis (Bisa juga dari Database)
    protected $stopwords = ['yang', 'di', 'ke', 'dari', 'itu', 'ini', 'dan', 'atau', 'saya', 'menurut', 'bikin', 'lah'];

    public function preprocess($text) {
        // 1. Case Folding
        $text = strtolower($text);

        // 2. Regex Cleansing (Hanya sisakan huruf a-z)
        $text = preg_replace('/[^a-z\s]/', ' ', $text);
        
        // Menghapus spasi berlebih
        $text = preg_replace('/\s+/', ' ', $text);

        // 3. Tokenisasi (Memecah menjadi array kata)
        $words = explode(' ', trim($text));

        // 4. Stopword Removal
        $cleanWords = array_filter($words, function($word) {
            return !in_array($word, $this->stopwords) && strlen($word) > 2; // Hapus kata < 2 huruf
        });

        // Gabungkan kembali menjadi teks bersih
        return implode(' ', $cleanWords);
    }
}
?&gt;</code></pre>
    </div>
</div>
@endsection
