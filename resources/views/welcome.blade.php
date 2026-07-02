<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>AnaliKata - Dashboard Visualisasi Sentimen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.anychart.com/releases/8.12.0/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.12.0/js/anychart-tag-cloud.min.js"></script>
    
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root { --tblr-font-sans-serif: 'Inter Var', sans-serif; }
      body { font-feature-settings: "cv03", "cv04", "cv11"; }
      #wordcloud { width: 100%; height: 350px; margin: 0; padding: 0; }
      .icon { width: 24px; height: 24px; stroke-width: 2; stroke: currentColor; fill: none; stroke-linecap: round; stroke-linejoin: round; }
      .scrollable-table { max-height: 350px; overflow-y: auto; }
    </style>
  </head>
  <body class="layout-fluid">
    <div class="page">
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="#">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-tabler text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l3 3l-3 3" /><line x1="13" y1="15" x2="16" y2="15" /><rect x="4" y="4" width="16" height="16" rx="4" /></svg>
              AnaliKata
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <a href="https://github.com/tabler/tabler" class="btn btn-outline-white" target="_blank" rel="noreferrer">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
                Source code
              </a>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0">
                <span class="avatar avatar-sm" style="background-image: url('https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff')"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>Administrator</div>
                  <div class="mt-1 small text-secondary">Data Analyst</div>
                </div>
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
                <h2 class="page-title">Dashboard Sentimen & Analisis Komentar</h2>
              </div>
            </div>
          </div>
        </div>
        
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              
              <!-- Filter Slicer -->
              <div class="col-12">
                <form id="filterForm" class="card">
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-5">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" id="start_date" class="form-control" value="2026-01-25" min="2026-01-25" max="2026-02-01">
                      </div>
                      <div class="col-md-5">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" id="end_date" class="form-control" value="2026-02-01" min="2026-01-25" max="2026-02-01">
                      </div>
                      <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M5 12l14 0" /><path d="M9 18l6 0" /></svg>
                          Terapkan Filter
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <!-- Summary Metric Cards -->
              <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9h8" /><path d="M8 13h6" /><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" /></svg>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium text-secondary">Total Komentar</div>
                        <div class="text-secondary" style="font-size: 1.5rem; font-weight: 600;" id="totComments">...</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-green text-white avatar">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium text-secondary">Rata-rata Likes</div>
                        <div class="text-secondary" style="font-size: 1.5rem; font-weight: 600;" id="avgLikes">...</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-info text-white avatar">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium text-secondary">Rata-rata Kata per Komentar</div>
                        <div class="text-secondary" style="font-size: 1.5rem; font-weight: 600;" id="avgWords">...</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Top Commenter Alert -->
              <div class="col-12">
                <div class="alert alert-important alert-info alert-dismissible" role="alert">
                  <div class="d-flex">
                    <div><svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l0 4" /><path d="M12 16l.01 0" /></svg></div>
                    <div id="topCommenterText">Memuat Top Commenter...</div>
                  </div>
                </div>
              </div>

              <!-- Trend Chart -->
              <div class="col-lg-8">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="card-title">Perbandingan Volume & Tren Sentimen Harian</div>
                  </div>
                  <div class="card-body">
                    <div class="chart-container" style="position: relative; height:350px; width:100%">
                      <canvas id="trendChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Donut Chart -->
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="card-title">Proporsi Keseluruhan Sentimen</div>
                  </div>
                  <div class="card-body">
                    <div class="chart-container" style="position: relative; height:350px; width:100%">
                      <canvas id="distributionChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Word Cloud -->
              <div class="col-lg-7">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="card-title">Top 40 Kata Utama (AnyChart Tag Cloud)</div>
                  </div>
                  <div class="card-body text-center">
                    <div id="wordcloud"></div>
                  </div>
                </div>
              </div>

              <!-- Top Phrase Per Date -->
              <div class="col-lg-5">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="card-title">Kata Paling Viral per Tanggal</div>
                  </div>
                  <div class="card-body scrollable-table p-0">
                    <table class="table table-vcenter table-mobile-md card-table">
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Kata Tertinggi</th>
                          <th>Frekuensi</th>
                        </tr>
                      </thead>
                      <tbody id="topPhraseTable">
                        <tr><td colspan="3" class="text-center">Memuat...</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/js/tabler.min.js" defer></script>
    <script>
        let trendChartObj = null;
        let distChartObj = null;
        let wordcloudChartObj = null;

        Chart.defaults.font.family = "'Inter Var', sans-serif";
        Chart.defaults.color = "#6c7a91";

        async function loadData() {
            const start = document.getElementById('start_date').value;
            const end = document.getElementById('end_date').value;
            const query = `?start_date=${start}&end_date=${end}`;

            // 1. Summary
            const summary = await fetch('/api/dashboard/summary' + query).then(res => res.json());
            document.getElementById('totComments').innerText = summary.total_comments;
            document.getElementById('avgLikes').innerText = summary.avg_likes;
            document.getElementById('avgWords').innerText = summary.avg_word_count;

            // 2. Top Commenter
            const commenter = await fetch('/api/dashboard/top-commenter' + query).then(res => res.json());
            if(commenter) {
                document.getElementById('topCommenterText').innerHTML = `
                    <strong>Top Commenter:</strong> ${commenter.author} (${commenter.total_comments} pesan). <br>
                    <strong>Komentar Terbaik (${commenter.likes} Likes):</strong> <i>"${commenter.top_comment_text}"</i>
                `;
            }

            // 3. Trend (Multi-Line Chart)
            const trend = await fetch('/api/dashboard/trend' + query).then(res => res.json());
            const labels = trend.map(t => t.date);
            
            if(trendChartObj) trendChartObj.destroy();
            trendChartObj = new Chart(document.getElementById('trendChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        { label: 'Total Volume', data: trend.map(t=>t.Total), borderColor: '#206bc4', borderWidth: 2, borderDash: [5, 5], fill: false, tension: 0.3 },
                        { label: 'Positif', data: trend.map(t=>t.Positif), borderColor: '#2fb344', backgroundColor: 'rgba(47, 179, 68, 0.1)', borderWidth: 2, fill: true, tension: 0.3 },
                        { label: 'Negatif', data: trend.map(t=>t.Negatif), borderColor: '#d63939', backgroundColor: 'rgba(214, 57, 57, 0.1)', borderWidth: 2, fill: true, tension: 0.3 },
                        { label: 'Netral', data: trend.map(t=>t.Netral), borderColor: '#f59f00', backgroundColor: 'rgba(245, 159, 0, 0.1)', borderWidth: 2, fill: true, tension: 0.3 }
                    ]
                },
                options: { maintainAspectRatio: false, plugins: { legend: { position: 'top' } }, scales: { y: { beginAtZero: true, grid: { borderDash: [4, 4] } }, x: { grid: { display: false } } } }
            });

            // 4. Distribution (Doughnut)
            const dist = await fetch('/api/dashboard/distribution' + query).then(res => res.json());
            const sentimentColors = { 'Positif': '#2fb344', 'Negatif': '#d63939', 'Netral': '#f59f00' };
            
            if(distChartObj) distChartObj.destroy();
            distChartObj = new Chart(document.getElementById('distributionChart'), {
                type: 'doughnut',
                data: {
                    labels: dist.map(d => d.sentiment_label),
                    datasets: [{ 
                        data: dist.map(d => d.count),
                        backgroundColor: dist.map(d => sentimentColors[d.sentiment_label] || '#206bc4'),
                        borderWidth: 0
                    }]
                },
                options: { maintainAspectRatio: false, cutout: '75%', plugins: { legend: { position: 'bottom' } } }
            });

            // 5. Wordcloud (AnyChart)
            const words = await fetch('/api/dashboard/wordcloud' + query).then(res => res.json());
            document.getElementById('wordcloud').innerHTML = '';
            if(words.length > 0) {
                wordcloudChartObj = anychart.tagCloud(words);
                wordcloudChartObj.angles([0, -45, 90]);
                wordcloudChartObj.colorRange(false);
                wordcloudChartObj.colorScale(anychart.scales.ordinalColor().colors(["#206bc4", "#4299e1", "#f59f00", "#d63939", "#2fb344", "#6f42c1"]));
                wordcloudChartObj.container("wordcloud");
                wordcloudChartObj.draw();
            }

            // 6. Top Phrase per Date Table
            const topPhrases = await fetch('/api/dashboard/top-phrase' + query).then(res => res.json());
            const tbody = document.getElementById('topPhraseTable');
            tbody.innerHTML = '';
            topPhrases.forEach(p => {
                tbody.innerHTML += `<tr>
                    <td class="text-nowrap text-secondary">${p.date}</td>
                    <td><span class="badge bg-primary-lt">${p.phrase}</span></td>
                    <td class="text-secondary">${p.freq}</td>
                </tr>`;
            });
        }

        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            loadData();
        });

        loadData();
    </script>
  </body>
</html>
