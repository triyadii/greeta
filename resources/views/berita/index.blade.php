<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Berita &amp; Publikasi Teknologi - {{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}</title>
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
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <!-- Breadcrumbs & Header -->
            <div class="mb-10">
                <nav class="flex items-center gap-2 text-xs text-outline mb-3">
                    <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                    <span>/</span>
                    <span class="text-primary font-semibold">Berita &amp; Publikasi</span>
                </nav>
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-2">
                            <span class="w-2 h-2 rounded-full bg-primary"></span>
                            News &amp; Media Center
                        </div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-on-surface">Kabar &amp; Wawasan Terkini</h1>
                        <p class="text-on-surface-variant text-sm md:text-base mt-2 max-w-2xl">
                            Ikuti perkembangan terbaru inovasi teknologi informasi, siaran pers korporasi, serta studi kasus implementasi dari Gretta Solutions Network.
                        </p>
                    </div>

                    <!-- Search Bar -->
                    <form action="{{ route('public.berita') }}" method="GET" class="w-full md:w-80">
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul artikel..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" />
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-xl">search</span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($news as $item)
                <article class="bg-surface-container-lowest rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition-all group flex flex-col justify-between">
                    <div>
                        <!-- Thumbnail -->
                        <div class="relative w-full h-52 bg-gray-100 overflow-hidden">
                            @if(is_array($item->gambar) && count($item->gambar) > 0)
                                <img src="{{ asset('storage/' . $item->gambar[0]) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.src='https://placehold.co/600x400?text=Berita+Gretta'" />
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 bg-surface-container-low">
                                    <span class="material-symbols-outlined text-4xl mb-1">article</span>
                                    <span class="text-xs">Berita Gretta Network</span>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-primary/90 text-white text-xs font-bold backdrop-blur-sm">
                                Siaran Pers
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-outline mb-2">
                                <span class="material-symbols-outlined text-sm">calendar_today</span>
                                <span>{{ $item->created_at ? $item->created_at->translatedFormat('d F Y') : '-' }}</span>
                            </div>
                            <h2 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('public.berita.show', $item->slug) }}">
                                    {{ $item->judul }}
                                </a>
                            </h2>
                            <p class="text-sm text-on-surface-variant leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($item->keterangan), 120) ?: 'Ikuti liputan berita selengkapnya mengenai implementasi solusi teknologi terkini.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer link -->
                    <div class="px-6 pb-6 pt-2">
                        <a href="{{ route('public.berita.show', $item->slug) }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-primary group-hover:gap-2.5 transition-all">
                            <span>Baca Selengkapnya</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-3 py-16 text-center bg-white rounded-2xl border border-gray-100">
                    <span class="material-symbols-outlined text-5xl text-gray-300 mb-2">newspaper</span>
                    <h3 class="text-lg font-bold text-gray-700">Belum ada berita yang ditemukan</h3>
                    <p class="text-sm text-gray-500 mt-1">Silakan coba kata kunci pencarian yang lain.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $news->withQueryString()->links() }}
            </div>
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
