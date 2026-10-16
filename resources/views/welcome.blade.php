<!DOCTYPE html><html lang="id" class="scroll-smooth"><head><meta charset="utf-8"><meta name="csrf-token" content="{{ csrf_token() }}"><meta content="width=device-width, initial-scale=1.0" name="viewport"><meta content="web_standard" name="shell-type"><link href="https://fonts.googleapis.com" rel="preconnect"><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"><style>@layer base{html{scroll-behavior:smooth;scroll-padding-top:5rem;}html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}@keyframes barWave{0%,100%{height:4px;}50%{height:14px;}}@keyframes pulseGlow{0%,100%{opacity:0.5;transform:scale(1);}50%{opacity:0.9;transform:scale(1.05);}}</style><script src="https://cdn.tailwindcss.com"></script><script id="tailwind-config">tailwind.config={darkMode:"class",theme:{extend:{colors:{"inverse-on-surface":"#eef0ff","on-secondary-fixed":"#002113","on-error-container":"#93000a","on-primary":"#ffffff","secondary":"#006c49","surface-container-highest":"#dae2fd","on-primary-fixed":"#002110","tertiary":"#003c5e","on-error":"#ffffff","on-surface-variant":"#404941","background":"#faf8ff","surface-container":"#eaedff","outline":"#707a71","on-primary-fixed-variant":"#00522e","surface-container-lowest":"#ffffff","outline-variant":"#bfc9bf","primary-fixed-dim":"#8dd6a6","inverse-primary":"#8dd6a6","on-primary-container":"#89d2a2","surface-container-high":"#e2e7ff","error-container":"#ffdad6","secondary-fixed":"#6ffbbe","tertiary-container":"#005481","secondary-container":"#6cf8bb","error":"#ba1a1a","surface-dim":"#d2d9f4","on-tertiary-fixed-variant":"#004b73","primary":"#004225","surface":"#faf8ff","on-tertiary-fixed":"#001d31","on-secondary-fixed-variant":"#005236","inverse-surface":"#283044","on-surface":"#131b2e","tertiary-fixed-dim":"#93ccff","on-secondary-container":"#00714d","primary-fixed":"a8f3c1","on-background":"#131b2e","tertiary-fixed":"#cce5ff","on-tertiary":"#ffffff","surface-tint":"#216b43","secondary-fixed-dim":"#4edea3","surface-container-low":"#f2f3ff","surface-bright":"#faf8ff","on-secondary":"#ffffff","surface-variant":"#dae2fd","primary-container":"#0a5c36","on-tertiary-container":"#88c8ff"},borderRadius:{"DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px"},spacing:{"space-md":"1rem","margin":"3rem","space-sm":"0.5rem","space-xl":"2.5rem","gutter-mobile":"1rem","gutter":"1.5rem","margin-mobile":"1.25rem","space-lg":"1.5rem","space-xs":"0.25rem"},fontFamily:{"headline-md-mobile":["Plus Jakarta Sans"],"headline-sm":["Plus Jakarta Sans"],"headline-lg":["Plus Jakarta Sans"],"headline-lg-mobile":["Plus Jakarta Sans"],"body-lg":["Plus Jakarta Sans"],"label-md":["Plus Jakarta Sans"],"body-md":["Plus Jakarta Sans"],"display-xl":["Plus Jakarta Sans"],"display-xl-mobile":["Plus Jakarta Sans"],"title-md":["Plus Jakarta Sans"],"label-sm":["Plus Jakarta Sans"],"body-sm":["Plus Jakarta Sans"],"headline-md":["Plus Jakarta Sans"],"title-lg":["Plus Jakarta Sans"]},fontSize:{"headline-md-mobile":["22px",{"lineHeight":"30px","fontWeight":"700"}],"headline-sm":["20px",{"lineHeight":"28px","fontWeight":"600"}],"headline-lg":["40px",{"lineHeight":"48px","fontWeight":"700"}],"headline-lg-mobile":["28px",{"lineHeight":"36px","fontWeight":"700"}],"body-lg":["18px",{"lineHeight":"28px","fontWeight":"400"}],"label-md":["14px",{"lineHeight":"20px","fontWeight":"600"}],"body-md":["15px",{"lineHeight":"24px","fontWeight":"400"}],"display-xl":["56px",{"lineHeight":"64px","fontWeight":"800"}],"display-xl-mobile":["36px",{"lineHeight":"44px","fontWeight":"800"}],"title-md":["16px",{"lineHeight":"24px","fontWeight":"600"}],"label-sm":["12px",{"lineHeight":"16px","fontWeight":"600"}],"body-sm":["13px",{"lineHeight":"20px","fontWeight":"400"}],"headline-md":["28px",{"lineHeight":"36px","fontWeight":"700"}],"title-lg":["18px",{"lineHeight":"26px","fontWeight":"600"}]}}}};</script></head><body class="bg-background font-body-md text-body-md text-on-surface antialiased"><header class="fixed top-0 w-full z-50 bg-surface-container-lowest/90 backdrop-blur-md shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-4"><div class="flex items-center gap-3"><a href="{{ route('home') }}" class="inline-flex items-center"><img src="{{ $profile->logo_url ?? \App\Models\CompanyProfile::DEFAULT_LOGO }}" alt="{{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}" class="h-10 w-auto object-contain"></a></div><nav class="hidden lg:flex items-center gap-1 xl:gap-2" id="desktop-nav" data-active-classes="text-primary font-bold bg-surface-container-low rounded-lg"><a aria-current="page" class="nav-link px-3 py-2 transition-colors text-primary font-bold bg-surface-container-low rounded-lg" data-path="beranda" href="#beranda">Beranda</a><a class="nav-link px-3 py-2 font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors rounded-lg" data-path="tentang-kami" href="#tentang-kami">Tentang Kami</a><a class="nav-link px-3 py-2 font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors rounded-lg" data-path="layanan" href="#layanan">Layanan</a><a class="nav-link px-3 py-2 font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors rounded-lg" href="{{ route('public.portofolio') }}">Portofolio</a><a class="nav-link px-3 py-2 font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors rounded-lg" href="{{ route('public.berita') }}">Berita</a><a class="nav-link px-3 py-2 font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors rounded-lg" data-path="klien" href="#klien">Klien</a><a class="nav-link px-3 py-2 font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors rounded-lg" data-path="kontak" href="#kontak-konsultasi">Kontak</a></nav><div class="flex items-center gap-3"><!-- Visitor Counter in Header --><div class="hidden md:flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-xs shadow-xs"><span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span><span class="font-semibold text-emerald-950">Visitor: <strong class="text-emerald-800">{{ number_format($totalVisitors ?? 0) }}</strong></span><span class="text-emerald-300">|</span><span class="text-emerald-800">Hari ini: <strong class="text-emerald-900">{{ number_format($todayVisitors ?? 0) }}</strong></span></div><button id="mobile-menu-toggle" aria-label="Buka Menu" class="lg:hidden p-2 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors focus:outline-none"><span class="material-symbols-outlined text-2xl" id="menu-icon">menu</span></button></div></div><!-- Mobile Navigation Drawer --><div id="mobile-nav" class="hidden lg:hidden border-t border-outline-variant/30 bg-surface-container-lowest/98 px-6 py-4 flex flex-col gap-1.5 shadow-lg backdrop-blur-md"><div class="flex items-center justify-between p-3 mb-2 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-900"><div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span><span>Total Visitor: <strong>{{ number_format($totalVisitors ?? 0) }}</strong></span></div><span>Hari Ini: <strong>{{ number_format($todayVisitors ?? 0) }}</strong></span></div><a class="mobile-nav-link px-3 py-2.5 rounded-lg text-primary font-bold bg-surface-container-low transition-colors font-label-md text-label-md" data-path="beranda" href="#beranda">Beranda</a><a class="mobile-nav-link px-3 py-2.5 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md" data-path="tentang-kami" href="#tentang-kami">Tentang Kami</a><a class="mobile-nav-link px-3 py-2.5 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md" data-path="layanan" href="#layanan">Layanan</a><a class="mobile-nav-link px-3 py-2.5 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md" href="{{ route('public.portofolio') }}">Portofolio Proyek</a><a class="mobile-nav-link px-3 py-2.5 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md" href="{{ route('public.berita') }}">Berita &amp; Publikasi</a><a class="mobile-nav-link px-3 py-2.5 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md" data-path="klien" href="#klien">Klien</a><a class="mobile-nav-link px-3 py-2.5 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md" data-path="kontak" href="#kontak-konsultasi">Kontak</a>@php
  $phoneRaw = preg_replace('/[^0-9]/', '', $profile->nomorTeleponPerusahaan ?? '6285355836787');
  if (\Illuminate\Support\Str::startsWith($phoneRaw, '0')) {
      $phoneRaw = '62' . substr($phoneRaw, 1);
  }
@endphp
<div class="pt-2"><a class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-[#25D366] hover:bg-[#20ba59] text-white font-label-md text-label-md font-bold transition-all shadow-sm" href="https://wa.me/{{ $phoneRaw }}?text={{ rawurlencode('Halo PT Gretta Solutions Network, saya ingin konsultasi mengenai layanan IT dan solusi sistem.') }}" target="_blank" rel="noopener noreferrer"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.953 3.71 1.456 5.711 1.457h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg><span>Konsultasi WhatsApp</span></a></div></div></header><main class="w-full pt-20 bg-background"><div class="flex flex-col w-full">
<!-- HERO SECTION -->
<!-- HERO SECTION: FULL-BLEED ISP BACKBONE NETWORK -->
<section id="beranda" class="relative w-full overflow-hidden bg-[#050b13] text-white py-16 lg:py-24 scroll-mt-20 border-b border-emerald-950/40 select-none">
  <!-- Subtle High-Tech Atmosphere Background Layers -->
  <div class="absolute inset-0 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:28px_28px] opacity-10 pointer-events-none"></div>
  <div class="absolute -top-40 right-10 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute bottom-0 -left-20 w-[550px] h-[550px] bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
  
  <!-- FULL HERO ISP BACKBONE INTERACTIVE CANVAS -->
  <canvas id="hero-isp-backbone-canvas" class="absolute inset-0 w-full h-full pointer-events-auto z-0 cursor-crosshair"></canvas>

  <!-- Gradient Mask at bottom to smoothly blend into the next section -->
  <div class="absolute bottom-0 inset-x-0 h-16 bg-gradient-to-t from-surface-container-low/20 to-transparent pointer-events-none z-10"></div>

  <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
      
      <!-- Text Column (Left) -->
      <div class="lg:col-span-7 flex flex-col items-start gap-6">
        
        <!-- Comprehensive 10 Pillars Badge -->
        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-emerald-500/15 border border-emerald-500/35 text-emerald-300 font-label-sm text-label-sm tracking-wide backdrop-blur-md shadow-sm">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
          <span class="font-bold uppercase tracking-wider">One Stop Business &amp; IT Solutions • 10 Pilar Layanan Terpadu</span>
        </div>

        <h1 class="font-display-xl text-display-xl font-extrabold text-white tracking-tight leading-tight">
          Solusi Terpadu <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-300">Infrastruktur IT, Rekayasa Aplikasi</span> &amp; Jaringan Backbone
        </h1>

        <p class="font-body-lg text-body-lg text-slate-300 max-w-2xl leading-relaxed">
          PT. Gretta Solutions Network menghadirkan ekosistem solusi digital komprehensif: penyediaan konektivitas internet &amp; backbone ISP berkecepatan tinggi, rekayasa perangkat lunak bisnis &amp; SIMRS terintegrasi, pengadaan hardware dan server enterprise bergaransi, instalasi smart CCTV, proteksi siber, hingga konsultasi arsitektur IT di seluruh Indonesia.
        </p>

        <!-- CTA Action Buttons -->
        <div class="flex flex-wrap items-center gap-4 pt-2 w-full sm:w-auto">
          <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-label-md text-label-md font-bold shadow-lg shadow-emerald-950/60 transition-all hover:scale-[1.02] active:scale-95" href="#kontak-konsultasi">
            <span>Konsultasi Solusi IT &amp; Bisnis</span>
            <span class="material-symbols-outlined text-title-md">arrow_forward</span>
          </a>
          <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-slate-900/80 hover:bg-slate-800/80 text-emerald-300 border border-emerald-500/35 font-label-md text-label-md font-bold transition-all backdrop-blur-md hover:border-emerald-400" href="#layanan">
            <span>Eksplorasi 10 Pilar Layanan</span>
            <span class="material-symbols-outlined text-title-md">grid_view</span>
          </a>
        </div>

        <!-- Trust Badges Bar (Dark Glassmorphic) -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 mt-2 w-full bg-[#0a1622]/85 backdrop-blur-md border border-emerald-500/20 p-5 rounded-2xl shadow-xl">
          <div class="flex flex-col">
            <span class="font-headline-sm text-headline-sm font-bold text-emerald-400">10 Pilar</span>
            <span class="font-label-sm text-label-sm text-slate-400">Solusi IT &amp; Bisnis Terpadu</span>
          </div>
          <div class="flex flex-col">
            <span class="font-headline-sm text-headline-sm font-bold text-cyan-400">99.99%</span>
            <span class="font-label-sm text-label-sm text-slate-400">Enterprise SLA Uptime</span>
          </div>
          <div class="flex flex-col">
            <span class="font-headline-sm text-headline-sm font-bold text-emerald-300">100+ Gbps</span>
            <span class="font-label-sm text-label-sm text-slate-400">Kapasitas Backbone &amp; ISP</span>
          </div>
          <div class="flex flex-col">
            <span class="font-headline-sm text-headline-sm font-bold text-teal-300">5 Pulau</span>
            <span class="font-label-sm text-label-sm text-slate-400">Cakupan Wilayah Nasional</span>
          </div>
        </div>

      </div>

      <!-- Visual Column: Interactive ISP Backbone Control Console & Telemetry (Right) -->
      <div class="lg:col-span-5 relative flex items-center justify-center w-full">
        <!-- Glowing Aura Backdrops -->
        <div class="absolute -inset-4 bg-gradient-to-tr from-emerald-500/20 via-cyan-500/15 to-teal-500/20 rounded-3xl blur-2xl opacity-70 pointer-events-none"></div>

        <!-- Backbone Console Glass Container -->
        <div class="relative w-full max-w-[490px] rounded-3xl overflow-hidden border border-emerald-500/35 bg-[#0a1521]/90 backdrop-blur-xl shadow-[0_25px_60px_rgba(0,30,18,0.5)] flex flex-col gap-4 p-5 select-none group">
          
          <!-- Top ISP Status & AS Routing Header -->
          <div class="flex items-center justify-between pb-3 border-b border-emerald-500/20">
            <div class="flex items-center gap-2.5">
              <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
              </span>
              <div>
                <div class="text-[11.5px] font-bold text-emerald-300 uppercase tracking-wider flex items-center gap-1.5">
                  <span>ISP BACKBONE ROUTING</span>
                  <span class="px-1.5 py-0.5 rounded text-[9px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">ONLINE</span>
                </div>
                <div class="text-[10px] text-slate-400 font-mono">BGP4 • Multi-Homed Auto-Failover</div>
              </div>
            </div>

            <div class="text-right">
              <div class="text-[10px] text-slate-400 uppercase font-semibold">Backbone Latency</div>
              <div id="isp-live-latency" class="text-sm font-mono font-bold text-emerald-400">0.8 ms</div>
            </div>
          </div>

          <!-- Active Backbone Links & PoP Status -->
          <div class="space-y-2">
            <div class="text-[11px] font-bold text-slate-300 uppercase tracking-wider flex items-center justify-between">
              <span>Core PoP &amp; Upstream Status</span>
              <span class="text-[10px] text-emerald-400 font-mono">All Links Optimal</span>
            </div>

            <!-- Route 1: Global Transit -->
            <div class="p-2.5 rounded-xl bg-[#0e1d2c]/80 border border-emerald-500/20 flex items-center justify-between hover:border-emerald-500/40 transition-colors">
              <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-[16px]">public</span>
                </div>
                <div>
                  <div class="text-xs font-bold text-white">Global Tier-1 IP Transit</div>
                  <div class="text-[10px] text-slate-400">Equinix SG1 / SingTel / Telin Gateway</div>
                </div>
              </div>
              <span class="text-[11px] font-mono font-bold text-cyan-400">100G Active</span>
            </div>

            <!-- Route 2: Domestic Peering -->
            <div class="p-2.5 rounded-xl bg-[#0e1d2c]/80 border border-emerald-500/20 flex items-center justify-between hover:border-emerald-500/40 transition-colors">
              <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-[16px]">hub</span>
                </div>
                <div>
                  <div class="text-xs font-bold text-white">Domestic IXP Direct Peering</div>
                  <div class="text-[10px] text-slate-400">IIX / OpenIXP / CDIX / Cloudflare / Google</div>
                </div>
              </div>
              <span class="text-[11px] font-mono font-bold text-emerald-400">&lt; 1 ms</span>
            </div>

            <!-- Route 3: Subsea Cable & DWDM -->
            <div class="p-2.5 rounded-xl bg-[#0e1d2c]/80 border border-emerald-500/20 flex items-center justify-between hover:border-emerald-500/40 transition-colors">
              <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-teal-500/20 text-teal-300 flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-[16px]">cable</span>
                </div>
                <div>
                  <div class="text-xs font-bold text-white">Redundant Subsea &amp; Terrestrial Ring</div>
                  <div class="text-[10px] text-slate-400">Medan - Jakarta - Surabaya - Bali - IKN</div>
                </div>
              </div>
              <span class="text-[11px] font-mono font-bold text-teal-300">Protected</span>
            </div>
          </div>

          <!-- Live Backbone Throughput Oscilloscope -->
          <div class="p-3 rounded-2xl bg-[#07111b] border border-emerald-500/25 flex flex-col gap-2">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2">
                <div class="flex items-end gap-0.5 h-3.5">
                  <span class="w-1 bg-emerald-400 rounded-full animate-[barWave_1.2s_ease-in-out_infinite] h-2"></span>
                  <span class="w-1 bg-emerald-400 rounded-full animate-[barWave_1.2s_ease-in-out_0.2s_infinite] h-3.5"></span>
                  <span class="w-1 bg-emerald-400 rounded-full animate-[barWave_1.2s_ease-in-out_0.4s_infinite] h-2.5"></span>
                  <span class="w-1 bg-emerald-400 rounded-full animate-[barWave_1.2s_ease-in-out_0.1s_infinite] h-3"></span>
                </div>
                <span class="text-[11px] font-bold text-slate-200">Aggregate Backbone Load:</span>
                <span class="text-[11px] font-mono font-bold text-emerald-400" id="isp-throughput">98.4 Gbps</span>
              </div>

              <button type="button" id="btn-traceroute-burst" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-500/25 hover:bg-emerald-500/40 text-emerald-300 border border-emerald-500/50 text-[11px] font-bold transition-all active:scale-95 shadow-sm hover:shadow-[0_0_18px_rgba(16,185,129,0.4)] cursor-pointer">
                <span class="material-symbols-outlined text-[15px]">electric_bolt</span>
                <span>Trace Route Burst</span>
              </button>
            </div>

            <!-- Real-Time Traffic Signal Oscilloscope -->
            <div class="relative w-full h-8 overflow-hidden rounded-lg bg-[#040910] border border-emerald-500/15">
              <canvas id="isp-sparkline-canvas" class="w-full h-full block"></canvas>
            </div>

            <!-- Traceroute Live Feedback Row -->
            <div id="traceroute-log" class="text-[10px] font-mono text-emerald-400/90 truncate flex items-center gap-1.5 pt-0.5">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
              <span>Route: Gretta Core (0.4ms) &rarr; Jakarta IXP (0.9ms) &rarr; SG1 Tier-1 (4.2ms)</span>
            </div>
          </div>

          <!-- Stats Ticker -->
          <div class="grid grid-cols-3 gap-2 text-center pt-1 border-t border-emerald-500/15">
            <div>
              <div class="text-[9px] text-slate-400 uppercase font-semibold">BGP Prefixes</div>
              <div class="text-xs font-mono font-bold text-white">952,410+</div>
            </div>
            <div>
              <div class="text-[9px] text-slate-400 uppercase font-semibold">Packet Rate</div>
              <div id="isp-packets" class="text-xs font-mono font-bold text-emerald-400">94.8 Mpps</div>
            </div>
            <div>
              <div class="text-[9px] text-slate-400 uppercase font-semibold">Packet Loss</div>
              <div class="text-xs font-mono font-bold text-emerald-300">0.000%</div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
<!-- PROFIL PERUSAHAAN & AREA LAYANAN (Page 2 Source Data) -->
<section id="tentang-kami" class="w-full bg-surface-container-low py-20 scroll-mt-20">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<!-- Section Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
<div>
<div class="flex items-center gap-2 mb-2 text-primary font-label-md text-label-md font-bold uppercase tracking-wider">
<span class="w-2 h-2 rounded-full bg-primary"></span>
            Profil Perusahaan &amp; Ekosistem
          </div>
<h2 class="font-headline-lg text-headline-lg font-bold text-on-surface">
            Mitra Transformasi Digital Terpercaya
          </h2>
</div>
<p class="font-body-md text-body-md text-on-surface-variant max-w-lg">
          Kami menghadirkan solusi inovatif dan terpercaya di bidang teknologi, sistem telekomunikasi, serta perangkat digital untuk mendukung perkembangan dan kesuksesan bisnis Anda.
        </p>
</div>
<!-- Core Bento Layout -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
<!-- Area Layanan Card with Visual Coverage (Col 7) -->
<div class="lg:col-span-7 bg-surface-container-lowest p-8 rounded-2xl shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-6">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex items-center justify-center">
<span class="material-symbols-outlined text-headline-sm">public</span>
</div>
<div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface">Area Jangkauan Layanan Nasional</h3>
<p class="font-label-sm text-label-sm text-outline">Penyebaran infrastruktur dan tim teknis lapangan</p>
</div>
</div>
<span class="hidden sm:inline-flex px-3 py-1 rounded-full bg-surface-container-highest text-tertiary font-label-sm text-label-sm font-semibold">
                HQ: Medan, Sumut
              </span>
</div>
<div class="p-4 bg-surface-container-low rounded-xl mb-6">
<div class="flex items-start gap-3">
<span class="material-symbols-outlined text-primary text-title-lg mt-0.5">warehouse</span>
<div>
<h4 class="font-title-md text-title-md font-bold text-on-surface">Kantor Pusat dan Logistik</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
{{ $profile->alamatPerusahan ?? 'Jalan Ujung Serdang, Kec. Tanjung Morawa, Kab. Deli Serdang, Sumatera Utara' }}
</p>
</div>
</div>
</div>
<p class="font-label-sm text-label-sm font-bold text-on-surface uppercase tracking-wider mb-3">
              Wilayah Operasional Terintegrasi:
            </p>
<div class="grid grid-cols-2 sm:grid-cols-{{ count($areas) > 0 ? min(count($areas), 5) : 5 }} gap-3">
@forelse($areas as $area)
<div class="flex flex-col items-center justify-center p-3 rounded-lg bg-surface text-center hover:bg-secondary-fixed/20 transition-colors">
<span class="material-symbols-outlined text-secondary text-title-lg mb-1">map</span>
<span class="font-title-md text-title-md font-bold text-on-surface">{{ $area->namaWilayah }}</span>
<span class="font-label-sm text-label-sm text-outline truncate max-w-full">{{ $area->keterangan ?: 'Operasional' }}</span>
</div>
@empty
<div class="flex flex-col items-center justify-center p-3 rounded-lg bg-surface text-center hover:bg-secondary-fixed/20 transition-colors">
<span class="material-symbols-outlined text-secondary text-title-lg mb-1">map</span>
<span class="font-title-md text-title-md font-bold text-on-surface">Sumatera</span>
<span class="font-label-sm text-label-sm text-outline">Hub &amp; Cabang</span>
</div>
<div class="flex flex-col items-center justify-center p-3 rounded-lg bg-surface text-center hover:bg-secondary-fixed/20 transition-colors">
<span class="material-symbols-outlined text-secondary text-title-lg mb-1">domain</span>
<span class="font-title-md text-title-md font-bold text-on-surface">Jawa</span>
<span class="font-label-sm text-label-sm text-outline">Mitra &amp; Proyek</span>
</div>
<div class="flex flex-col items-center justify-center p-3 rounded-lg bg-surface text-center hover:bg-secondary-fixed/20 transition-colors">
<span class="material-symbols-outlined text-secondary text-title-lg mb-1">apartment</span>
<span class="font-title-md text-title-md font-bold text-on-surface">Bali</span>
<span class="font-label-sm text-label-sm text-outline">Hospitality IT</span>
</div>
<div class="flex flex-col items-center justify-center p-3 rounded-lg bg-surface text-center hover:bg-secondary-fixed/20 transition-colors">
<span class="material-symbols-outlined text-secondary text-title-lg mb-1">factory</span>
<span class="font-title-md text-title-md font-bold text-on-surface">Kalimantan</span>
<span class="font-label-sm text-label-sm text-outline">Industrial IoT</span>
</div>
<div class="flex flex-col items-center justify-center p-3 rounded-lg bg-surface text-center hover:bg-secondary-fixed/20 transition-colors">
<span class="material-symbols-outlined text-secondary text-title-lg mb-1">lan</span>
<span class="font-title-md text-title-md font-bold text-on-surface">Sulawesi</span>
<span class="font-label-sm text-label-sm text-outline">Healthcare Net</span>
</div>
@endforelse
</div>
</div>
<div class="mt-6 pt-4 flex items-center justify-between text-outline text-body-sm">
<span class="">Dukungan logistik cepat via jalur darat, laut, dan udara terkoordinasi.</span>
<span class="material-symbols-outlined text-secondary">verified</span>
</div>
</div>
<!-- Visi & Misi Perusahaan (Col 5) -->
<div class="lg:col-span-5 flex flex-col justify-between gap-6">
<!-- Visi Card -->
<div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm flex-1 flex flex-col justify-between border-l-4 border-primary">
<div class="flex items-start gap-4">
<div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-title-lg">visibility</span>
</div>
<div>
<span class="font-label-sm text-label-sm font-bold uppercase text-primary tracking-wider">Visi Perusahaan</span>
<p class="font-body-md text-body-md text-on-surface font-semibold mt-2 leading-relaxed">
{{ $visionMission->visi ?? 'Menjadi penyedia solusi teknologi informasi, infrastruktur jaringan, dan integrasi sistem enterprise terdepan di Indonesia.' }}
</p>
</div>
</div>
<div class="mt-4 pt-3 flex items-center gap-2 text-primary font-label-sm text-label-sm font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
Komitmen Standar Kualitas Tinggi
</div>
</div>
<!-- Misi Card -->
<div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm flex-1 flex flex-col justify-between border-l-4 border-secondary">
<div class="flex items-start gap-4">
<div class="w-10 h-10 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-title-lg">rocket_launch</span>
</div>
<div class="w-full">
<span class="font-label-sm text-label-sm font-bold uppercase text-secondary tracking-wider">Misi Perusahaan</span>
<div class="text-body-sm text-on-surface-variant leading-relaxed mt-2" style="white-space: pre-line;">{{ $visionMission->misi ?? "1. Menghadirkan infrastruktur telekomunikasi dan jaringan berkinerja tinggi serta berkehandalan tinggi.\n2. Memberikan layanan solusi digital cerdas terpadu bagi sektor kesehatan, korporasi, dan industri.\n3. Menyediakan dukungan teknis purna jual yang proaktif dengan standar SLA enterprise." }}</div>
</div>
</div>
<div class="mt-4 pt-3 flex items-center gap-2 text-secondary font-label-sm text-label-sm font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
Inovasi &amp; Pertumbuhan Berkelanjutan
</div>
</div>
</div>
</div>
</div>
</section>
<!-- BISNIS & PRODUK LAYANAN (10 Core Pillars Grid) -->
<section class="w-full bg-surface py-20 scroll-mt-20" id="layanan">
<div id="layanan-portofolio" class="scroll-mt-20"></div>
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<!-- Section Head -->
<div class="text-center max-w-3xl mx-auto mb-16">
<span class="px-4 py-1.5 rounded-full bg-primary/10 text-primary font-label-sm text-label-sm uppercase font-bold tracking-widest">
          Comprehensive Capabilities
        </span>
<h2 class="font-headline-lg text-headline-lg font-extrabold text-on-surface mt-3 mb-4">
          10 Pilar Layanan Solusi Bisnis &amp; IT Terintegrasi
        </h2>
<p class="font-body-md text-body-md text-on-surface-variant">
          Penyediaan menyeluruh dari lapisan konektivitas fisik, perangkat keras dan server berlisensi, sistem keamanan digital, hingga piranti lunak enterprise.
        </p>
</div>
<!-- 10 Pillars Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<!-- 1. CONNECTIVITY -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div>
<div class="w-14 h-14 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-on-primary transition-all duration-300">
<span class="material-symbols-outlined text-headline-md">cell_tower</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold text-primary uppercase">Pilar 01</span>
<span class="font-label-sm text-label-sm text-outline">High-Availability</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-3">Connectivity &amp; Networking</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Solusi konektivitas canggih dirancang khusus: jaringan perkantoran berkecepatan tinggi, infrastruktur aman untuk rumah sakit, hingga industrial IoT pabrik dengan dedicated bandwidth &amp; pemantauan 24/7.
            </p>
</div>
<div class="mt-6 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 p-4 rounded-b-2xl flex items-center justify-between text-on-surface font-label-sm text-label-sm">
<span class="">Fiber Optic &amp; SD-WAN Ready</span>
<span class="material-symbols-outlined text-secondary text-title-md">arrow_forward</span>
</div>
</div>
<!-- 2. INTEGRATED CCTV -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div>
<div class="w-14 h-14 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-6 group-hover:bg-secondary group-hover:text-on-secondary transition-all duration-300">
<span class="material-symbols-outlined text-headline-md">videocam</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold text-secondary uppercase">Pilar 02</span>
<span class="font-label-sm text-label-sm text-outline">Surveillance</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-3">Integrated Smart CCTV</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Pengadaan, instalasi, dan konfigurasi sistem pengawasan digital terpadu (IP Camera berdefinisi tinggi, Access Control biometrik, NVR/DVR server dengan enkripsi data aman).
            </p>
</div>
<div class="mt-6 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 p-4 rounded-b-2xl flex items-center justify-between text-on-surface font-label-sm text-label-sm">
<span class="">Multi-site Central Monitoring</span>
<span class="material-symbols-outlined text-secondary text-title-md">arrow_forward</span>
</div>
</div>
<!-- 3. IT SERVICE -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div>
<div class="w-14 h-14 rounded-xl bg-tertiary/10 text-tertiary flex items-center justify-center mb-6 group-hover:bg-tertiary group-hover:text-on-tertiary transition-all duration-300">
<span class="material-symbols-outlined text-headline-md">engineering</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold text-tertiary uppercase">Pilar 03</span>
<span class="font-label-sm text-label-sm text-outline">Maintenance</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-3">IT Service &amp; Maintenance</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Layanan pemeliharaan sistem proaktif, penanganan troubleshooting cepat tanggap, serta dukungan teknis berkala onsite/remote untuk menjamin performa operasional bebas downtime.
            </p>
</div>
<div class="mt-6 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 p-4 rounded-b-2xl flex items-center justify-between text-on-surface font-label-sm text-label-sm">
<span class="">SLA Response 15 Menit</span>
<span class="material-symbols-outlined text-secondary text-title-md">arrow_forward</span>
</div>
</div>
<!-- 4. DIGITAL SOLUTIONS -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div>
<div class="w-14 h-14 rounded-xl bg-primary-container/20 text-primary-container flex items-center justify-center mb-6 group-hover:bg-primary-container group-hover:text-on-primary transition-all duration-300">
<span class="material-symbols-outlined text-headline-md">code</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold text-primary uppercase">Pilar 04</span>
<span class="font-label-sm text-label-sm text-outline">Software Dev</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-3">Digital Solutions &amp; Web Apps</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Jasa pembuatan &amp; rekayasa perangkat lunak modern: portal enterprise, landing page berkonversi tinggi, integrasi API sistem pihak ketiga, serta aplikasi web &amp; mobile kustom bisnis Anda.
            </p>
</div>
<div class="mt-6 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 p-4 rounded-b-2xl flex items-center justify-between text-on-surface font-label-sm text-label-sm">
<span class="">Custom UI/UX &amp; Cloud Native</span>
<span class="material-symbols-outlined text-secondary text-title-md">arrow_forward</span>
</div>
</div>
<!-- 5. PROCUREMENT (PENGADAAN) -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div>
<div class="w-14 h-14 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-6 group-hover:bg-secondary group-hover:text-on-secondary transition-all duration-300">
<span class="material-symbols-outlined text-headline-md">inventory_2</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold text-secondary uppercase">Pilar 05</span>
<span class="font-label-sm text-label-sm text-outline">Supply Chain</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-3">Procurement &amp; Hardware Supply</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Mitra resmi pengadaan kabel Fiber Optic, UTP, managed switch, router enterprise, server rack, PC all-in-one, dan perlengkapan pasif jaringan dengan jaminan garansi distributor resmi.
            </p>
</div>
<div class="mt-6 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 p-4 rounded-b-2xl flex items-center justify-between text-on-surface font-label-sm text-label-sm">
<span class="">Distributor Resmi Garansi 100%</span>
<span class="material-symbols-outlined text-secondary text-title-md">arrow_forward</span>
</div>
</div>
<!-- 6. HARDWARE & SOFTWARE -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div>
<div class="w-14 h-14 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-on-primary transition-all duration-300">
<span class="material-symbols-outlined text-headline-md">computer</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold text-primary uppercase">Pilar 06</span>
<span class="font-label-sm text-label-sm text-outline">Licenses &amp; Gear</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-3">Enterprise Hardware &amp; Software</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Ekosistem workstation, laptop korporasi, storage berskala petabyte, enterprise printer, dan lisensi resmi (Microsoft Server, database enterprise, software multimedia interaktif &amp; edukasi).
            </p>
</div>
<div class="mt-6 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 p-4 rounded-b-2xl flex items-center justify-between text-on-surface font-label-sm text-label-sm">
<span class="">Genuine Software Assurance</span>
<span class="material-symbols-outlined text-secondary text-title-md">arrow_forward</span>
</div>
</div>
<!-- 7. SECURITY & ELECTRONIC -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div>
<div class="w-14 h-14 rounded-xl bg-tertiary/10 text-tertiary flex items-center justify-center mb-6 group-hover:bg-tertiary group-hover:text-on-tertiary transition-all duration-300">
<span class="material-symbols-outlined text-headline-md">shield</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold text-tertiary uppercase">Pilar 07</span>
<span class="font-label-sm text-label-sm text-outline">Cyber &amp; Physical</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-3">Security &amp; Electronic Systems</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Proteksi siber endpoint hingga firewall terpusat (anti-ransomware, DLP), serta integrasi sistem elektronik cerdas seperti IP PBX telepon kantor dan otomasi sensor lingkungan server.
            </p>
</div>
<div class="mt-6 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 p-4 rounded-b-2xl flex items-center justify-between text-on-surface font-label-sm text-label-sm">
<span class="">Next-Gen Firewall Security</span>
<span class="material-symbols-outlined text-secondary text-title-md">arrow_forward</span>
</div>
</div>
<!-- 8. SEWA PERANGKAT IT -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div>
<div class="w-14 h-14 rounded-xl bg-primary-container/20 text-primary-container flex items-center justify-center mb-6 group-hover:bg-primary-container group-hover:text-on-primary transition-all duration-300">
<span class="material-symbols-outlined text-headline-md">devices</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold text-primary uppercase">Pilar 08</span>
<span class="font-label-sm text-label-sm text-outline">OPEX Optimization</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-3">Rental &amp; Sewa Perangkat IT</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Solusi rental laptop, workstation PC, dan rack server untuk efisiensi CAPEX/OPEX perusahaan. Unit selalu terbarui dengan hardware generasi mutakhir tanpa risiko depresiasi nilai aset.
            </p>
</div>
<div class="mt-6 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 p-4 rounded-b-2xl flex items-center justify-between text-on-surface font-label-sm text-label-sm">
<span class="">Fleksibel Bulanan / Tahunan</span>
<span class="material-symbols-outlined text-secondary text-title-md">arrow_forward</span>
</div>
</div>
<!-- 9. VIRTUALIZATION & DISPLAY -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div>
<div class="w-14 h-14 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-6 group-hover:bg-secondary group-hover:text-on-secondary transition-all duration-300">
<span class="material-symbols-outlined text-headline-md">monitor</span>
</div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold text-secondary uppercase">Pilar 09</span>
<span class="font-label-sm text-label-sm text-outline">Infra &amp; Visual</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-3">Virtualization &amp; Video Display</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Arsitektur virtualisasi server (VMware/Proxmox) untuk konsolidasi beban kerja, serta sistem visual display interaktif: videowall command center, signage digital informasi publik.
            </p>
</div>
<div class="mt-6 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 p-4 rounded-b-2xl flex items-center justify-between text-on-surface font-label-sm text-label-sm">
<span class="">Command Center Display Setup</span>
<span class="material-symbols-outlined text-secondary text-title-md">arrow_forward</span>
</div>
</div>
<!-- 10. IT CONSULTANT (Spans full on medium/desktop for accent) -->
<div class="group bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 md:col-span-2 lg:col-span-3 flex flex-col md:flex-row items-center justify-between gap-6">
<div class="flex items-start gap-5">
<div class="w-14 h-14 rounded-xl bg-primary text-on-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-headline-md">psychology</span>
</div>
<div>
<div class="flex items-center gap-3 mb-1">
<span class="font-label-sm text-label-sm font-bold text-primary uppercase">Pilar 10</span>
<span class="px-2 py-0.5 rounded bg-surface-container font-label-sm text-label-sm text-tertiary">Strategic Advisory</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface">IT Consultant &amp; Enterprise Architecture Audit</h3>
<p class="font-body-md text-body-md text-on-surface-variant max-w-3xl mt-1 leading-relaxed">
                Konsultasi arsitektur IT komprehensif, evaluasi kelayakan sistem, audit keamanan siber, dan penyusunan blueprint rencana jangka panjang digitalisasi organisasi agar investasi tepat sasaran.
              </p>
</div>
</div>
<a class="shrink-0 px-6 py-3 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-bold hover:bg-primary transition-colors flex items-center gap-2" href="#kontak-konsultasi">
<span class="">Diskusi Bersama Konsultan</span>
<span class="material-symbols-outlined text-title-md">arrow_forward</span>
</a>
</div>
</div>
</div>
</section>
<!-- PORTOFOLIO PROYEK & STUDI KASUS -->
<section class="w-full bg-surface-container-lowest py-20 relative overflow-hidden scroll-mt-20" id="portofolio">
<div id="solusi-simrs" class="scroll-mt-20"></div>
<!-- Subtle architectural glow backdrops -->
<div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
<div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/5 rounded-full blur-3xl pointer-events-none"></div>

<div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
<!-- Section Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
<div>
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary-fixed/30 text-on-secondary-fixed font-label-sm text-label-sm font-bold uppercase tracking-wider mb-3">
<span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
Featured Projects &amp; Case Studies
</div>
<h2 class="font-headline-lg text-headline-lg font-extrabold text-on-surface tracking-tight">
Portofolio Implementasi &amp; Rekam Jejak Solusi
</h2>
</div>
<p class="font-body-md text-body-md text-on-surface-variant max-w-lg">
Berbagai proyek strategis teknologi informasi dan infrastruktur jaringan yang telah sukses kami implementasikan untuk mitra rumah sakit, manufaktur, dan instansi korporasi.
</p>
</div>

<!-- 4 Core Featured Portfolio Cards -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
@forelse($portfolios as $port)
@php
  $firstImg = null;
  if (!empty($port->gambar) && is_array($port->gambar) && count($port->gambar) > 0) {
      $img = $port->gambar[0];
      $firstImg = \Illuminate\Support\Str::startsWith($img, 'http') ? $img : asset('storage/' . $img);
  }
@endphp
<div class="group bg-surface-container-low rounded-2xl overflow-hidden border border-outline-variant/30 hover:border-primary/40 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div class="relative w-full h-64 overflow-hidden bg-inverse-surface">
@if($firstImg)
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $port->namaProject }}" src="{{ $firstImg }}">
@else
<div class="w-full h-full bg-gradient-to-br from-primary/20 via-surface-container-high to-surface-container-lowest flex items-center justify-center text-primary group-hover:scale-105 transition-transform duration-500">
<span class="material-symbols-outlined text-display-lg opacity-40">hub</span>
</div>
@endif
<div class="absolute inset-0 bg-gradient-to-t from-inverse-surface via-transparent to-transparent"></div>
<div class="absolute top-4 left-4">
<span class="px-3 py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md text-primary font-label-sm text-label-sm font-bold shadow-sm">
Proyek Terverifikasi
</span>
</div>
<div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
<span class="font-label-sm text-label-sm font-semibold truncate">{{ $port->namaProject }}</span>
<span class="px-2.5 py-0.5 rounded bg-secondary text-on-secondary font-label-sm text-label-sm font-bold shrink-0">Enterprise Solution</span>
</div>
</div>
<div class="p-6 lg:p-8 flex flex-col flex-1 justify-between gap-6">
<div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">
{{ $port->namaProject }}
</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed line-clamp-3">
{{ $port->keterangan }}
</p>
</div>
@if(!empty($port->gambar) && is_array($port->gambar) && count($port->gambar) > 1)
<div class="flex items-center gap-2 pt-2 border-t border-outline-variant/30">
<span class="text-xs font-semibold text-outline">Galeri Foto ({{ count($port->gambar) }}):</span>
<div class="flex items-center gap-1.5">
@foreach($port->gambar as $gIdx => $gItem)
@php
  $thumb = \Illuminate\Support\Str::startsWith($gItem, 'http') ? $gItem : asset('storage/' . $gItem);
@endphp
<img src="{{ $thumb }}" alt="Foto {{ $gIdx+1 }}" class="w-8 h-8 rounded object-cover border border-outline-variant/50">
@endforeach
</div>
</div>
@endif
</div>
</div>
@empty
<div class="group bg-surface-container-low rounded-2xl overflow-hidden border border-outline-variant/30 hover:border-primary/40 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div class="relative w-full h-64 overflow-hidden bg-inverse-surface">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="SIMRS dan Rekam Medis Elektronik Rumah Sakit" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzATl5LVFZWz_kWEL8CgNVIfQ0Vvkm1s0IzupPhzSvMGq16MArNiBBEHaG3TzrrVX3ohfLTTT0RbZdZYK6QdaTTDmK3TejG5mFPWCEFqOSX0dMpv0QX8ABU9OGSBfAb_A6PrRZsOM4C2BGAF2biKBET4zeq6_PcBOmt8c6m2tzmim-4x_z41lxgxXOeIC7CFStyDJO37EaXxP3lzhesHtpVcgiPaMTaRnfBqpVOR8_H6uyDZ5FHs2s3w">
<div class="absolute inset-0 bg-gradient-to-t from-inverse-surface via-transparent to-transparent"></div>
<div class="absolute top-4 left-4">
<span class="px-3 py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md text-primary font-label-sm text-label-sm font-bold shadow-sm">
Healthcare Digital Solution
</span>
</div>
<div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
<span class="font-label-sm text-label-sm font-semibold">Klien: Fasilitas Layanan Kesehatan &amp; Rumah Sakit</span>
<span class="px-2.5 py-0.5 rounded bg-secondary text-on-secondary font-label-sm text-label-sm font-bold">Uptime 99.8%</span>
</div>
</div>
<div class="p-6 lg:p-8 flex flex-col flex-1 justify-between gap-6">
<div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">
Implementasi SIMRS &amp; Rekam Medis Elektronik (RME) Terstandar
</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
Digitalisasi alur kerja klinis dan manajerial rumah sakit: E-RM terstandar Kemenkes SatuSehat, antrian poliklinik online, bridging BPJS V-Claim, modul farmasi apotek, kasir, hingga rawat inap dengan dukungan support 24/7.
</p>
</div>
<div class="flex flex-wrap gap-2 pt-2 border-t border-outline-variant/30">
<span class="px-2.5 py-1 rounded-lg bg-surface text-primary font-label-sm text-label-sm font-medium">SatuSehat Kemenkes</span>
<span class="px-2.5 py-1 rounded-lg bg-surface text-secondary font-label-sm text-label-sm font-medium">Rekam Medis Elektronik (RME)</span>
<span class="px-2.5 py-1 rounded-lg bg-surface text-tertiary font-label-sm text-label-sm font-medium">BPJS V-Claim Bridging</span>
</div>
</div>
</div>

<div class="group bg-surface-container-low rounded-2xl overflow-hidden border border-outline-variant/30 hover:border-primary/40 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div class="relative w-full h-64 overflow-hidden bg-inverse-surface">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-80" alt="Infrastruktur Jaringan Fiber Optik dan SD WAN" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6rftE6fFy0-fkXc0q_ewyNHtTyqOOr1cpjTJ1tAe5MWLecF6BKjtY7lX2VgmFhFN6e_6XQL3c4wmum6ER79FqfwBrZuqFf9VSGtuETaNWMg7GWFYYU3Pr6Hev220nBZo-t7RiPdKQEi2dkc2N14saiuy2YNwLXABaav3KhrFTcYc9XfTT7-UCR-5ZdbpjZwfCfXkn0saY37x3n56cio6ALDG5cbC8ZUQPHT3uZcRcaJ5E5PI2ecIclA">
<div class="absolute inset-0 bg-gradient-to-t from-inverse-surface via-transparent to-transparent"></div>
<div class="absolute top-4 left-4">
<span class="px-3 py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md text-secondary font-label-sm text-label-sm font-bold shadow-sm">
Telecommunication &amp; Networking
</span>
</div>
<div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
<span class="font-label-sm text-label-sm font-semibold">Klien: Korporasi FMCG &amp; Industrial Estate</span>
<span class="px-2.5 py-0.5 rounded bg-primary-fixed-dim text-on-primary-fixed font-label-sm text-label-sm font-bold">99.99% SLA Uptime</span>
</div>
</div>
<div class="p-6 lg:p-8 flex flex-col flex-1 justify-between gap-6">
<div>
<h3 class="font-title-lg text-title-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">
Penggelaran Jaringan Dedicated Fiber Optic &amp; SD-WAN Inter-Branch
</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
Penyediaan link dedicated internet 1:1, jalur transmisi fiber optic redundant, dan arsitektur SD-WAN terpusat untuk menghubungkan kantor pusat, pabrik manufaktur, dan gudang distribusi secara cepat dan stabil.
</p>
</div>
<div class="flex flex-wrap gap-2 pt-2 border-t border-outline-variant/30">
<span class="px-2.5 py-1 rounded-lg bg-surface text-primary font-label-sm text-label-sm font-medium">Dedicated FO 10 Gbps</span>
<span class="px-2.5 py-1 rounded-lg bg-surface text-secondary font-label-sm text-label-sm font-medium">Auto-Failover Link</span>
</div>
</div>
</div>
@endforelse
</div>

<!-- Bottom View All Portfolios CTA -->
<div class="mt-10 text-center">
<a href="{{ route('public.portofolio') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-primary text-on-primary font-title-md text-title-md font-bold hover:bg-primary/90 transition-all shadow-md hover:shadow-lg">
<span>Lihat Semua Portofolio Proyek</span>
<span class="material-symbols-outlined text-title-md">arrow_forward</span>
</a>
</div>

<!-- Bottom Consultation Banner -->
<div class="mt-12 p-6 lg:p-8 rounded-2xl bg-gradient-to-r from-primary to-primary-container text-on-primary flex flex-col md:flex-row items-center justify-between gap-6 shadow-lg">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-secondary-fixed text-headline-sm">folder_special</span>
</div>
<div>
<h4 class="font-title-lg text-title-lg font-bold">Ingin Mengimplementasikan Proyek Serupa untuk Perusahaan Anda?</h4>
<p class="font-body-sm text-body-sm text-primary-fixed-dim">Diskusikan kebutuhan spesifikasi teknis dan estimasi rancangan anggaran bersama konsultan kami.</p>
</div>
</div>
<a class="shrink-0 px-6 py-3 rounded-lg bg-secondary text-on-secondary font-label-md text-label-md font-bold hover:bg-secondary-container hover:text-on-secondary-container transition-all shadow-md" href="#kontak-konsultasi">
Konsultasi Proyek Anda
</a>
</div>

</div>
</section>
<!-- SLA & MANAGED SERVICES GUARANTEE (Page 11 Data) -->
<section class="w-full bg-surface-container-low py-16">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<div class="bg-primary text-on-primary rounded-3xl p-8 lg:p-12 shadow-xl relative overflow-hidden">
<!-- SVG Circuit backdrop -->
<svg class="absolute inset-0 w-full h-full opacity-10 pointer-events-none" xmlns="http://www.w3.org/2000/svg">
<pattern height="60" id="sla-pattern" patternUnits="userSpaceOnUse" width="60">
<path d="M 60 0 L 0 0 0 60" fill="none" stroke="currentColor" stroke-width="1"></path>
<circle cx="60" cy="0" fill="currentColor" r="3"></circle>
</pattern>
<rect fill="url(#sla-pattern)" height="100%" width="100%"></rect>
</svg>
<div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
<div class="lg:col-span-8">
<span class="inline-block px-3 py-1 rounded-full bg-secondary text-on-secondary font-label-sm text-label-sm font-bold uppercase tracking-wider mb-4">
              Jaminan Layanan Korporasi
            </span>
<h2 class="font-headline-lg text-headline-lg font-bold mb-4 leading-tight">
              Service Level Agreement (SLA) &amp; Managed Services Berkelanjutan
            </h2>
<p class="font-body-lg text-body-lg text-primary-fixed-dim leading-relaxed mb-6">
              Skema SLA kami didukung Helpdesk responsif, eskalasi terstruktur cepat ke tim insinyur ahli, serta didukung langsung oleh principal distributor resmi perangkat untuk garansi purna jual prima. Seluruh kesepakatan fleksibel disesuaikan dengan tingkat urgensi dan intensitas operasional bisnis Anda.
            </p>
<div class="flex flex-wrap gap-4">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary-fixed">support_agent</span>
<span class="font-title-md text-title-md font-semibold">Helpdesk Siaga 24/7/365</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary-fixed">assignment_turned_in</span>
<span class="font-title-md text-title-md font-semibold">Penggantian Sparepart Prioritas</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary-fixed">verified_user</span>
<span class="font-title-md text-title-md font-semibold">Garansi Resmi Principal</span>
</div>
</div>
</div>
<div class="lg:col-span-4 bg-primary-container p-6 rounded-2xl flex flex-col items-center text-center shadow-md">
<div class="w-16 h-16 rounded-full bg-secondary-fixed/20 text-secondary-fixed flex items-center justify-center mb-3">
<span class="material-symbols-outlined text-display-xl-mobile">timer</span>
</div>
<span class="font-headline-lg text-headline-lg font-extrabold text-on-primary">15 - 30 Menit</span>
<span class="font-label-md text-label-md text-primary-fixed uppercase tracking-wider font-bold mt-1">First Incident Response Time</span>
<p class="font-body-sm text-body-sm text-primary-fixed-dim mt-2">
              Jalur eskalasi darurat tersedia via tiket portal otomatis dan hotline telepon khusus enterprise.
            </p>
</div>
</div>
</div>
</div>
</section>
<!-- PORTOFOLIO CUSTOMER / KLIEN (Page 5, 12 Data) -->
<section class="w-full bg-surface py-20 scroll-mt-20" id="klien">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<!-- Section Title -->
<div class="text-center max-w-3xl mx-auto mb-16">
<span class="px-3.5 py-1.5 rounded-full bg-secondary/10 text-secondary font-label-sm text-label-sm uppercase font-bold tracking-widest">
          Verified Track Record
        </span>
<h2 class="font-headline-lg text-headline-lg font-bold text-on-surface mt-3 mb-4">
          Portofolio Pelanggan &amp; Mitra Strategis
        </h2>
<p class="font-body-md text-body-md text-on-surface-variant">
          Dipercaya oleh kementerian dan lembaga pemerintah, fasilitas layanan kesehatan, koperasi nasional, hingga konglomerasi industri multinasional.
        </p>
</div>
<!-- Customer Diamond / Card Grid matching company presentation -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
<!-- 1. KANTOR DESA -->
<div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-headline-md">account_balance</span>
</div>
<span class="font-title-md text-title-md font-bold text-on-surface">Kantor Desa</span>
<span class="font-label-sm text-label-sm text-outline mt-1">Pemerintahan Daerah &amp; Jaringan Desa</span>
</div>
<!-- 2. PUSKESMAS -->
<div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-headline-md">local_hospital</span>
</div>
<span class="font-title-md text-title-md font-bold text-on-surface">Puskesmas</span>
<span class="font-label-sm text-label-sm text-outline mt-1">Fasilitas Kesehatan Tingkat Pertama</span>
</div>
<!-- 3. PT GARUDA FOOD -->
<div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-xl bg-tertiary/10 text-tertiary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-headline-md">factory</span>
</div>
<span class="font-title-md text-title-md font-bold text-on-surface">PT Garuda Food</span>
<span class="font-label-sm text-label-sm text-outline mt-1">Industrial Enterprise &amp; FMCG</span>
</div>
<!-- 4. BGN MBG (Badan Gizi Nasional) -->
<div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-xl bg-primary-container/20 text-primary-container flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-headline-md">shield_person</span>
</div>
<span class="font-title-md text-title-md font-bold text-on-surface">BGN MBG</span>
<span class="font-label-sm text-label-sm text-outline mt-1">Badan Gizi Nasional RI</span>
</div>
<!-- 5. KOPERASI DESA MERAH PUTIH -->
<div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-headline-md">storefront</span>
</div>
<span class="font-title-md text-title-md font-bold text-on-surface">Koperasi Merah Putih</span>
<span class="font-label-sm text-label-sm text-outline mt-1">Ekosistem UMKM &amp; Logistik Desa</span>
</div>
<!-- 6. RUMAH SAKIT -->
<div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-xl bg-tertiary/10 text-tertiary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-headline-md">domain_add</span>
</div>
<span class="font-title-md text-title-md font-bold text-on-surface">Rumah Sakit</span>
<span class="font-label-sm text-label-sm text-outline mt-1">Digitalisasi Sistem Medis &amp; Jaringan</span>
</div>
</div>
<!-- Trust Statement Box -->
<div class="mt-12 p-8 rounded-2xl bg-surface-container-low flex flex-col md:flex-row items-center justify-between gap-6">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-primary text-headline-lg">verified</span>
<div>
<h4 class="font-title-lg text-title-lg font-bold text-on-surface">Standar Keamanan &amp; Regulasi Pemerintah Terpenuhi</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Kepatuhan UU Pelindungan Data Pribadi (PDP), ISO 27001, serta sertifikasi teknis vendor IT terdaftar.</p>
</div>
</div>
<a class="shrink-0 px-5 py-2.5 rounded-lg bg-surface-container-highest text-primary font-label-md text-label-md font-bold hover:bg-primary hover:text-on-primary transition-colors" href="#kontak-konsultasi">
          Jadwalkan Presentasi Solusi
        </a>
</div>
</div>
</section>

<!-- BERITA & WAWASAN TEKNOLOGI -->
<section class="w-full bg-surface-container-low py-20 scroll-mt-20" id="berita">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<!-- Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
<div>
<div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary/10 text-primary font-label-sm text-label-sm font-bold uppercase tracking-wider mb-3">
<span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
Wawasan &amp; Berita Terkini
</div>
<h2 class="font-headline-lg text-headline-lg font-extrabold text-on-surface tracking-tight">
Berita &amp; Artikel Teknologi Terkini
</h2>
</div>
<div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
<p class="font-body-md text-body-md text-on-surface-variant max-w-md">
Informasi perkembangan industri teknologi informasi, infrastruktur jaringan, serta kabar inovasi teranyar dari Gretta Solutions Network.
</p>
<a href="{{ route('public.berita') }}" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-bold hover:bg-primary/90 transition-all shadow-sm">
<span>Semua Berita</span>
<span class="material-symbols-outlined text-title-md">arrow_forward</span>
</a>
</div>
</div>

<!-- News Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
@forelse($news as $item)
@php
  $firstImg = null;
  if (!empty($item->gambar) && is_array($item->gambar) && count($item->gambar) > 0) {
      $img = $item->gambar[0];
      $firstImg = \Illuminate\Support\Str::startsWith($img, 'http') ? $img : asset('storage/' . $img);
  }
@endphp
<div class="group bg-surface-container-lowest rounded-2xl overflow-hidden border border-outline-variant/30 hover:border-primary/40 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
<div class="relative w-full h-52 overflow-hidden bg-surface-container-high">
@if($firstImg)
<img src="{{ $firstImg }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
@else
<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/15 to-secondary/15 text-primary group-hover:scale-105 transition-transform duration-500">
<span class="material-symbols-outlined text-display-md opacity-40">newspaper</span>
</div>
@endif
<div class="absolute top-4 left-4">
<span class="px-3 py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md text-primary font-label-sm text-label-sm font-bold shadow-sm">
{{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : 'Terkini' }}
</span>
</div>
</div>
<div class="p-6 flex flex-col flex-1 justify-between gap-4">
<div>
<h3 class="font-title-md text-title-md font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 mb-2">
<a href="{{ route('public.berita.show', $item->slug ?: $item->uuid) }}">
{{ $item->judul }}
</a>
</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3 leading-relaxed">
{{ Str::limit(strip_tags($item->keterangan), 120) }}
</p>
</div>
<div class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
<a href="{{ route('public.berita.show', $item->slug ?: $item->uuid) }}" class="inline-flex items-center gap-1 text-primary font-label-md text-label-md font-bold group-hover:gap-2 transition-all">
<span>Baca Selengkapnya</span>
<span class="material-symbols-outlined text-title-sm">arrow_forward</span>
</a>
<span class="material-symbols-outlined text-outline text-title-sm">bookmark_border</span>
</div>
</div>
</div>
@empty
<div class="col-span-full py-12 px-6 rounded-2xl bg-surface-container-lowest text-center border border-outline-variant/30">
<div class="w-14 h-14 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-3">
<span class="material-symbols-outlined text-headline-md">feed</span>
</div>
<h4 class="font-title-md text-title-md font-bold text-on-surface">Belum Ada Artikel Berita</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Nantikan wawasan dan artikel teknologi terbaru yang akan segera kami publikasikan.</p>
</div>
@endforelse
</div>

<!-- Bottom View All Button -->
<div class="mt-10 text-center">
<a href="{{ route('public.berita') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-surface-container-highest text-primary font-title-md text-title-md font-bold hover:bg-primary hover:text-on-primary transition-all shadow-sm">
<span>Kunjungi Halaman Arsip Berita</span>
<span class="material-symbols-outlined text-title-md">menu_book</span>
</a>
</div>
</div>
</section>

<!-- HUBUNGI KAMI & FORM KONSULTASI (Pages 1, 13 Data) -->
<section class="w-full bg-surface-container-lowest py-20 relative scroll-mt-20" id="kontak-konsultasi">
<div id="kontak" class="scroll-mt-20"></div>
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
<!-- Contact Meta & Credentials (Col 5) -->
<div class="lg:col-span-5 flex flex-col gap-8">
<div>
<span class="px-3.5 py-1.5 rounded-full bg-primary/10 text-primary font-label-sm text-label-sm uppercase font-bold tracking-widest">
Hubungi Kami
</span>
<h2 class="font-headline-lg text-headline-lg font-extrabold text-on-surface mt-3 mb-4">
Mulai Konsultasi Kebutuhan IT &amp; Bisnis Anda
</h2>
<p class="font-body-md text-body-md text-on-surface-variant">
Tim konsultan dan arsitek infrastruktur {{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }} siap membantu menganalisis topologi, merancang estimasi anggaran pengadaan, dan demonstrasi sistem langsung.
</p>
</div>
<!-- Official Channels List from Page 1 & 13 -->
<div class="flex flex-col gap-4">
<!-- Phone -->
@php
  $phoneRaw = preg_replace('/[^0-9]/', '', $profile->nomorTeleponPerusahaan ?? '6285355836787');
  if (\Illuminate\Support\Str::startsWith($phoneRaw, '0')) {
      $phoneRaw = '62' . substr($phoneRaw, 1);
  }
@endphp
<a class="flex items-center gap-4 p-4 rounded-xl bg-surface-container-low hover:bg-secondary-fixed/20 transition-colors" href="https://wa.me/{{ $phoneRaw }}" rel="noopener noreferrer" target="_blank">
<div class="w-12 h-12 rounded-lg bg-primary text-on-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-title-lg">call</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline">Telepon / WhatsApp Resmi</span>
<span class="font-title-md text-title-md font-bold text-on-surface">{{ $profile->nomorTeleponPerusahaan ?? '+62 853 - 558 - 36787' }}</span>
</div>
</a>
<!-- Email -->
<a class="flex items-center gap-4 p-4 rounded-xl bg-surface-container-low hover:bg-secondary-fixed/20 transition-colors" href="mailto:{{ $profile->emailPerusahaan ?? 'grettasolutionsnetwork@gmail.com' }}">
<div class="w-12 h-12 rounded-lg bg-secondary text-on-secondary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-title-lg">mail</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline">Email Korespondensi Bisnis</span>
<span class="font-title-md text-title-md font-bold text-on-surface break-all">{{ $profile->emailPerusahaan ?? 'grettasolutionsnetwork@gmail.com' }}</span>
</div>
</a>
<!-- Website -->
<div class="flex items-center gap-4 p-4 rounded-xl bg-surface-container-low">
<div class="w-12 h-12 rounded-lg bg-tertiary text-on-tertiary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-title-lg">language</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline">Portal Resmi</span>
<span class="font-title-md text-title-md font-bold text-on-surface">{{ $profile->websitePerusahaan ?? 'grettasolutionsnetwork.id' }}</span>
</div>
</div>
<!-- Address -->
<div class="flex items-start gap-4 p-4 rounded-xl bg-surface-container-low">
<div class="w-12 h-12 rounded-lg bg-primary-container text-on-primary flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-title-lg">location_on</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline">Alamat Kantor &amp; Fasilitas</span>
<span class="font-title-md text-title-md font-semibold text-on-surface leading-snug">
{{ $profile->alamatPerusahan ?? 'Jalan Ujung Serdang, Kec. Tanjung Morawa, Kab. Deli Serdang, Sumatera Utara' }}
</span>
</div>
</div>
</div>
</div>
<!-- Interactive Lead Form (Col 7) -->
<div class="lg:col-span-7 bg-surface-container p-8 lg:p-10 rounded-3xl shadow-sm">
<div class="flex items-center justify-between mb-6">
<h3 class="font-headline-sm text-headline-sm font-bold text-on-surface">Formulir Permintaan Penawaran &amp; Konsultasi</h3>
<span class="px-3 py-1 rounded bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-bold">Fast Response</span>
</div>
<form class="space-y-4" id="consultation-form" onsubmit="handleFormSubmit(event)">
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<div>
<label class="block font-label-sm text-label-sm text-on-surface-variant font-semibold mb-1">Nama Lengkap PIC *</label>
<input name="namaPIC" class="w-full px-4 py-3 rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Contoh: Budi Pratama, S.Kom" required="" type="text">
</div>
<div>
<label class="block font-label-sm text-label-sm text-on-surface-variant font-semibold mb-1">Perusahaan / Instansi *</label>
<input name="namaPerusahaan" class="w-full px-4 py-3 rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Nama Rumah Sakit / PT / Kantor" required="" type="text">
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<div>
<label class="block font-label-sm text-label-sm text-on-surface-variant font-semibold mb-1">Nomor WhatsApp Aktif *</label>
<input name="nomorTelepon" class="w-full px-4 py-3 rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="0812-xxxx-xxxx" required="" type="tel">
</div>
<div>
<label class="block font-label-sm text-label-sm text-on-surface-variant font-semibold mb-1">Email Resmi</label>
<input name="email" class="w-full px-4 py-3 rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="nama@perusahaan.co.id" type="email">
</div>
</div>
<div>
<label class="block font-label-sm text-label-sm text-on-surface-variant font-semibold mb-1">Kategori Kebutuhan Solusi *</label>
<select name="jenisKebutuhan" class="w-full px-4 py-3 rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary" required="">
<option value="">-- Pilih Layanan Utama --</option>
<option value="Sistem Informasi & Aplikasi Bisnis">Sistem Informasi &amp; Aplikasi Bisnis</option>
<option value="Infrastruktur Konektivitas & Fiber Optic">Infrastruktur Konektivitas &amp; Fiber Optic</option>
<option value="Pengadaan & Integrasi CCTV / Smart Surveillance">Pengadaan &amp; Integrasi CCTV / Smart Surveillance</option>
<option value="Procurement (Hardware Switch, Router, Server)">Procurement (Hardware Switch, Router, Server)</option>
<option value="Sewa & Rental Perangkat IT (Laptop/PC Kantor)">Sewa &amp; Rental Perangkat IT (Laptop/PC Kantor)</option>
<option value="Pembuatan Aplikasi Web / Digital Solution">Pembuatan Aplikasi Web / Digital Solution</option>
<option value="Cybersecurity & Otomasi Gedung">Cybersecurity &amp; Otomasi Gedung</option>
<option value="Konsultasi Arsitektur IT & Audit">Konsultasi Arsitektur IT &amp; Audit</option>
</select>
</div>
<div>
<label class="block font-label-sm text-label-sm text-on-surface-variant font-semibold mb-1">Deskripsi Ruang Lingkup Proyek &amp; Lokasi *</label>
<textarea name="deskripsi" class="w-full px-4 py-3 rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-body-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Jelaskan kebutuhan, target waktu, dan lokasi implementasi (misal: RSUD di Sumatera Utara, 100 ranjang, butuh modul RME + Bridging SatuSehat)..." required="" rows="4"></textarea>
</div>
<div class="pt-2">
<button class="w-full py-4 rounded-lg bg-primary text-on-primary font-label-md text-label-md font-bold shadow-md hover:bg-primary-container transition-all flex items-center justify-center gap-2" type="submit">
<span class="material-symbols-outlined text-title-md">send</span>
<span class="">Kirim Permintaan Konsultasi</span>
</button>
</div>
<p class="font-body-sm text-body-sm text-outline text-center">
              Tim teknis kami akan menghubungi Anda kembali dalam maksimal 1 x 24 jam kerja.
            </p>
</form>
<!-- Form Success Alert Popup simulation -->
<div class="hidden mt-4 p-4 rounded-xl bg-secondary-fixed/50 text-on-secondary-fixed flex items-center gap-3" id="form-alert">
<span class="material-symbols-outlined text-headline-sm text-secondary">check_circle</span>
<div>
<p class="font-title-md text-title-md font-bold">Terima kasih! Permintaan Anda telah kami terima.</p>
<p class="font-body-sm text-body-sm">Tim Technical Account Representative PT. Gretta Solutions Network akan segera menghubungi Anda melalui kontak WhatsApp yang tertera.</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- FAST INTERACTIVE SCRIPTS -->
<script>
    async function handleFormSubmit(event) {
      event.preventDefault();
      const form = document.getElementById('consultation-form');
      const alert = document.getElementById('form-alert');
      
      const formData = new FormData(form);
      const payload = {
        namaPIC: formData.get('namaPIC'),
        namaPerusahaan: formData.get('namaPerusahaan'),
        nomorTelepon: formData.get('nomorTelepon'),
        email: formData.get('email'),
        jenisKebutuhan: formData.get('jenisKebutuhan'),
        deskripsi: formData.get('deskripsi'),
        status: 'baru'
      };

      form.classList.add('opacity-50', 'pointer-events-none');
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("public.penawaran.store") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify(payload)
        });
        const result = await res.json();
        if (res.ok && result.success) {
          form.reset();
          alert.classList.remove('hidden');
          setTimeout(() => {
            alert.classList.add('hidden');
          }, 8000);
        } else {
          window.alert(result.message || 'Gagal mengirim formulir. Silakan periksa kembali data Anda.');
        }
      } catch (err) {
        console.error(err);
      } finally {
        form.classList.remove('opacity-50', 'pointer-events-none');
      }
    }

    // Smooth Scrolling, Active State Indicator (Scrollspy), & Mobile Navigation
    document.addEventListener('DOMContentLoaded', () => {
      // Mobile drawer toggle
      const mobileToggle = document.getElementById('mobile-menu-toggle');
      const mobileNav = document.getElementById('mobile-nav');
      const menuIcon = document.getElementById('menu-icon');

      if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener('click', () => {
          const isClosed = mobileNav.classList.contains('hidden');
          if (isClosed) {
            mobileNav.classList.remove('hidden');
            if (menuIcon) menuIcon.textContent = 'close';
          } else {
            mobileNav.classList.add('hidden');
            if (menuIcon) menuIcon.textContent = 'menu';
          }
        });
      }

      // Smooth scroll handler for all internal anchor links
      const anchorLinks = document.querySelectorAll('a[href^="#"]');
      anchorLinks.forEach(link => {
        link.addEventListener('click', (e) => {
          const targetId = link.getAttribute('href');
          if (targetId && targetId !== '#') {
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
              e.preventDefault();
              const headerOffset = 78; // Approx fixed header height
              const elementPosition = targetElement.getBoundingClientRect().top;
              const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

              window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
              });

              // Update URL hash smoothly without jump
              if (history.pushState) {
                history.pushState(null, null, targetId);
              }

              // Close mobile nav drawer if open
              if (mobileNav && !mobileNav.classList.contains('hidden')) {
                mobileNav.classList.add('hidden');
                if (menuIcon) menuIcon.textContent = 'menu';
              }
            }
          }
        });
      });

      // Scrollspy: dynamic active menu item on scroll
      const observedSections = [
        document.getElementById('beranda'),
        document.getElementById('tentang-kami'),
        document.getElementById('layanan'),
        document.getElementById('portofolio'),
        document.getElementById('klien'),
        document.getElementById('berita'),
        document.getElementById('kontak-konsultasi')
      ].filter(Boolean);

      const desktopNavLinks = document.querySelectorAll('#desktop-nav .nav-link');
      const mobileNavLinks = document.querySelectorAll('#mobile-nav .mobile-nav-link');

      function syncActiveMenu() {
        const scrollPosition = window.pageYOffset + 120;
        let currentSectionId = 'beranda';

        observedSections.forEach(section => {
          if (scrollPosition >= section.offsetTop) {
            currentSectionId = section.getAttribute('id');
          }
        });

        const updateLinks = (links) => {
          links.forEach(link => {
            const href = link.getAttribute('href');
            const isMatched = href === '#' + currentSectionId || 
              (currentSectionId === 'kontak-konsultasi' && (href === '#kontak' || href === '#kontak-konsultasi'));

            if (isMatched) {
              link.classList.add('text-primary', 'font-bold', 'bg-surface-container-low');
              link.classList.remove('text-on-surface-variant');
              link.setAttribute('aria-current', 'page');
            } else {
              link.classList.remove('text-primary', 'font-bold', 'bg-surface-container-low');
              link.classList.add('text-on-surface-variant');
              link.removeAttribute('aria-current');
            }
          });
        };

        updateLinks(desktopNavLinks);
        updateLinks(mobileNavLinks);
      }

      // ====================================================
      // FULL HERO ISP BACKBONE NETWORK ARCHITECTURE & CANVAS
      // ====================================================
      function initHeroIspBackboneAnimation() {
        const canvas = document.getElementById('hero-isp-backbone-canvas');
        const sparkCanvas = document.getElementById('isp-sparkline-canvas');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        const sparkCtx = sparkCanvas ? sparkCanvas.getContext('2d') : null;
        const dpr = Math.min(window.devicePixelRatio || 1, 2);

        let width = 0, height = 0;
        let isVisible = true;
        let animId = null;

        // Core ISP PoP Locations (Normalized 0.0 - 1.0)
        const corePops = [
          { id: 'sg', name: 'SG Tier-1 Upstream', nx: 0.12, ny: 0.22, color: '#06b6d4', capacity: '100G IP Transit', isTier1: true },
          { id: 'medan', name: 'Medan Subsea Landing', nx: 0.22, ny: 0.44, color: '#10b981', capacity: '40G Core PoP' },
          { id: 'jakarta', name: 'Jakarta Super IXP', nx: 0.46, ny: 0.72, color: '#34d399', capacity: '100G Peering', isCore: true },
          { id: 'surabaya', name: 'Surabaya Trunk Hub', nx: 0.62, ny: 0.76, color: '#10b981', capacity: '40G Aggregation' },
          { id: 'bali', name: 'Bali Subsea PoP', nx: 0.76, ny: 0.82, color: '#06b6d4', capacity: '20G Gateway' },
          { id: 'ikn', name: 'Balikpapan & IKN Hub', nx: 0.66, ny: 0.36, color: '#34d399', capacity: '40G Industrial' },
          { id: 'makassar', name: 'Makassar Eastern PoP', nx: 0.86, ny: 0.50, color: '#6ffbbe', capacity: '40G Gateway' }
        ];

        // Backbone Fiber Trunks
        const trunks = [
          { from: 'sg', to: 'medan', label: 'Subsea Cable A' },
          { from: 'sg', to: 'jakarta', label: 'Intl Express Subsea' },
          { from: 'medan', to: 'jakarta', label: 'Sumatera Terrestrial Trunk' },
          { from: 'jakarta', to: 'surabaya', label: 'Java DWDM Highway' },
          { from: 'surabaya', to: 'bali', label: 'East Subsea Link' },
          { from: 'bali', to: 'makassar', label: 'Eastern Submarine Ring' },
          { from: 'makassar', to: 'ikn', label: 'Strait Cross Link' },
          { from: 'ikn', to: 'jakarta', label: 'Java Sea Subsea DWDM' },
          { from: 'medan', to: 'ikn', label: 'Cross-Island Backup Trunk' }
        ];

        // Client / Enterprise Endpoint Nodes
        const clientNodes = [];
        const clientCount = 42;

        function resizeBackbone() {
          const rect = canvas.getBoundingClientRect();
          width = rect.width;
          height = rect.height;
          canvas.width = width * dpr;
          canvas.height = height * dpr;
          ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

          if (sparkCanvas) {
            const sRect = sparkCanvas.getBoundingClientRect();
            sparkCanvas.width = sRect.width * dpr;
            sparkCanvas.height = sRect.height * dpr;
            if (sparkCtx) sparkCtx.setTransform(dpr, 0, 0, dpr, 0, 0);
          }
        }
        resizeBackbone();
        window.addEventListener('resize', resizeBackbone, { passive: true });

        // Initialize client nodes
        const colors = ['#10b981', '#06b6d4', '#34d399', '#6ee7b7'];
        for (let i = 0; i < clientCount; i++) {
          clientNodes.push({
            x: Math.random() * (width || 800),
            y: Math.random() * (height || 600),
            vx: (Math.random() - 0.5) * 0.35,
            vy: (Math.random() - 0.5) * 0.35,
            r: Math.random() * 1.8 + 1,
            color: colors[Math.floor(Math.random() * colors.length)],
            pulse: Math.random() * Math.PI * 2
          });
        }

        // Mouse tracking
        let mouse = { x: null, y: null };
        canvas.addEventListener('mousemove', (e) => {
          const rect = canvas.getBoundingClientRect();
          mouse.x = e.clientX - rect.left;
          mouse.y = e.clientY - rect.top;
        }, { passive: true });

        canvas.addEventListener('mouseleave', () => {
          mouse.x = null;
          mouse.y = null;
        });

        // Packets on Backbone Trunks
        const backbonePackets = [];
        for (let i = 0; i < 28; i++) {
          const trunk = trunks[Math.floor(Math.random() * trunks.length)];
          backbonePackets.push({
            trunk: trunk,
            progress: Math.random(),
            speed: 0.003 + Math.random() * 0.006,
            reverse: Math.random() > 0.5,
            color: colors[Math.floor(Math.random() * colors.length)]
          });
        }

        // Radar / Shockwaves
        const beaconRipples = [];
        let beaconTimer = 0;

        function triggerBackboneBurst() {
          // Surge packets on all trunks
          for (let i = 0; i < 35; i++) {
            const t = trunks[Math.floor(Math.random() * trunks.length)];
            backbonePackets.push({
              trunk: t,
              progress: 0,
              speed: 0.012 + Math.random() * 0.015,
              reverse: Math.random() > 0.5,
              color: '#6ffbbe'
            });
          }

          // Trigger shockwaves from Jakarta Super IXP & Singapore
          const popJkt = corePops.find(p => p.id === 'jakarta');
          const popSg = corePops.find(p => p.id === 'sg');
          if (popJkt) {
            beaconRipples.push({ x: popJkt.nx * width, y: popJkt.ny * height, r: 10, maxR: 350, alpha: 1, color: '#10b981' });
          }
          if (popSg) {
            beaconRipples.push({ x: popSg.nx * width, y: popSg.ny * height, r: 8, maxR: 280, alpha: 1, color: '#06b6d4' });
          }

          // Update Latency and Throughput feedback
          const latEl = document.getElementById('isp-live-latency');
          if (latEl) {
            latEl.textContent = '0.3 ms';
            latEl.classList.add('text-white', 'scale-110');
            setTimeout(() => {
              latEl.textContent = '0.8 ms';
              latEl.classList.remove('text-white', 'scale-110');
            }, 1200);
          }

          const tpEl = document.getElementById('isp-throughput');
          if (tpEl) {
            tpEl.textContent = '114.8 Gbps';
            setTimeout(() => {
              tpEl.textContent = '98.4 Gbps';
            }, 1400);
          }

          const logEl = document.getElementById('traceroute-log');
          if (logEl) {
            const routes = [
              'BGP Trace: Gretta Edge ➔ Jakarta IXP (0.4ms) ➔ SG1 Upstream (3.8ms) [0% Loss]',
              'Route Burst: Surabaya PoP ➔ Java DWDM ➔ Jakarta Super IXP (1.1ms) [Optimal]',
              'Multi-Homing Trace: Medan Subsea ➔ SG Equinix ➔ Global Tier-1 (4.1ms) [100% Up]'
            ];
            const choice = routes[Math.floor(Math.random() * routes.length)];
            logEl.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span><span>${choice}</span>`;
          }
        }

        const traceBtn = document.getElementById('btn-traceroute-burst');
        if (traceBtn) {
          traceBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            triggerBackboneBurst();
          });
        }

        canvas.addEventListener('click', (e) => {
          const rect = canvas.getBoundingClientRect();
          const cx = e.clientX - rect.left;
          const cy = e.clientY - rect.top;
          beaconRipples.push({ x: cx, y: cy, r: 6, maxR: 280, alpha: 1, color: '#6ffbbe' });
          triggerBackboneBurst();
        });

        // Oscilloscope Wave phase
        let sparkPhase = 0;

        // Helper: get Pop coordinate in pixels
        function getPopPos(pop) {
          return {
            x: pop.nx * width,
            y: pop.ny * height
          };
        }

        // Animation Loop
        function renderBackbone() {
          if (!isVisible) {
            animId = requestAnimationFrame(renderBackbone);
            return;
          }

          ctx.clearRect(0, 0, width, height);

          // 1. Draw Fiber Backbone Trunks (Glowing optical cables)
          for (let i = 0; i < trunks.length; i++) {
            const t = trunks[i];
            const p1 = corePops.find(p => p.id === t.from);
            const p2 = corePops.find(p => p.id === t.to);
            if (!p1 || !p2) continue;

            const pos1 = getPopPos(p1);
            const pos2 = getPopPos(p2);

            // Outer soft glow
            ctx.beginPath();
            ctx.moveTo(pos1.x, pos1.y);
            ctx.lineTo(pos2.x, pos2.y);
            ctx.strokeStyle = 'rgba(16, 185, 129, 0.18)';
            ctx.lineWidth = 4;
            ctx.stroke();

            // Inner laser core fiber
            ctx.beginPath();
            ctx.moveTo(pos1.x, pos1.y);
            ctx.lineTo(pos2.x, pos2.y);
            ctx.strokeStyle = 'rgba(111, 251, 190, 0.45)';
            ctx.lineWidth = 1.2;
            ctx.stroke();

            // Dashed packet rail
            ctx.beginPath();
            ctx.setLineDash([4, 8]);
            ctx.moveTo(pos1.x, pos1.y);
            ctx.lineTo(pos2.x, pos2.y);
            ctx.strokeStyle = 'rgba(6, 182, 212, 0.35)';
            ctx.lineWidth = 1;
            ctx.stroke();
            ctx.setLineDash([]);
          }

          // 2. Draw Client Endpoints & Links to closest PoP
          for (let i = 0; i < clientNodes.length; i++) {
            const c = clientNodes[i];
            c.x += c.vx;
            c.y += c.vy;
            c.pulse += 0.03;

            if (c.x < 0 || c.x > width) c.vx *= -1;
            if (c.y < 0 || c.y > height) c.vy *= -1;

            // Connect client node to closest core PoP if in range
            let nearestPop = null;
            let minDist = 220;
            for (let j = 0; j < corePops.length; j++) {
              const popPos = getPopPos(corePops[j]);
              const dx = c.x - popPos.x;
              const dy = c.y - popPos.y;
              const dist = Math.sqrt(dx * dx + dy * dy);
              if (dist < minDist) {
                minDist = dist;
                nearestPop = popPos;
              }
            }

            if (nearestPop) {
              const alpha = (1 - minDist / 220) * 0.22;
              ctx.beginPath();
              ctx.moveTo(c.x, c.y);
              ctx.lineTo(nearestPop.x, nearestPop.y);
              ctx.strokeStyle = `rgba(16, 185, 129, ${alpha})`;
              ctx.lineWidth = 0.8;
              ctx.stroke();
            }

            // Draw client node
            const pulseR = c.r + Math.sin(c.pulse) * 0.6;
            ctx.beginPath();
            ctx.arc(c.x, c.y, pulseR, 0, Math.PI * 2);
            ctx.fillStyle = c.color;
            ctx.fill();

            // Connect to mouse if nearby
            if (mouse.x !== null && mouse.y !== null) {
              const mdx = c.x - mouse.x;
              const mdy = c.y - mouse.y;
              const mdist = Math.sqrt(mdx * mdx + mdy * mdy);
              if (mdist < 120) {
                const mAlpha = (1 - mdist / 120) * 0.5;
                ctx.beginPath();
                ctx.moveTo(c.x, c.y);
                ctx.lineTo(mouse.x, mouse.y);
                ctx.strokeStyle = `rgba(6, 182, 212, ${mAlpha})`;
                ctx.lineWidth = 1;
                ctx.stroke();
              }
            }
          }

          // 3. Update & Draw Backbone Traffic Pulses
          for (let i = backbonePackets.length - 1; i >= 0; i--) {
            const pkt = backbonePackets[i];
            pkt.progress += pkt.speed;

            if (pkt.progress >= 1) {
              pkt.progress = 0;
              pkt.reverse = Math.random() > 0.5;
            }

            const p1 = corePops.find(p => p.id === pkt.trunk.from);
            const p2 = corePops.find(p => p.id === pkt.trunk.to);
            if (!p1 || !p2) continue;

            const pos1 = getPopPos(p1);
            const pos2 = getPopPos(p2);

            const start = pkt.reverse ? pos2 : pos1;
            const end = pkt.reverse ? pos1 : pos2;

            const px = start.x + (end.x - start.x) * pkt.progress;
            const py = start.y + (end.y - start.y) * pkt.progress;

            // Packet glow
            ctx.beginPath();
            ctx.arc(px, py, 3.2, 0, Math.PI * 2);
            ctx.fillStyle = pkt.color;
            ctx.shadowBlur = 10;
            ctx.shadowColor = pkt.color;
            ctx.fill();
            ctx.shadowBlur = 0;
          }

          // 4. Draw Core PoP Hubs (Interactive & Glowing)
          beaconTimer++;
          if (beaconTimer % 90 === 0) {
            const jkt = corePops.find(p => p.id === 'jakarta');
            if (jkt) {
              beaconRipples.push({ x: jkt.nx * width, y: jkt.ny * height, r: 6, maxR: 160, alpha: 0.8, color: '#10b981' });
            }
          }

          // Draw Beacon Ripples
          for (let r = beaconRipples.length - 1; r >= 0; r--) {
            const rip = beaconRipples[r];
            rip.r += 2.2;
            rip.alpha -= 0.012;

            if (rip.alpha <= 0 || rip.r >= rip.maxR) {
              beaconRipples.splice(r, 1);
              continue;
            }

            ctx.beginPath();
            ctx.arc(rip.x, rip.y, rip.r, 0, Math.PI * 2);
            ctx.strokeStyle = `rgba(16, 185, 129, ${rip.alpha * 0.7})`;
            ctx.lineWidth = 1.5;
            ctx.stroke();
          }

          // Draw PoP Nodes
          for (let i = 0; i < corePops.length; i++) {
            const pop = corePops[i];
            const pos = getPopPos(pop);

            // Outer pulse ring
            const outerR = pop.isCore ? 14 : 10;
            ctx.beginPath();
            ctx.arc(pos.x, pos.y, outerR, 0, Math.PI * 2);
            ctx.fillStyle = pop.isCore ? 'rgba(16, 185, 129, 0.25)' : 'rgba(6, 182, 212, 0.2)';
            ctx.strokeStyle = pop.color;
            ctx.lineWidth = 1.8;
            ctx.stroke();
            ctx.fill();

            // Inner core bead
            ctx.beginPath();
            ctx.arc(pos.x, pos.y, pop.isCore ? 5 : 3.5, 0, Math.PI * 2);
            ctx.fillStyle = '#ffffff';
            ctx.shadowBlur = 12;
            ctx.shadowColor = pop.color;
            ctx.fill();
            ctx.shadowBlur = 0;

            // PoP Labels (Desktop only or clean text)
            if (width > 640) {
              ctx.font = '600 10px "Plus Jakarta Sans", sans-serif';
              ctx.fillStyle = '#cbd5e1';
              ctx.fillText(pop.name, pos.x + 14, pos.y + 3);

              ctx.font = '700 8.5px "Plus Jakarta Sans", monospace';
              ctx.fillStyle = pop.color;
              ctx.fillText(pop.capacity, pos.x + 14, pos.y + 14);
            }
          }

          // 5. Draw Sparkline Wave on #isp-sparkline-canvas
          if (sparkCanvas && sparkCtx) {
            const sW = sparkCanvas.width / dpr;
            const sH = sparkCanvas.height / dpr;
            sparkCtx.clearRect(0, 0, sW, sH);

            sparkPhase += 0.07;
            sparkCtx.beginPath();
            const points = [];
            for (let x = 0; x <= sW; x += 3) {
              const normalX = x / sW;
              const y = (sH / 2) + 
                Math.sin(normalX * 9 + sparkPhase) * 6 + 
                Math.sin(normalX * 16 - sparkPhase * 1.3) * 3 +
                (Math.random() - 0.5) * 1.5;
              points.push({ x, y });
              if (x === 0) sparkCtx.moveTo(x, y);
              else sparkCtx.lineTo(x, y);
            }

            sparkCtx.strokeStyle = '#10b981';
            sparkCtx.lineWidth = 1.8;
            sparkCtx.shadowBlur = 8;
            sparkCtx.shadowColor = '#10b981';
            sparkCtx.stroke();
            sparkCtx.shadowBlur = 0;

            if (points.length > 0) {
              sparkCtx.lineTo(sW, sH);
              sparkCtx.lineTo(0, sH);
              sparkCtx.closePath();
              const grad = sparkCtx.createLinearGradient(0, 0, 0, sH);
              grad.addColorStop(0, 'rgba(16, 185, 129, 0.35)');
              grad.addColorStop(1, 'rgba(16, 185, 129, 0.0)');
              sparkCtx.fillStyle = grad;
              sparkCtx.fill();
            }
          }

          animId = requestAnimationFrame(renderBackbone);
        }

        // IntersectionObserver: pauses animation when hero is off-screen
        const heroSection = document.getElementById('beranda');
        if (heroSection && 'IntersectionObserver' in window) {
          const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
              isVisible = entry.isIntersecting;
            });
          }, { threshold: 0.1 });
          observer.observe(heroSection);
        }

        animId = requestAnimationFrame(renderBackbone);

        // Periodic jitter for realistic ISP traffic throughput
        setInterval(() => {
          if (!isVisible) return;
          const packetsEl = document.getElementById('isp-packets');
          if (packetsEl) {
            const rate = (94.0 + Math.random() * 2.5).toFixed(1);
            packetsEl.textContent = `${rate} Mpps`;
          }
          const latEl = document.getElementById('isp-live-latency');
          if (latEl && !latEl.classList.contains('scale-110')) {
            latEl.textContent = `${(0.7 + Math.random() * 0.3).toFixed(1)} ms`;
          }
        }, 1600);
      }

      initHeroIspBackboneAnimation();

      window.addEventListener('scroll', syncActiveMenu, { passive: true });
      syncActiveMenu();
    });
  </script>
</div>
</main>

<footer class="w-full bg-surface-container-lowest border-t-0 shadow-[0_-1px_12px_rgba(0,0,0,0.02)]">
  <!-- Operational Area Sub-bar -->
  <div class="bg-surface-container-low py-4">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-wrap items-center justify-between gap-4">
      <div class="flex items-center gap-2">
        <span class="w-2.5 h-2.5 rounded-full bg-secondary animate-pulse"></span>
        <span class="font-label-sm text-label-sm uppercase tracking-wider font-bold text-secondary">Cakupan Wilayah Operasional Terintegrasi:</span>
      </div>
      <div class="flex flex-wrap items-center gap-2">
        @forelse($areas as $ar)
          <span class="px-3 py-1 rounded-full bg-surface-container-highest text-tertiary font-label-sm text-label-sm font-semibold">{{ $ar->namaWilayah }}</span>
        @empty
          <span class="px-3 py-1 rounded-full bg-surface-container-highest text-tertiary font-label-sm text-label-sm font-semibold">Sumatera</span>
          <span class="px-3 py-1 rounded-full bg-surface-container-highest text-tertiary font-label-sm text-label-sm font-semibold">Jawa</span>
          <span class="px-3 py-1 rounded-full bg-surface-container-highest text-tertiary font-label-sm text-label-sm font-semibold">Bali</span>
          <span class="px-3 py-1 rounded-full bg-surface-container-highest text-tertiary font-label-sm text-label-sm font-semibold">Kalimantan</span>
          <span class="px-3 py-1 rounded-full bg-surface-container-highest text-tertiary font-label-sm text-label-sm font-semibold">Sulawesi</span>
        @endforelse
      </div>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-6 lg:px-12 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
      <!-- Col 1: Identity -->
      <div class="flex flex-col gap-4">
        <a href="#beranda" class="inline-block mb-3">
          <img src="{{ $profile->logo_url ?? \App\Models\CompanyProfile::DEFAULT_LOGO }}" alt="{{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}" class="h-10 w-auto object-contain">
        </a>
        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          Mitra transformasi digital dan infrastruktur jaringan IT B2B terkemuka. Menyediakan layanan konektivitas handal, cloud infrastructure, dan integrasi sistem enterprise.
        </p>
        <div class="flex items-center gap-2 text-secondary">
          <span class="material-symbols-outlined text-title-md">verified</span>
          <span class="font-label-sm text-label-sm font-semibold text-on-surface">Uptime SLA 99.99% Enterprise Support</span>
        </div>

        <!-- Social Media Icons if available -->
        @if($profile && ($profile->instagram || $profile->tiktok || $profile->treads || $profile->facebook))
          <div class="flex items-center gap-3 pt-2">
            @if($profile->facebook)
              <a href="{{ $profile->facebook }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-surface-container-high flex items-center justify-center text-on-surface hover:text-primary transition-colors" title="Facebook">
                <span class="font-bold text-xs">FB</span>
              </a>
            @endif
            @if($profile->instagram)
              <a href="{{ $profile->instagram }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-surface-container-high flex items-center justify-center text-on-surface hover:text-primary transition-colors" title="Instagram">
                <span class="font-bold text-xs">IG</span>
              </a>
            @endif
            @if($profile->tiktok)
              <a href="{{ $profile->tiktok }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-surface-container-high flex items-center justify-center text-on-surface hover:text-primary transition-colors" title="TikTok">
                <span class="font-bold text-xs">TT</span>
              </a>
            @endif
            @if($profile->treads)
              <a href="{{ $profile->treads }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-surface-container-high flex items-center justify-center text-on-surface hover:text-primary transition-colors" title="Threads">
                <span class="font-bold text-xs">TH</span>
              </a>
            @endif
          </div>
        @endif
      </div>

      <!-- Col 2: Services -->
      <div class="flex flex-col gap-3">
        <span class="font-title-md text-title-md font-bold text-on-surface tracking-tight">Solusi &amp; Layanan</span>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#layanan">IT Infrastructure &amp; Networking</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="{{ route('public.portofolio') }}">Semua Portofolio &amp; Proyek</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="{{ route('public.berita') }}">Wawasan &amp; Berita IT</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#layanan">Enterprise Cloud &amp; Server</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#layanan">Cybersecurity &amp; Data Protection</a>
      </div>

      <!-- Col 3: Navigation -->
      <div class="flex flex-col gap-3">
        <span class="font-title-md text-title-md font-bold text-on-surface tracking-tight">Informasi Perusahaan</span>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#tentang-kami">Profil &amp; Visi Misi</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="{{ route('public.portofolio') }}">Portofolio Proyek</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="{{ route('public.berita') }}">Arsip Berita &amp; Artikel</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#klien">Mitra &amp; Pelanggan Proyek</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#kontak-konsultasi">Permintaan Penawaran &amp; Kontak</a>
      </div>

      <!-- Col 4: Contacts -->
      <div class="flex flex-col gap-3">
        <span class="font-title-md text-title-md font-bold text-on-surface tracking-tight">Kantor &amp; Kontak</span>
        <div class="flex items-start gap-3">
          <span class="material-symbols-outlined text-primary text-title-md mt-0.5">location_on</span>
          <span class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
            {{ $profile->alamatPerusahan ?? 'Jalan Ujung Serdang, Kec. Tanjung Morawa, Kab. Deli Serdang, Sumatera Utara' }}
          </span>
        </div>
        <div class="flex items-center gap-3">
          <span class="material-symbols-outlined text-primary text-title-md">call</span>
          <span class="font-body-sm text-body-sm text-on-surface-variant">
            {{ $profile->nomorTeleponPerusahaan ?? '+62 853 - 558 - 36787' }}
          </span>
        </div>
        <div class="flex items-center gap-3">
          <span class="material-symbols-outlined text-primary text-title-md">mail</span>
          <span class="font-body-sm text-body-sm text-on-surface-variant break-all">
            {{ $profile->emailPerusahaan ?? 'grettasolutionsnetwork@gmail.com' }}
          </span>
        </div>
        <div class="flex items-center gap-3">
          <span class="material-symbols-outlined text-primary text-title-md">language</span>
          <span class="font-body-sm text-body-sm text-on-surface-variant">
            {{ $profile->websitePerusahaan ?? 'grettasolutionsnetwork.id' }}
          </span>
        </div>
      </div>
    </div>

    <div class="mt-12 pt-8 bg-surface-container-lowest flex flex-col md:flex-row items-center justify-between gap-4 border-t border-outline-variant/30">
      <p class="font-body-sm text-body-sm text-outline">© {{ date('Y') }} {{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}. All Rights Reserved. One Stop Business &amp; IT Solutions.</p>
      <div class="flex items-center gap-6">
        <a href="#beranda" class="font-label-sm text-label-sm text-outline hover:text-primary transition-colors">Kembali ke Atas</a>
        <a href="{{ route('login') }}" class="font-label-sm text-label-sm text-outline hover:text-primary transition-colors">Admin Panel</a>
      </div>
    </div>
  </div>
</footer>

@include('partials.flying-whatsapp-button')

</body>
</html>