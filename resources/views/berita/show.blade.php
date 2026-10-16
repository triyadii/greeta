<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $item->judul }} - {{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#004225",
                        "primary-container": "#0a5c36",
                        secondary: "#006c49",
                        "on-surface": "#131b2e",
                        "on-surface-variant": "#404941",
                        background: "#faf8ff",
                        "surface-container": "#eaedff",
                        "surface-container-low": "#f2f3ff",
                        "surface-container-lowest": "#ffffff",
                        outline: "#707a71"
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-background font-sans text-on-surface antialiased min-h-screen flex flex-col justify-between">

    <!-- Header Navigation -->
    <header class="fixed top-0 w-full z-50 bg-surface-container-lowest/90 backdrop-blur-md shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="inline-flex items-center">
                    <img src="{{ $profile->logo_url ?? \App\Models\CompanyProfile::DEFAULT_LOGO }}" alt="{{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}" class="h-10 w-auto object-contain">
                </a>
            </div>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                <a class="px-3 py-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors rounded-lg" href="{{ route('home') }}#beranda">Beranda</a>
                <a class="px-3 py-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors rounded-lg" href="{{ route('home') }}#tentang-kami">Tentang Kami</a>
                <a class="px-3 py-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors rounded-lg" href="{{ route('home') }}#layanan">Layanan</a>
                <a class="px-3 py-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors rounded-lg" href="{{ route('public.portofolio') }}">Portofolio</a>
                <a class="px-3 py-2 text-sm font-bold text-primary bg-surface-container-low transition-colors rounded-lg" href="{{ route('public.berita') }}">Berita</a>
                <a class="px-3 py-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors rounded-lg" href="{{ route('home') }}#kontak-konsultasi">Kontak</a>
            </nav>

            <!-- Visitor Counter -->
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                    <span class="font-medium text-emerald-950">Visitor: <strong>{{ number_format($totalVisitors ?? 0) }}</strong></span>
                    <span class="text-emerald-300">|</span>
                    <span class="text-emerald-800">Hari ini: <strong>{{ number_format($todayVisitors ?? 0) }}</strong></span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="w-full pt-28 pb-20 flex-grow">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-outline mb-6">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                <span>/</span>
                <a href="{{ route('public.berita') }}" class="hover:text-primary">Berita</a>
                <span>/</span>
                <span class="text-primary font-semibold truncate">{{ Str::limit($item->judul, 30) }}</span>
            </nav>

            <!-- Article Header -->
            <header class="mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                    Publikasi Resmi
                </div>
                <h1 class="text-2xl md:text-4xl font-extrabold text-on-surface leading-tight mb-4">
                    {{ $item->judul }}
                </h1>
                <div class="flex items-center gap-4 text-xs text-outline pb-4 border-b border-gray-100">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">schedule</span>
                        <span>{{ $item->created_at ? $item->created_at->translatedFormat('l, d F Y - H:i') : '-' }} WIB</span>
                    </div>
                    <span>•</span>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">person</span>
                        <span>Redaksi Gretta Network</span>
                    </div>
                </div>
            </header>

            <!-- Main Image / Carousel -->
            @if(is_array($item->gambar) && count($item->gambar) > 0)
            <div class="mb-10 space-y-4">
                <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 max-h-[480px]">
                    <img src="{{ asset('storage/' . $item->gambar[0]) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover" />
                </div>
                
                @if(count($item->gambar) > 1)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach(array_slice($item->gambar, 1) as $extraImg)
                        <div class="rounded-xl overflow-hidden border border-gray-200 h-32">
                            <img src="{{ asset('storage/' . $extraImg) }}" class="w-full h-full object-cover hover:scale-105 transition-transform" />
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <!-- Article Body -->
            <div class="prose max-w-none text-on-surface-variant leading-relaxed text-base space-y-4 font-normal" style="white-space: pre-line;">
                {{ $item->keterangan }}
            </div>

            <!-- Share / Return -->
            <div class="mt-12 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('public.berita') }}" class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:underline">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    <span>Kembali ke Semua Berita</span>
                </a>
                <div class="flex items-center gap-2 text-xs text-outline">
                    <span>Bagikan artikel ini kepada mitra kerja Anda</span>
                </div>
            </div>

            <!-- Recent News Suggestion -->
            @if($recentNews->count() > 0)
            <div class="mt-16 pt-10 border-t border-gray-100">
                <h3 class="text-xl font-bold text-on-surface mb-6">Berita Terkait Lainnya</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($recentNews as $rec)
                    <a href="{{ route('public.berita.show', $rec->slug) }}" class="p-4 rounded-xl bg-white border border-gray-100 hover:shadow-md transition-all flex items-start gap-4 group">
                        <div class="w-20 h-20 rounded-lg bg-gray-100 shrink-0 overflow-hidden">
                            @if(is_array($rec->gambar) && count($rec->gambar) > 0)
                                <img src="{{ asset('storage/' . $rec->gambar[0]) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <span class="material-symbols-outlined">newspaper</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <span class="text-xs text-outline">{{ $rec->created_at ? $rec->created_at->format('d M Y') : '-' }}</span>
                            <h4 class="text-sm font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 mt-1">
                                {{ $rec->judul }}
                            </h4>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full bg-surface-container-lowest border-t border-gray-100 py-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <img src="{{ $profile->logo_url ?? \App\Models\CompanyProfile::DEFAULT_LOGO }}" alt="{{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}" class="h-8 w-auto object-contain">
                <span class="text-xs text-gray-500">&copy; {{ date('Y') }} {{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}. All rights reserved.</span>
            </div>
            <div class="flex items-center gap-6 text-xs text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                <a href="{{ route('public.portofolio') }}" class="hover:text-primary">Portofolio</a>
                <a href="{{ route('public.berita') }}" class="text-primary font-bold">Berita</a>
                <a href="{{ route('login') }}" class="hover:text-primary">Portal Admin</a>
            </div>
        </div>
    </footer>

    @include('partials.flying-whatsapp-button')
</body>
</html>
