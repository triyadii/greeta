<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use App\Models\Menu;
use App\Models\News;
use App\Models\OperationalArea;
use App\Models\Pillar;
use App\Models\Portfolio;
use App\Models\Quotation;
use App\Models\Role;
use App\Models\User;
use App\Models\VisionMission;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. ROLES
        $superadminRole = Role::firstOrCreate(
            ['namaRole' => 'Superadmin'],
            ['uuid' => (string) Str::uuid()]
        );

        $adminRole = Role::firstOrCreate(
            ['namaRole' => 'Admin'],
            ['uuid' => (string) Str::uuid()]
        );

        $staffRole = Role::firstOrCreate(
            ['namaRole' => 'Staff'],
            ['uuid' => (string) Str::uuid()]
        );

        // 2. USERS
        User::firstOrCreate(
            ['email' => 'admin@greeta.id'],
            [
                'uuid' => (string) Str::uuid(),
                'name' => 'Super Administrator',
                'password' => Hash::make('password123'),
                'role_id' => $superadminRole->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'staff@greeta.id'],
            [
                'uuid' => (string) Str::uuid(),
                'name' => 'Operational Staff',
                'password' => Hash::make('password123'),
                'role_id' => $staffRole->id,
            ]
        );

        // 3. MENUS & AKSES
        $menus = [
            [
                'namaMenu' => 'Dashboard',
                'url' => '/admin/dashboard',
                'icon' => 'ki-duotone ki-element-11',
                'akses' => ['Superadmin', 'Admin', 'Staff'],
                'urutan' => 1,
            ],
            [
                'namaMenu' => 'Manajemen Menu & Akses',
                'url' => '/admin/menus',
                'icon' => 'ki-duotone ki-abstract-26',
                'akses' => ['Superadmin'],
                'urutan' => 2,
            ],
            [
                'namaMenu' => 'Manajemen Role Akses',
                'url' => '/admin/roles',
                'icon' => 'ki-duotone ki-shield-tick',
                'akses' => ['Superadmin'],
                'urutan' => 3,
            ],
            [
                'namaMenu' => 'Manajemen Profil Perusahaan',
                'url' => '/admin/profil',
                'icon' => 'ki-duotone ki-shop',
                'akses' => ['Superadmin', 'Admin'],
                'urutan' => 4,
            ],
            [
                'namaMenu' => 'Manajemen Visi Misi',
                'url' => '/admin/visi-misi',
                'icon' => 'ki-duotone ki-compass',
                'akses' => ['Superadmin', 'Admin'],
                'urutan' => 5,
            ],
            [
                'namaMenu' => 'Manajemen Penawaran',
                'url' => '/admin/penawaran',
                'icon' => 'ki-duotone ki-message-text-2',
                'akses' => ['Superadmin', 'Admin', 'Staff'],
                'urutan' => 6,
            ],
            [
                'namaMenu' => 'Manajemen Wilayah Operasional',
                'url' => '/admin/wilayah',
                'icon' => 'ki-duotone ki-map',
                'akses' => ['Superadmin', 'Admin'],
                'urutan' => 7,
            ],
            [
                'namaMenu' => 'Manajemen Portofolio',
                'url' => '/admin/portofolio',
                'icon' => 'ki-duotone ki-briefcase',
                'akses' => ['Superadmin', 'Admin'],
                'urutan' => 8,
            ],
            [
                'namaMenu' => 'Manajemen Pilar Layanan',
                'url' => '/admin/pilar',
                'icon' => 'ki-duotone ki-category',
                'akses' => ['Superadmin', 'Admin'],
                'urutan' => 9,
            ],
            [
                'namaMenu' => 'Manajemen Berita',
                'url' => '/admin/berita',
                'icon' => 'ki-duotone ki-document',
                'akses' => ['Superadmin', 'Admin', 'Staff'],
                'urutan' => 10,
            ],
            [
                'namaMenu' => 'Manajemen Visitor',
                'url' => '/admin/visitors',
                'icon' => 'ki-duotone ki-people',
                'akses' => ['Superadmin', 'Admin'],
                'urutan' => 11,
            ],
        ];

        foreach ($menus as $m) {
            Menu::firstOrCreate(
                ['namaMenu' => $m['namaMenu']],
                [
                    'uuid' => (string) Str::uuid(),
                    'url' => $m['url'],
                    'icon' => $m['icon'],
                    'akses' => $m['akses'],
                    'urutan' => $m['urutan'],
                ]
            );
        }

        // 4. PROFIL PERUSAHAAN
        CompanyProfile::firstOrCreate(
            ['namaPerusahaan' => 'PT. Gretta Solutions Network'],
            [
                'uuid' => (string) Str::uuid(),
                'alamatPerusahan' => 'Jalan Ujung Serdang, Kec. Tanjung Morawa, Kab. Deli Serdang, Sumatera Utara',
                'nomorTeleponPerusahaan' => '+62 853 - 558 - 36787',
                'emailPerusahaan' => 'grettasolutionsnetwork@gmail.com',
                'websitePerusahaan' => 'https://grettasolutionsnetwork.id',
                'instagram' => 'https://instagram.com/grettasolutions',
                'tiktok' => 'https://tiktok.com/@grettasolutions',
                'treads' => 'https://threads.net/@grettasolutions',
                'facebook' => 'https://facebook.com/grettasolutions',
            ]
        );

        // 5. VISI & MISI
        VisionMission::firstOrCreate(
            ['visi' => 'Menjadi penyedia solusi teknologi informasi, telekomunikasi, dan integrasi sistem enterprise terdepan dan terpercaya di Indonesia.'],
            [
                'uuid' => (string) Str::uuid(),
                'misi' => "1. Memberikan pelayanan profesional, responsif, dan berorientasi pada kepuasan klien dengan mutu presisi tinggi.\n2. Mengembangkan infrastruktur jaringan telekomunikasi dan konektivitas berkecepatan tinggi yang andal dan berkelanjutan.\n3. Menghadirkan solusi digital cerdas terpadu dan dukungan purna jual 24/7/365 bagi sektor korporasi, kesehatan, dan instansi publik.",
            ]
        );

        // 6. WILAYAH OPERASIONAL
        $areas = [
            [
                'namaWilayah' => 'Sumatera',
                'keterangan' => 'Kantor Pusat Logistik, Hub Utama Medan, Deli Serdang & Sekitarnya',
            ],
            [
                'namaWilayah' => 'Jawa',
                'keterangan' => 'Mitra Korporasi & Implementasi Enterprise Jabodetabek serta Surabaya',
            ],
            [
                'namaWilayah' => 'Bali',
                'keterangan' => 'Hospitality IT Solutions, Hotel & Resort High-Speed Network Denpasar',
            ],
            [
                'namaWilayah' => 'Kalimantan',
                'keterangan' => 'Infrastruktur Konektivitas Industri Manufaktur, Mining & Kawasan IKN',
            ],
            [
                'namaWilayah' => 'Sulawesi',
                'keterangan' => 'Digitalisasi Layanan Kesehatan & Jaringan Rumah Sakit Terintegrasi Makassar',
            ],
        ];

        foreach ($areas as $a) {
            OperationalArea::firstOrCreate(
                ['namaWilayah' => $a['namaWilayah']],
                [
                    'uuid' => (string) Str::uuid(),
                    'keterangan' => $a['keterangan'],
                ]
            );
        }

        // 7. PILAR LAYANAN (10 PILAR)
        $pillars = [
            [
                'namaPilar' => 'Connectivity & Networking',
                'keterangan' => 'Penyediaan link dedicated internet 1:1, jalur transmisi fiber optic redundant, dan arsitektur SD-WAN terpusat inter-branch.',
            ],
            [
                'namaPilar' => 'Integrated Smart CCTV',
                'keterangan' => 'Pengadaan dan instalasi IP Camera resolusi tinggi, sistem storage NVR terenkripsi, sensor perimeter, dan access control terintegrasi.',
            ],
            [
                'namaPilar' => 'IT Service & Maintenance',
                'keterangan' => 'Layanan pemeliharaan sistem terpadu proaktif dengan jaminan Helpdesk 24/7 dan SLA incident response 15-30 menit.',
            ],
            [
                'namaPilar' => 'Digital Solutions & Web Apps',
                'keterangan' => 'Rekayasa perangkat lunak sistem informasi manajemen, integrasi API perbankan/BPJS/SatuSehat, serta aplikasi berbasis web enterprise.',
            ],
            [
                'namaPilar' => 'Procurement & Hardware Supply',
                'keterangan' => 'Pengadaan resmi perangkat keras jaringan (Switch Manageable, Router Enterprise, SFP Module, Server Rack) dari distributor resmi.',
            ],
            [
                'namaPilar' => 'Enterprise Hardware & Software',
                'keterangan' => 'Lisensi resmi sistem operasi server, database enterprise, virtualisasi berlisensi, dan garansi principal 100%.',
            ],
            [
                'namaPilar' => 'Security & Electronic Systems',
                'keterangan' => 'Proteksi cyber security firewall generasi terbaru, sistem pencegahan intrusi, sistem IP PBX telepon kantor, dan otomasi gedung.',
            ],
            [
                'namaPilar' => 'Rental & Sewa Perangkat IT',
                'keterangan' => 'Skema sewa fleksibel PC workstation, laptop kantor, printer multifungsi, dan rack server untuk efisiensi CAPEX/OPEX perusahaan.',
            ],
            [
                'namaPilar' => 'Virtualization & Video Display',
                'keterangan' => 'Klaster virtualisasi server (VMware vSphere / Proxmox VE), solusi disaster recovery, dan layar videowall command center terpusat.',
            ],
            [
                'namaPilar' => 'IT Consultant & Architecture Audit',
                'keterangan' => 'Konsultasi perencanaan arsitektur IT komprehensif, evaluasi kelayakan infrastruktur data center, dan audit kepatuhan regulasi.',
            ],
        ];

        foreach ($pillars as $p) {
            Pillar::firstOrCreate(
                ['namaPilar' => $p['namaPilar']],
                [
                    'uuid' => (string) Str::uuid(),
                    'keterangan' => $p['keterangan'],
                ]
            );
        }

        // 8. PORTOFOLIO PROYEK
        $portfolios = [
            [
                'namaProject' => 'Implementasi Sistem Informasi Terpadu & Rekam Medis Elektronik (RME)',
                'keterangan' => 'Digitalisasi alur operasional klinis dan manajerial rumah sakit mencakup Rekam Medis Elektronik terstandar Kemenkes SatuSehat, antrian poliklinik online, bridging klaim BPJS V-Claim, modul farmasi, kasir, dan rawat inap dengan dukungan SLA 99.8%.',
                'gambar' => [
                    'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1504813184591-01572f98c85f?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'namaProject' => 'Penggelaran Jaringan Dedicated Fiber Optic 10 Gbps & SD-WAN Inter-Branch',
                'keterangan' => 'Pembangunan jalur transmisi fiber optic redundant dedicated 1:1 dan konfigurasi SD-WAN interkoneksi kantor pusat, pabrik manufaktur, dan gudang logistik dengan latency sangat rendah (<5ms) dan auto-failover link.',
                'gambar' => [
                    'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'namaProject' => 'Sistem Pengawasan Terpadu Smart CCTV AI & Command Center Monitoring',
                'keterangan' => 'Pemasangan ratusan titik IP Camera definisi tinggi dengan AI motion detection, centralized NVR storage terenkripsi, sensor perimeter fasilitas, dan integrasi layar videowall command center terpusat multi-site.',
                'gambar' => [
                    'https://images.unsplash.com/photo-1557597774-9d273605dfa9?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1508739773434-c26b3d09e071?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'namaProject' => 'Modernisasi Data Center Rack Server Enterprise & Virtualisasi VMware',
                'keterangan' => 'Pengadaan server rack enterprise tier-3, managed core switches 40G, Next-Generation Firewall cyber protection, dan klaster virtualisasi VMware/Proxmox dengan skema cadangan data otomatis Disaster Recovery Plan.',
                'gambar' => [
                    'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'namaProject' => 'Infrastruktur Konektivitas Wireless WiFi 6 High-Density Resort & Hotel',
                'keterangan' => 'Perancangan dan implementasi jaringan nirkabel WiFi 6 berkecepatan tinggi dengan roaming tanpa jeda, captive portal voucher tamu terintegrasi, dan manajemen bandwidth cerdas untuk kawasan perhotelan bintang lima.',
                'gambar' => [
                    'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'namaProject' => 'Sistem Antrian Cerdas Terintegrasi & Smart Display Layanan Publik',
                'keterangan' => 'Pengadaan mesin antrian layar sentuh kios, audio paging otomatis, monitor pemanggil display loket digital, serta integrasi statistik antrian real-time ke dasbor pimpinan instansi.',
                'gambar' => [
                    'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
        ];

        foreach ($portfolios as $port) {
            Portfolio::firstOrCreate(
                ['namaProject' => $port['namaProject']],
                [
                    'uuid' => (string) Str::uuid(),
                    'keterangan' => $port['keterangan'],
                    'gambar' => $port['gambar'],
                ]
            );
        }

        // 9. BERITA & ARTIKEL
        $newsItems = [
            [
                'judul' => 'PT. Gretta Solutions Network Perluas Akselerasi Jaringan Dedicated Fiber Optic di Koridor Industri Nasional',
                'slug' => 'perluasan-jaringan-fiber-optic-koridor-industri-nasional',
                'keterangan' => "<p>Menjawab tingginya permintaan terhadap konektivitas data korporasi berkecepatan tinggi, PT. Gretta Solutions Network secara resmi mengumumkan penambahan kapasitas infrastruktur jaringan transmisi dedicated fiber optic.</p>\n<p>Ekspansi ini difokuskan untuk menghubungkan klaster kawasan industri strategis di Sumatera Utara, Riau, hingga kawasan industri terpadu di Jawa Barat dan Jawa Timur. Dengan arsitektur backbone redundant dan pemantauan 24/7 melalui Network Operations Center (NOC), mitra korporasi dijamin menikmati ketersediaan uptime hingga 99.99%.</p>\n<p>\"Konektivitas stabil dan latensi rendah adalah pondasi fundamental bagi revolusi industri 4.0 dan adopsi cloud computing modern,\" ungkap perwakilan teknis PT. Gretta Solutions Network.</p>",
                'gambar' => [
                    'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'judul' => 'Kesiapan Transformasi Digital Fasilitas Kesehatan: Integrasi Rekam Medis Elektronik Terstandar SatuSehat',
                'slug' => 'kesiapan-transformasi-digital-faskes-rme-satusehat',
                'keterangan' => "<p>Kementerian Kesehatan RI telah menetapkan batas kewajiban integrasi Rekam Medis Elektronik (RME) bagi seluruh fasilitas pelayanan kesehatan di Indonesia melalui platform SatuSehat.</p>\n<p>PT. Gretta Solutions Network hadir membantu manajemen rumah sakit dan klinik dalam memenuhi standar tersebut secara menyeluruh, mulai dari perancangan arsitektur server lokal yang aman, implementasi modul rekam medis digital berbasis web, bridging API BPJS V-Claim, hingga perlindungan data medis pasien sesuai UU PDP (Pelindungan Data Pribadi).</p>\n<p>Digitalisasi ini terbukti memangkas waktu tunggu pasien di loket poliklinik hingga 60% dan mencegah risiko kehilangan berkas fisik rekam medis.</p>",
                'gambar' => [
                    'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'judul' => 'Strategi Perlindungan Keamanan Siber Enterprise: Menangkal Ancaman Ransomware di Tahun 2026',
                'slug' => 'strategi-keamanan-siber-enterprise-menangkal-ransomware-2026',
                'keterangan' => "<p>Serangan siber dan enkripsi ilegal file oleh sindikat ransomware kian meningkat menyasar sektor korporasi dan instansi pemerintahan. Diperlukan pendekatan pertahanan berlapis (defense-in-depth) yang tidak hanya mengandalkan antivirus konvensional.</p>\n<p>Dalam artikel ini, tim insinyur cyber security PT. Gretta Solutions Network memaparkan tiga pilar proteksi penting: segmentasi jaringan internal melalui Next-Generation Firewall, implementasi Zero-Trust Network Access (ZTNA), serta backup data berbasis immutable snapshot yang terisolasi dari jaringan utama (air-gapped storage).</p>",
                'gambar' => [
                    'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'judul' => 'Optimalisasi Belanja Teknologi Melalui Skema Sewa dan Rental Perangkat IT Enterprise',
                'slug' => 'optimalisasi-capex-sewa-rental-perangkat-it-enterprise',
                'keterangan' => "<p>Banyak perusahaan menghadapi kendala penyusutan aset cepat dan besarnya belanja modal (CAPEX) saat melakukan peremajaan komputer, laptop, dan server kantor secara berkala.</p>\n<p>Solusi sewa dan managed hardware rental dari PT. Gretta Solutions Network memberikan alternatif cerdas dengan mengubah pengeluaran modal menjadi biaya operasional (OPEX) yang terprediksi. Seluruh unit yang disewa disertai garansi penggantian suku cadang prioritas dan dukungan teknisi onsite tanpa biaya tambahan.</p>",
                'gambar' => [
                    'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
        ];

        foreach ($newsItems as $news) {
            News::firstOrCreate(
                ['slug' => $news['slug']],
                [
                    'uuid' => (string) Str::uuid(),
                    'judul' => $news['judul'],
                    'keterangan' => $news['keterangan'],
                    'gambar' => $news['gambar'],
                ]
            );
        }

        // 10. PENAWARAN (LEADS & KONSULTASI)
        $quotations = [
            [
                'namaPIC' => 'dr. Hendra Pratama, Sp.A',
                'namaPerusahaan' => 'RSUD Prima Husada Medika',
                'nomorTelepon' => '081298765432',
                'email' => 'hendra.pratama@rsudprimahusada.go.id',
                'jenisKebutuhan' => 'Sistem Informasi & Aplikasi Bisnis',
                'deskripsi' => 'Rencana implementasi integrasi Rekam Medis Elektronik (RME) SatuSehat Kemenkes dan modul antrian online untuk 18 poliklinik spesialis.',
                'status' => 'baru',
            ],
            [
                'namaPIC' => 'Bambang Sudiro, S.T.',
                'namaPerusahaan' => 'PT Surya Agro Industri Sejahtera',
                'nomorTelepon' => '085211223344',
                'email' => 'bambang.s@suryaindustri.co.id',
                'jenisKebutuhan' => 'Infrastruktur Konektivitas & Fiber Optic',
                'deskripsi' => 'Pengadaan link dedicated internet 1:1 kapasitas 500 Mbps redundant dan penarikan kabel fiber optic inter-branch antargudang 3 KM.',
                'status' => 'diproses',
            ],
            [
                'namaPIC' => 'Siti Nurhaliza, S.Kom',
                'namaPerusahaan' => 'Koperasi Merah Putih Makmur Bersama',
                'nomorTelepon' => '081377889900',
                'email' => 'pengurus@koperasimerahputih.org',
                'jenisKebutuhan' => 'Sewa & Rental Perangkat IT (Laptop/PC Kantor)',
                'deskripsi' => 'Permintaan sewa 45 unit Laptop Core i5 dan 3 unit switch manage 24-port untuk operasional digitalisasi UMKM daerah.',
                'status' => 'selesai',
            ],
            [
                'namaPIC' => 'Ir. Faisal Akbar',
                'namaPerusahaan' => 'Kawasan Industri Terpadu Nusantara',
                'nomorTelepon' => '087866554433',
                'email' => 'faisal.akbar@kitnusantara.com',
                'jenisKebutuhan' => 'Pengadaan & Integrasi CCTV / Smart Surveillance',
                'deskripsi' => 'Pemasangan 60 unit IP Camera perimeter dengan sensor AI dan videowall monitoring terpusat di gedung security command center.',
                'status' => 'baru',
            ],
        ];

        foreach ($quotations as $q) {
            Quotation::firstOrCreate(
                ['email' => $q['email']],
                [
                    'uuid' => (string) Str::uuid(),
                    'namaPIC' => $q['namaPIC'],
                    'namaPerusahaan' => $q['namaPerusahaan'],
                    'nomorTelepon' => $q['nomorTelepon'],
                    'jenisKebutuhan' => $q['jenisKebutuhan'],
                    'deskripsi' => $q['deskripsi'],
                    'status' => $q['status'],
                ]
            );
        }

        // 11. STATISTIK VISITOR
        // Generate realistic visitors for today and past week
        $visitorSamples = [
            // Today visitors
            ['ip' => '180.252.164.21', 'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128.0', 'days_ago' => 0, 'count' => 5],
            ['ip' => '36.85.120.45',   'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_6) Safari/605.1', 'days_ago' => 0, 'count' => 3],
            ['ip' => '114.122.38.99',  'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) Chrome/127.0', 'days_ago' => 0, 'count' => 7],
            ['ip' => '182.253.88.10',  'ua' => 'Mozilla/5.0 (Linux; Android 14; SM-S928B) Chrome/126.0', 'days_ago' => 0, 'count' => 2],
            ['ip' => '103.111.201.5',  'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:129.0) Gecko/20100101 Firefox/129.0', 'days_ago' => 0, 'count' => 4],
            ['ip' => '139.195.42.18',  'ua' => 'Mozilla/5.0 (iPad; CPU OS 17_5 like Mac OS X) AppleWebKit/605.1.15', 'days_ago' => 0, 'count' => 2],
            ['ip' => '103.47.133.72',  'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Edge/127.0', 'days_ago' => 0, 'count' => 6],
            ['ip' => '111.94.75.12',   'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 14_5) Safari/605.1.15', 'days_ago' => 0, 'count' => 3],

            // Yesterday & past days
            ['ip' => '202.67.40.11',   'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128.0', 'days_ago' => 1, 'count' => 12],
            ['ip' => '180.248.11.95',  'ua' => 'Mozilla/5.0 (Linux; Android 13) Chrome/125.0', 'days_ago' => 1, 'count' => 8],
            ['ip' => '36.69.14.88',    'ua' => 'Mozilla/5.0 (Windows NT 11.0; Win64; x64) Chrome/128.0', 'days_ago' => 1, 'count' => 9],
            ['ip' => '114.79.44.15',   'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_7) Safari/604.1', 'days_ago' => 2, 'count' => 15],
            ['ip' => '103.28.12.90',   'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/127.0', 'days_ago' => 2, 'count' => 11],
            ['ip' => '125.166.7.34',   'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 13_4) Firefox/128.0', 'days_ago' => 3, 'count' => 18],
            ['ip' => '182.1.205.44',   'ua' => 'Mozilla/5.0 (Linux; Android 12) Chrome/120.0', 'days_ago' => 3, 'count' => 14],
            ['ip' => '103.144.17.2',   'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128.0', 'days_ago' => 4, 'count' => 22],
            ['ip' => '36.88.201.19',   'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_4) Safari/605.1', 'days_ago' => 5, 'count' => 19],
            ['ip' => '114.125.80.3',   'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Edge/126.0', 'days_ago' => 6, 'count' => 25],
        ];

        foreach ($visitorSamples as $v) {
            $visitDate = Carbon::today()->subDays($v['days_ago'])->toDateString();
            Visitor::firstOrCreate(
                [
                    'ip_address' => $v['ip'],
                    'visit_date' => $visitDate,
                ],
                [
                    'uuid' => (string) Str::uuid(),
                    'user_agent' => $v['ua'],
                    'visit_count' => $v['count'],
                    'created_at' => Carbon::today()->subDays($v['days_ago'])->setHour(rand(8, 20))->setMinute(rand(0, 59)),
                    'updated_at' => Carbon::today()->subDays($v['days_ago'])->setHour(rand(8, 20))->setMinute(rand(0, 59)),
                ]
            );
        }
    }
}
