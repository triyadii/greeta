<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Portofolio Proyek &amp; Implementasi - {{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}</title>
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
                <a class="px-3 py-2 text-sm font-bold text-primary bg-surface-container-low transition-colors rounded-lg" href="{{ route('public.portofolio') }}">Portofolio</a>
                <a class="px-3 py-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors rounded-lg" href="{{ route('public.berita') }}">Berita</a>
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
                    <span class="text-primary font-semibold">Portofolio</span>
                </nav>
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary/10 text-secondary text-xs font-bold uppercase tracking-wider mb-2">
                            <span class="w-2 h-2 rounded-full bg-secondary"></span>
                            Track Record &amp; Showcase
                        </div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-on-surface">Katalog Portofolio Proyek</h1>
                        <p class="text-on-surface-variant text-sm md:text-base mt-2 max-w-2xl">
                            Dokumentasi implementasi solusi infrastruktur jaringan, server enterprise, smart surveillance CCTV, dan rekayasa perangkat lunak terpadu.
                        </p>
                    </div>

                    <!-- Search Bar -->
                    <form action="{{ route('public.portofolio') }}" method="GET" class="w-full md:w-80">
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama project / kata kunci..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" />
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-xl">search</span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($portfolios as $port)
                <div class="bg-surface-container-lowest rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition-all group flex flex-col justify-between">
                    <div>
                        <!-- Image Gallery (Up to 3 images) -->
                        <div class="relative w-full h-56 bg-gray-100 overflow-hidden">
                            @if(is_array($port->gambar) && count($port->gambar) > 0)
                                <img src="{{ asset('storage/' . $port->gambar[0]) }}" alt="{{ $port->namaProject }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.src='https://placehold.co/600x400?text=Proyek+Gretta'" />
                                @if(count($port->gambar) > 1)
                                <div class="absolute bottom-3 right-3 px-2 py-1 rounded-md bg-black/60 text-white text-xs font-semibold backdrop-blur-sm flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">photo_library</span>
                                    <span>{{ count($port->gambar) }} Foto</span>
                                </div>
                                @endif
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 bg-surface-container-low">
                                    <span class="material-symbols-outlined text-4xl mb-1">business_center</span>
                                    <span class="text-xs">Dokumentasi Enterprise</span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <span class="text-xs font-bold text-secondary uppercase tracking-wider">Implementasi Selesai</span>
                            <h3 class="text-lg font-bold text-on-surface mt-1 mb-2 group-hover:text-primary transition-colors">
                                {{ $port->namaProject }}
                            </h3>
                            <p class="text-sm text-on-surface-variant leading-relaxed line-clamp-3">
                                {{ $port->keterangan ?: 'Proyek transformasi dan integrasi infrastruktur teknologi informasi berstandar enterprise.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Additional Images Thumbnails if any -->
                    <div class="px-6 pb-6 pt-2 border-t border-gray-50 flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            @if(is_array($port->gambar))
                                @foreach($port->gambar as $subImg)
                                    <a href="{{ asset('storage/' . $subImg) }}" target="_blank" class="w-8 h-8 rounded border border-gray-200 overflow-hidden hover:opacity-80">
                                        <img src="{{ asset('storage/' . $subImg) }}" class="w-full h-full object-cover" />
                                    </a>
                                @endforeach
                            @endif
                        </div>
                        <span class="text-xs text-outline">{{ $port->created_at ? $port->created_at->format('M Y') : 'Terbaru' }}</span>
                    </div>
                </div>
                @empty
                <div class="col-span-3 py-16 text-center bg-white rounded-2xl border border-gray-100">
                    <span class="material-symbols-outlined text-5xl text-gray-300 mb-2">folder_off</span>
                    <h3 class="text-lg font-bold text-gray-700">Belum ada portofolio yang cocok</h3>
                    <p class="text-sm text-gray-500 mt-1">Silakan coba kata kunci pencarian yang lain.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $portfolios->withQueryString()->links() }}
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
                <a href="{{ route('public.portofolio') }}" class="text-primary font-bold">Portofolio</a>
                <a href="{{ route('public.berita') }}" class="hover:text-primary">Berita</a>
                <a href="{{ route('login') }}" class="hover:text-primary">Portal Admin</a>
            </div>
        </div>
    </footer>

    @include('partials.flying-whatsapp-button')
</body>
</html>
