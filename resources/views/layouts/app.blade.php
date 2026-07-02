<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>@yield('title', 'AnaliKata PRO - Analytics & Machine Learning')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    
    <!-- PrismJS for Code Snippets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">
    
    <!-- DataViz Libs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.anychart.com/releases/8.12.0/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.12.0/js/anychart-tag-cloud.min.js"></script>
    
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root { --tblr-font-sans-serif: 'Inter Var', sans-serif; }
      body { font-feature-settings: "cv03", "cv04", "cv11"; background-color: #f4f6fa; }
      .icon { width: 24px; height: 24px; stroke-width: 2; stroke: currentColor; fill: none; stroke-linecap: round; stroke-linejoin: round; }
      #wordcloud { width: 100%; height: 350px; margin: 0; padding: 0; }
      .scrollable-table { max-height: 350px; overflow-y: auto; }
      pre[class*="language-"] { border-radius: 8px; margin: 1rem 0; font-size: 0.85rem; }
    </style>
  </head>
  <body>
    <div class="page">
      <!-- Sidebar -->
      <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark">
            <a href="/" class="d-flex align-items-center gap-2" style="text-decoration: none;">
              <span class="bg-primary text-white avatar avatar-sm rounded">AK</span>
              <span>AnaliKata <span class="badge bg-primary text-white badge-sm ms-1">PRO</span></span>
            </a>
          </h1>
          <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0">
                <span class="avatar avatar-sm" style="background-image: url('https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff')"></span>
              </a>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
              
              <li class="nav-item-header mt-3"><div class="text-uppercase font-weight-bold" style="font-size: 0.75rem; color: #8a98ac; padding: 0 1rem;">Analytics</div></li>
              <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h6v8h-6z" /><path d="M4 16h6v4h-6z" /><path d="M14 12h6v8h-6z" /><path d="M14 4h6v4h-6z" /></svg>
                  </span>
                  <span class="nav-link-title">Overview Dashboard</span>
                </a>
              </li>

              <li class="nav-item-header mt-4"><div class="text-uppercase font-weight-bold" style="font-size: 0.75rem; color: #8a98ac; padding: 0 1rem;">Data Preparation</div></li>
              <li class="nav-item {{ request()->is('dataset') ? 'active' : '' }}">
                <a class="nav-link" href="/dataset">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-16z" /><path d="M12 4v7l-2 -2l-2 2v-7" /></svg>
                  </span>
                  <span class="nav-link-title">Sumber Dataset</span>
                </a>
              </li>
              <li class="nav-item {{ request()->is('cleaning') ? 'active' : '' }}">
                <a class="nav-link" href="/cleaning">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" /></svg>
                  </span>
                  <span class="nav-link-title">Data Cleaning (ETL)</span>
                </a>
              </li>
              <li class="nav-item {{ request()->is('nlp') ? 'active' : '' }}">
                <a class="nav-link" href="/nlp">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" /><path d="M8 13l4 -2l4 2" /></svg>
                  </span>
                  <span class="nav-link-title">NLP Preprocessing</span>
                </a>
              </li>

              <li class="nav-item-header mt-4"><div class="text-uppercase font-weight-bold" style="font-size: 0.75rem; color: #8a98ac; padding: 0 1rem;">Analisis & Modeling</div></li>
              <li class="nav-item {{ request()->is('eda') ? 'active' : '' }}">
                <a class="nav-link" href="/eda">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 19l16 0" /><path d="M4 15l4 -6l4 2l4 -5l4 4" /></svg>
                  </span>
                  <span class="nav-link-title">Exploratory Data Analysis</span>
                </a>
              </li>
              <li class="nav-item {{ request()->is('scoring') ? 'active' : '' }}">
                <a class="nav-link" href="/scoring">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-cyan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M3 12h4" /><path d="M17 12h4" /><path d="M12 3v4" /><path d="M12 17v4" /></svg>
                  </span>
                  <span class="nav-link-title">Lexicon Sentiment Scoring</span>
                </a>
              </li>

              <li class="nav-item-header mt-4"><div class="text-uppercase font-weight-bold" style="font-size: 0.75rem; color: #8a98ac; padding: 0 1rem;">Knowledge Discovery</div></li>
              <li class="nav-item {{ request()->is('insight') ? 'active' : '' }}">
                <a class="nav-link" href="/insight">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg>
                  </span>
                  <span class="nav-link-title">Insight Otomatis</span>
                  <span class="badge bg-indigo-lt ms-auto">ML</span>
                </a>
              </li>
              <li class="nav-item {{ request()->is('recommendation') ? 'active' : '' }}">
                <a class="nav-link" href="/recommendation">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 11v11" /><path d="M8 14.5l4 -2.5l4 2.5" /><path d="M12 2l-3 5h6z" /></svg>
                  </span>
                  <span class="nav-link-title">Rekomendasi Bisnis</span>
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </aside>

      <!-- Main Layout -->
      <div class="page-wrapper">
        <!-- Top header for desktop user profile -->
        <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
          <div class="container-xl">
            <div class="navbar-nav flex-row order-md-last ms-auto">
              <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0">
                  <span class="avatar avatar-sm" style="background-image: url('https://ui-avatars.com/api/?name=Admin+Analyst&background=5a0b4d&color=fff')"></span>
                  <div class="d-none d-xl-block ps-2">
                    <div>Admin Analyst</div>
                    <div class="mt-1 small text-secondary">Machine Learning Dept.</div>
                  </div>
                </a>
              </div>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
              <!-- Search bar or breadcrumb could go here -->
              <div>
                <span class="badge bg-green-lt"><span class="badge bg-green badge-blink me-2"></span> Live &middot; Youtube Political Dataset</span>
              </div>
            </div>
          </div>
        </header>
        
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            @yield('content')
          </div>
        </div>
        
      </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
    
    @yield('scripts')
  </body>
</html>
