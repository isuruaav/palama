<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    {{-- SEO --}}
    <meta name="description" content="@yield('meta_description', 'SevaSL — Sri Lanka\'s #1 service marketplace. Find trusted AC repair, plumbing, tutors, beauty, vehicle repair and 100+ services near you. 24/7 emergency available.')"/>
    <meta name="keywords" content="@yield('meta_keywords', 'Sri Lanka services, AC repair, plumber, home tutor, CCTV, vehicle repair, beauty, cleaning, SevaSL')"/>
    <meta name="robots" content="index, follow"/>
    <meta property="og:title" content="@yield('title', 'SevaSL — Sri Lanka Service Marketplace')"/>
    <meta property="og:description" content="@yield('meta_description', 'Find trusted service providers near you in Sri Lanka.')"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:image" content="@yield('og_image', asset('images/sevasl-og.jpg'))"/>
    <meta property="og:site_name" content="SevaSL"/>

    <title>@yield('title', 'SevaSL — Sri Lanka Service Marketplace')</title>

    {{-- Favicon --}}
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo_b.png') }}"/>
<link rel="apple-touch-icon" href="{{ asset('images/logo_b.png') }}"/>

    {{-- PT Sans Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Noto+Sans+Sinhala:wght@400;700&display=swap" rel="stylesheet"/>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>


    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

   <style>
* { box-sizing:border-box; margin:0; padding:0; }

:root {
    --primary-dark:  #0A0F3D;
    --primary:       #1E3A8A;
    --primary-light: #3B82F6;
    --primary-soft:  #DBEAFE;
    --secondary:     #03A9F4;
    --secondary-soft:#E0F7FA;
    --accent:        #00C853;
    --accent-dark:   #009624;
    --accent-soft:   #E8F5E9;
    --bg:            #F5F7FA;
    --card:          #FFFFFF;
    --border:        #E5E7EB;
    --text:          #111827;
    --text-secondary:#6B7280;
    --text-light:    #9CA3AF;
}

* { box-sizing:border-box; margin:0; padding:0; }

body {
    font-family: {{ app()->getLocale() == 'si' ? '"Noto Sans Sinhala", "PT Sans"' : '"PT Sans"' }}, sans-serif;
    font-weight: 400;
    background: var(--bg);
    color: var(--text);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

h1, h2, h3, h4, h5 {
    font-family: {{ app()->getLocale() == 'si' ? '"Noto Sans Sinhala", "PT Sans"' : '"PT Sans"' }}, sans-serif;
    font-weight: 700;
    color: var(--text);
}

/* Pagination */
nav[role="navigation"] {
    display:flex; justify-content:center; margin-top:32px;
}
nav[role="navigation"] span,
nav[role="navigation"] a {
    display:inline-flex; align-items:center; justify-content:center;
    min-width:38px; height:38px; border-radius:10px; font-size:14px;
    font-weight:700; margin:0 3px; text-decoration:none;
    border:1.5px solid var(--border); color:var(--text); background:white;
    transition:all .2s; padding:0 8px;
}
nav[role="navigation"] a:hover {
    border-color:var(--primary-light); color:var(--primary);
}
nav[role="navigation"] span[aria-current="page"] span {
    background:var(--primary); color:white; border-color:var(--primary);
    min-width:38px; height:38px; display:flex; align-items:center; justify-content:center;
    border-radius:10px;
}

/* Mobile */
@media (max-width: 768px) {
    .nav-search { display:none !important; }
    .hero-title { font-size:30px !important; line-height:1.2 !important; }
    .search-form { flex-direction:column !important; }
    .search-form select, .search-form input { width:100% !important; }
    .services-grid { grid-template-columns:1fr !important; }
    .categories-grid { grid-template-columns:repeat(2,1fr) !important; }
    .stats-grid { grid-template-columns:repeat(2,1fr) !important; }
    .show-grid { grid-template-columns:1fr !important; }
    .show-sidebar { position:static !important; }
    .index-grid { grid-template-columns:1fr !important; }
    .filter-sticky { position:static !important; }
    .dash-stats { grid-template-columns:repeat(2,1fr) !important; }
    .footer-grid { grid-template-columns:1fr !important; }
    .hide-mobile { display:none !important; }
}
</style>

    @stack('styles')
</head>
<body>

    @include('components.navbar')

    @if(session('success'))
    <div style="background:#DCFCE7; color:#166534; padding:12px 24px; text-align:center; font-size:14px; font-weight:700; font-family:'PT Sans',sans-serif;">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="background:#FEE2E2; color:#DC2626; padding:12px 24px; text-align:center; font-size:14px; font-weight:700; font-family:'PT Sans',sans-serif;">
        ❌ {{ session('error') }}
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>
</html>