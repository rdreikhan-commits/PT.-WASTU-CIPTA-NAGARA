<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Project;
use App\Models\ProjectGallery;
use App\Models\ProjectProgress;
use App\Models\ProjectProgressImage;
use App\Models\ProjectDocument;
use App\Models\ProjectMeeting;
use App\Models\ProjectComment;
use App\Models\ProjectApproval;
use App\Models\TeamMember;
use App\Models\Article;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Setting;
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
        // 1. Seed Users
        $admin = User::create([
            'name' => 'Wastu Admin Team',
            'email' => 'admin@wastu.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $client = User::create([
            'name' => 'Nugraha Sentosa PT',
            'email' => 'client@wastu.com',
            'password' => Hash::make('client123'),
            'role' => 'client',
        ]);

        // 2. Seed Services
        $services = [
            [
                'title' => 'Perencanaan Umum & Masterplanning',
                'slug' => 'perencanaan-umum-dan-masterplanning',
                'icon' => 'bi-map',
                'description' => 'Perencanaan kawasan makro, tata kota, zonasi, dan masterplanning berkelanjutan dengan pendekatan ramah lingkungan.',
                'order' => 1
            ],
            [
                'title' => 'Perencanaan Teknik & Struktur',
                'slug' => 'perencanaan-teknik-dan-struktur',
                'icon' => 'bi-cpu',
                'description' => 'Detail Engineering Design (DED), perhitungan struktur baja, beton bertulang, mekanikal, elektrikal, dan plumbing (MEP).',
                'order' => 2
            ],
            [
                'title' => 'Perencanaan Konstruksi',
                'slug' => 'perencanaan-konstruksi',
                'icon' => 'bi-building-gear',
                'description' => 'Penyusunan metode pelaksanaan konstruksi, estimasi biaya secara presisi, serta penyusunan dokumen lelang.',
                'order' => 3
            ],
            [
                'title' => 'Desain Interior Premium',
                'slug' => 'desain-interior-premium',
                'icon' => 'bi-palette',
                'description' => 'Kreasi ruang dalam dengan estetika modern-minimalis, pemilihan material premium, pencahayaan dramatis, dan fungsionalitas tinggi.',
                'order' => 4
            ],
            [
                'title' => 'Desain Eksterior & Arsitektur',
                'slug' => 'desain-eksterior-dan-arsitektur',
                'icon' => 'bi-building',
                'description' => 'Perancangan fasad bangunan ikonik yang memiliki nilai seni tinggi, fungsionalitas termal, serta visual yang menakjubkan.',
                'order' => 5
            ],
            [
                'title' => 'BIM Modeling & Digital Twin',
                'slug' => 'bim-modeling-dan-digital-twin',
                'icon' => 'bi-box',
                'description' => 'Penerapan Building Information Modeling (BIM) LOD 100 hingga LOD 500 untuk visualisasi 3D, deteksi benturan, dan estimasi kuantitas.',
                'order' => 6
            ],
            [
                'title' => 'Project Management Consultancy',
                'slug' => 'project-management-consultancy',
                'icon' => 'bi-kanban',
                'description' => 'Pengawasan waktu, mutu, dan biaya proyek secara komprehensif mulai dari tahap inisiasi hingga serah terima pekerjaan.',
                'order' => 7
            ],
            [
                'title' => 'Lanskap & Desain Ekologis',
                'slug' => 'lanskap-dan-desain-ekologis',
                'icon' => 'bi-tree',
                'description' => 'Perancangan ruang terbuka hijau, integrasi vegetasi lokal, konservasi air, dan optimalisasi iklim mikro kawasan.',
                'order' => 8
            ]
        ];

        foreach ($services as $srv) {
            Service::create($srv);
        }

        // 3. Seed Settings
        $settings = [
            'company_name' => 'PT. Wastu Cipta Nagara',
            'company_tagline' => 'Luxury Minimalist Architecture & Engineering Consultant',
            'company_address' => 'Jl. Kemang Raya No. 42A, Jakarta Selatan, DKI Jakarta 12730',
            'company_email' => 'info@wastuciptanagara.co.id',
            'company_phone' => '+62 21 789 4321',
            'company_whatsapp' => '6281234567890',
            'company_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0718501257444!2d106.8155986757271!3d-6.254256661234125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1a233b8a1c9%3A0xe54df97621c165aa!2sKemang%20Raya%20Street!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid',
            'social_linkedin' => 'https://linkedin.com/company/pt-wastu-cipta-nagara',
            'social_instagram' => 'https://instagram.com/wastu.architects',
            'social_youtube' => 'https://youtube.com/wastu.engineering',
            'seo_meta_title' => 'PT. Wastu Cipta Nagara | Luxury Minimalist Architecture & Engineering',
            'seo_meta_description' => 'Konsultan arsitektur, engineering, dan konstruksi modern terpercaya di Indonesia. Menghadirkan solusi desain premium dengan efisiensi tinggi.',
            'seo_meta_keywords' => 'wastu cipta nagara, arsitek jakarta, konsultan konstruksi, bim modeling indonesia, desain interior luxury',
        ];

        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }

        // 4. Seed FAQs
        $faqs = [
            [
                'question' => 'Apa spesialisasi dari PT. Wastu Cipta Nagara?',
                'answer' => 'Kami berspesialisasi dalam penyediaan jasa konsultasi perencanaan arsitektur kelas premium, Detailed Engineering Design (DED) terintegrasi, pemodelan BIM (Building Information Modeling), serta manajemen pengawasan proyek konstruksi skala menengah hingga besar.',
                'order' => 1
            ],
            [
                'question' => 'Bagaimana proses kerja sama proyek dengan Wastu?',
                'answer' => 'Kerja sama dimulai dari konsultasi awal (briefing dan penyelarasan visi), studi kelayakan & RAB, pembuatan konsep desain dasar, detail desain teknis, hingga pengawasan masa konstruksi. Setiap tahap terpantau langsung melalui portal klien kami.',
                'order' => 2
            ],
            [
                'question' => 'Apakah klien dapat memantau perkembangan desain secara online?',
                'answer' => 'Ya. Melalui portal khusus klien di website ini, Anda dapat memantau persentase kemajuan pekerjaan, mengunduh file blueprint/RAB terbaru, menjadwalkan rapat koordinasi, serta memberikan persetujuan (approval) atau revisi terhadap draf desain langsung dari dashboard Anda.',
                'order' => 3
            ],
            [
                'question' => 'Apakah PT. Wastu Cipta Nagara melayani proyek di luar Jakarta?',
                'answer' => 'Tentu. Kami melayani proyek konsultansi dan perencanaan di seluruh wilayah Indonesia maupun regional Asia Tenggara dengan bantuan metodologi koordinasi hybrid dan implementasi BIM terstandarisasi.',
                'order' => 4
            ]
        ];

        foreach ($faqs as $f) {
            Faq::create($f);
        }

        // 5. Seed Testimonials
        $testimonials = [
            [
                'client_name' => 'Ir. Hermawan Prasetyo',
                'client_company' => 'Direktur Utama PT. Graha Abadi Semesta',
                'rating' => 5,
                'testimonial' => 'Bekerja sama dengan PT. Wastu Cipta Nagara memberikan kami kepastian mutu. Desain arsitektur modern minimalis yang dihasilkan sangat fungsional dan koordinasi BIM mereka meminimalkan rework di lapangan hingga 95%.',
                'photo_path' => 'testimonials/client1.jpg',
                'is_approved' => true,
                'order' => 1
            ],
            [
                'client_name' => 'Alexandra Wijaya',
                'client_company' => 'Founder & Owner of The Peak Villa Resort Group',
                'rating' => 5,
                'testimonial' => 'Layanan mereka sangat profesional. Portal klien online sangat membantu kami memantau progres gambar struktur dan desain interior tanpa perlu bertukar puluhan pesan instan. Sangat direkomendasikan untuk proyek premium.',
                'photo_path' => 'testimonials/client2.jpg',
                'is_approved' => true,
                'order' => 2
            ],
            [
                'client_name' => 'Budi Santoso, M.B.A.',
                'client_company' => 'VP Operations PT. TransLog Nusantara',
                'rating' => 5,
                'testimonial' => 'Tim insinyur sipil dan mekanikal-elektrikal dari Wastu sangat responsif. DED yang mereka susun sangat rinci, sehingga proses tender konstruksi kami berjalan lancar tanpa ada deviasi biaya yang berarti.',
                'photo_path' => 'testimonials/client3.jpg',
                'is_approved' => true,
                'order' => 3
            ]
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }

        // 6. Seed Team Members
        $team = [
            [
                'name' => 'Sundoro',
                'position' => 'Komisaris',
                'skills' => 'Strategic Leadership, Corporate Governance, Business Development',
                'certificate' => null,
                'linkedin_url' => null,
                'description' => 'Komisaris PT. Wastu Cipta Nagara. Berperan dalam pengawasan strategis dan tata kelola perusahaan untuk memastikan visi perusahaan tercapai.',
                'photo_path' => 'team/sundoro.jpg',
                'order' => 1
            ],
            [
                'name' => 'Mochammad Suva Nugraha',
                'position' => 'Direktur',
                'skills' => 'Architecture, Engineering Management, Project Leadership',
                'certificate' => null,
                'linkedin_url' => null,
                'description' => 'Direktur PT. Wastu Cipta Nagara. Memimpin seluruh operasional perusahaan dalam bidang konsultansi perencanaan arsitektur, engineering, dan konstruksi.',
                'photo_path' => 'team/suva.jpg',
                'order' => 2
            ]
        ];

        foreach ($team as $tm) {
            TeamMember::create($tm);
        }

        // 7. Seed Articles
        $articles = [
            [
                'title' => 'Mengapa Desain Minimalis Menjadi Standard Baru Bangunan Komersial Modern?',
                'slug' => 'mengapa-desain-minimalis-menjadi-standard-baru-bangunan-komersial-modern',
                'content' => 'Desain arsitektur minimalis modern bukan sekadar tren visual, melainkan sebuah respons terhadap tuntutan efisiensi energi, keberlanjutan material, dan kesehatan mental penghuni. Dengan ruang terbuka yang luas, pencahayaan alami yang melimpah, dan minimalisasi ornamentasi yang tidak perlu, biaya pemeliharaan gedung dapat berkurang hingga 30% per tahun. Artikel ini membahas studi kasus pemanfaatan material ramah lingkungan pada fasad modern.',
                'thumbnail' => 'blog/minimalist-commercial.jpg',
                'category' => 'Architecture Tips',
                'tags' => 'Minimalist, Commercial, Sustainability',
                'seo_title' => 'Desain Arsitektur Minimalis Bangunan Komersial Modern | Wastu',
                'seo_description' => 'Pelajari alasan utama mengapa konsep luxury minimalist architecture menjadi tolok ukur efisiensi bangunan komersial masa kini.',
                'seo_keywords' => 'arsitektur minimalis, bangunan modern, efisiensi energi gedung',
                'is_published' => true
            ],
            [
                'title' => 'Penerapan Teknologi BIM (Building Information Modeling) dalam Mencegah Deteksi Benturan di Lapangan',
                'slug' => 'penerapan-teknologi-bim-dalam-mencegah-deteksi-benturan-di-lapangan',
                'content' => 'Dalam proyek konstruksi skala besar, salah satu penyumbang terbesar pembengkakan biaya (cost overrun) adalah kesalahan koordinasi gambar kerja antar disiplin (struktur, arsitektur, dan mekanikal/elektrikal). Melalui implementasi BIM LOD 300, tim engineering PT. Wastu Cipta Nagara mendeteksi dan menyelesaikan lebih dari 120 titik benturan (clash detection) pada tahap desain sebelum kontraktor mulai membangun di lokasi.',
                'thumbnail' => 'blog/bim-technology.jpg',
                'category' => 'Technology',
                'tags' => 'BIM, Engineering, Construction, Innovation',
                'seo_title' => 'Manfaat BIM Clash Detection dalam Proyek Konstruksi | Wastu',
                'seo_description' => 'Mengurangi deviasi biaya dengan deteksi benturan otomatis menggunakan Autodesk Revit dan Navisworks.',
                'seo_keywords' => 'BIM indonesia, clash detection, gambar DED terintegrasi',
                'is_published' => true
            ],
            [
                'title' => 'Panduan Memilih Material Premium untuk Hasil Fasad yang Mewah dan Tahan Cuaca Tropis',
                'slug' => 'panduan-memilih-material-premium-untuk-hasil-fasad-yang-mewah-dan-tahan-cuaca-tropis',
                'content' => 'Iklim tropis dengan curah hujan tinggi dan paparan sinar matahari terik sepanjang tahun menjadi tantangan tersendiri bagi estetika luar bangunan. Wastu menyarankan penggunaan material inovatif seperti panel komposit ultra-durable (UHPC), batu alam travertine dengan coating hidrofobik khusus, dan kaca double-glazed rendah emisivitas untuk mengurangi panas interior sekaligus memancarkan kemewahan.',
                'thumbnail' => 'blog/facade-materials.jpg',
                'category' => 'Materials',
                'tags' => 'Exterior, Facade, Luxury Materials, Tropical Design',
                'seo_title' => 'Material Fasad Mewah Tahan Cuaca Tropis | Wastu',
                'seo_description' => 'Tips pemilihan material eksterior premium untuk rumah mewah modern di kawasan tropis.',
                'seo_keywords' => 'material fasad, arsitektur tropis, travertine premium',
                'is_published' => true
            ]
        ];

        foreach ($articles as $art) {
            Article::create($art);
        }

        // 8. Seed Projects (Public Portfolio from real data)
        $portfolioData = [
            // ===== 2024 Projects =====
            ['title' => 'BTN KC Denpasar', 'slug' => '2024-btn-kc-denpasar', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Denpasar, Bali', 'year' => '2024', 'description' => 'Proyek renovasi dan rebranding kantor cabang BTN di Denpasar, Bali. Meliputi perencanaan arsitektur interior dan eksterior sesuai standar corporate identity terbaru.', 'images' => 21],
            ['title' => 'BTN KCP Bantul', 'slug' => '2024-btn-kcp-bantul', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Bantul, Yogyakarta', 'year' => '2024', 'description' => 'Perencanaan desain ulang kantor cabang pembantu BTN Bantul dengan konsep modern minimalis dan optimalisasi ruang pelayanan nasabah.', 'images' => 14],
            ['title' => 'BTN KCP Cipocok', 'slug' => '2024-btn-kcp-cipocok', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Cipocok, Serang', 'year' => '2024', 'description' => 'Renovasi menyeluruh kantor cabang pembantu BTN Cipocok meliputi fasad bangunan, tata ruang interior, dan sistem MEP.', 'images' => 19],
            ['title' => 'BTN KCP Klaten', 'slug' => '2024-btn-kcp-klaten', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Klaten, Jawa Tengah', 'year' => '2024', 'description' => 'Proyek perencanaan renovasi kantor cabang pembantu BTN di Klaten dengan penyesuaian standar branding terbaru.', 'images' => 6],
            ['title' => 'BTN KCP Rawalumbu', 'slug' => '2024-btn-kcp-rawalumbu', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Rawalumbu, Bekasi', 'year' => '2024', 'description' => 'Perencanaan teknis dan desain arsitektur untuk renovasi besar kantor cabang pembantu BTN Rawalumbu, termasuk penataan ulang area layanan dan ruang kerja.', 'images' => 94],
            ['title' => 'BTN KCP Sepaku', 'slug' => '2024-btn-kcp-sepaku', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Sepaku, Kalimantan Timur', 'year' => '2024', 'description' => 'Desain dan perencanaan kantor cabang pembantu BTN di kawasan IKN Nusantara, Sepaku, Kalimantan Timur.', 'images' => 20],
            ['title' => 'BTN KCPS Kepanjen', 'slug' => '2024-btn-kcps-kepanjen', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Kepanjen, Malang', 'year' => '2024', 'description' => 'Proyek renovasi kantor cabang pembantu syariah BTN Kepanjen sesuai standar corporate identity perbankan syariah.', 'images' => 2],
            ['title' => 'BTN KCPS Kuningan', 'slug' => '2024-btn-kcps-kuningan', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Kuningan, Jawa Barat', 'year' => '2024', 'description' => 'Perencanaan renovasi kantor cabang pembantu syariah BTN Kuningan dengan konsep modern dan ramah lingkungan.', 'images' => 30],
            ['title' => 'BTN KCPS Parepare', 'slug' => '2024-btn-kcps-parepare', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Parepare, Sulawesi Selatan', 'year' => '2024', 'description' => 'Desain arsitektur renovasi kantor cabang pembantu syariah BTN di kota Parepare, Sulawesi Selatan.', 'images' => 34],
            ['title' => 'BTN Rebranding Sulampua', 'slug' => '2024-btn-rebranding-sulampua', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Sulawesi, Maluku & Papua', 'year' => '2024', 'description' => 'Program rebranding massal kantor-kantor BTN di wilayah Sulawesi, Maluku, dan Papua meliputi redesain fasad dan interior sesuai identitas visual terbaru.', 'images' => 20],
            ['title' => 'Rumah Narendra', 'slug' => '2024-rumah-narendra', 'category' => 'Residential', 'status' => 'completed', 'location' => 'Jakarta', 'year' => '2024', 'description' => 'Proyek desain rumah tinggal premium Rumah Narendra dengan konsep modern minimalis. Meliputi desain arsitektur, interior, dan visualisasi 3D rendering.', 'images' => 31],
            // ===== 2025 Projects =====
            ['title' => 'Bank Umum Syariah - BSN Tanah Abang', 'slug' => '2025-bank-umum-syariah---bsn-tanah-abang', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Tanah Abang, Jakarta Pusat', 'year' => '2025', 'description' => 'Proyek perencanaan arsitektur dan interior Bank Umum Syariah BSN di kawasan Tanah Abang, Jakarta Pusat.', 'images' => 26],
            ['title' => 'BTN KC Cawang', 'slug' => '2025-btn-kc-cawang', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Cawang, Jakarta Timur', 'year' => '2025', 'description' => 'Renovasi dan rebranding kantor cabang BTN Cawang dengan standar desain arsitektur dan interior terbaru.', 'images' => 7],
            ['title' => 'BTN KC Melawai', 'slug' => '2025-btn-kc-melawai', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Melawai, Jakarta Selatan', 'year' => '2025', 'description' => 'Perencanaan desain renovasi kantor cabang BTN Melawai di kawasan strategis Jakarta Selatan.', 'images' => 16],
            ['title' => 'BTN KCP Cikopo', 'slug' => '2025-btn-kcp-cikopo', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Cikopo, Jawa Barat', 'year' => '2025', 'description' => 'Proyek perencanaan renovasi kantor cabang pembantu BTN Cikopo meliputi arsitektur dan interior.', 'images' => 32],
            ['title' => 'BTN KCP Cilebut', 'slug' => '2025-btn-kcp-cilebut', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Cilebut, Bogor', 'year' => '2025', 'description' => 'Renovasi menyeluruh kantor cabang pembantu BTN Cilebut dengan desain fasad modern dan tata ruang efisien.', 'images' => 42],
            ['title' => 'BTN KCP Rancaekek', 'slug' => '2025-btn-kcp-rancaekek', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Rancaekek, Bandung', 'year' => '2025', 'description' => 'Perencanaan arsitektur renovasi kantor cabang pembantu BTN Rancaekek, Kabupaten Bandung.', 'images' => 32],
            ['title' => 'BTN KCP Tokyo Hub', 'slug' => '2025-btn-kcp-tokyo-hub', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Jakarta', 'year' => '2025', 'description' => 'Desain kantor cabang pembantu BTN dengan konsep Tokyo Hub yang modern dan inovatif.', 'images' => 14],
            ['title' => 'BTN KCP UIN', 'slug' => '2025-btn-kcp-uin', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'UIN, Jakarta', 'year' => '2025', 'description' => 'Perencanaan renovasi kantor cabang pembantu BTN di kawasan Universitas Islam Negeri (UIN) Jakarta.', 'images' => 17],
            ['title' => 'BTN KCPD Ancol', 'slug' => '2025-btn-kcpd-ancol', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Ancol, Jakarta Utara', 'year' => '2025', 'description' => 'Proyek renovasi kantor cabang pembantu digital BTN Ancol dengan konsep layanan perbankan digital.', 'images' => 44],
            ['title' => 'BTN KCPD Blok M', 'slug' => '2025-btn-kcpd-blok-m', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Blok M, Jakarta Selatan', 'year' => '2025', 'description' => 'Desain arsitektur dan interior kantor cabang pembantu digital BTN di kawasan Blok M.', 'images' => 13],
            ['title' => 'BTN KCPD ITB', 'slug' => '2025-btn-kcpd-itb', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'ITB, Bandung', 'year' => '2025', 'description' => 'Perencanaan renovasi kantor cabang pembantu digital BTN di kawasan Institut Teknologi Bandung.', 'images' => 16],
            ['title' => 'BTN KCPD Kemang', 'slug' => '2025-btn-kcpd-kemang', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Kemang, Jakarta Selatan', 'year' => '2025', 'description' => 'Proyek renovasi kantor cabang pembantu digital BTN Kemang dengan konsep premium dan modern.', 'images' => 13],
            ['title' => 'BTN KCPD Unesa', 'slug' => '2025-btn-kcpd-unesa', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'UNESA, Surabaya', 'year' => '2025', 'description' => 'Desain renovasi kantor cabang pembantu digital BTN di kawasan Universitas Negeri Surabaya.', 'images' => 25],
            ['title' => 'BTN KCPS Binjai', 'slug' => '2025-btn-kcps-binjai', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Binjai, Sumatera Utara', 'year' => '2025', 'description' => 'Perencanaan arsitektur renovasi kantor cabang pembantu syariah BTN di kota Binjai, Sumatera Utara.', 'images' => 30],
            ['title' => 'BTN KCPS Kisaran', 'slug' => '2025-btn-kcps-kisaran', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Kisaran, Sumatera Utara', 'year' => '2025', 'description' => 'Proyek renovasi dan rebranding kantor cabang pembantu syariah BTN di Kisaran, Sumatera Utara.', 'images' => 29],
            ['title' => 'BTN KCPS Klaten', 'slug' => '2025-btn-kcps-klaten', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Klaten, Jawa Tengah', 'year' => '2025', 'description' => 'Desain renovasi kantor cabang pembantu syariah BTN Klaten dengan penyesuaian identitas visual syariah.', 'images' => 22],
            ['title' => 'BTN KCPS Pemalang', 'slug' => '2025-btn-kcps-pemalang', 'category' => 'Commercial', 'status' => 'completed', 'location' => 'Pemalang, Jawa Tengah', 'year' => '2025', 'description' => 'Perencanaan renovasi kantor cabang pembantu syariah BTN di Pemalang, Jawa Tengah.', 'images' => 17],
        ];

        $featuredSlugs = [
            '2024-btn-kc-denpasar',
            '2024-btn-kcps-parepare',
            '2024-rumah-narendra',
            '2025-btn-kc-cawang',
        ];

        $order = 1;
        foreach ($portfolioData as $p) {
            $imgCount = $p['images'];
            unset($p['images']);

            $p['client_id'] = null;
            $p['project_value'] = null;
            $p['scope'] = 'Perencanaan Arsitektur, Desain Interior & Eksterior, DED';

            // Detect cover image extension dynamically
            $coverExt = 'jpeg';
            $slug = $p['slug'];
            foreach (['png', 'jpg', 'jpeg'] as $tryExt) {
                if (file_exists(storage_path("app/public/portfolio/{$slug}/01.{$tryExt}"))) {
                    $coverExt = $tryExt;
                    break;
                }
            }
            $p['cover_image'] = "portfolio/{$slug}/01.{$coverExt}";

            $p['video_url'] = null;
            $p['is_featured'] = in_array($slug, $featuredSlugs);
            $p['order'] = $order;
            $p['seo_title'] = "{$p['title']} | Portfolio PT. Wastu Cipta Nagara";
            $p['seo_description'] = $p['description'];
            $p['seo_keywords'] = 'wastu cipta nagara, renovasi kantor, desain arsitektur';

            $project = Project::create($p);

            // Seed gallery from copied images (detect extension per file)
            for ($i = 1; $i <= $imgCount; $i++) {
                $imgNum = str_pad($i, 2, '0', STR_PAD_LEFT);
                $ext = 'jpeg';
                foreach (['png', 'jpg', 'jpeg'] as $tryExt) {
                    if (file_exists(storage_path("app/public/portfolio/{$slug}/{$imgNum}.{$tryExt}"))) {
                        $ext = $tryExt;
                        break;
                    }
                }
                ProjectGallery::create([
                    'project_id' => $project->id,
                    'file_path' => "portfolio/{$slug}/{$imgNum}.{$ext}",
                    'file_type' => 'image'
                ]);
            }

            $order++;
        }

        // 9. Seed CLIENT Project (Active client project for portal demo)
        $clientProject = Project::create([
            'client_id' => $client->id,
            'title' => 'Wastu Lumina Corporate Office Tower',
            'slug' => 'wastu-lumina-corporate-office-tower',
            'category' => 'Commercial',
            'status' => 'ongoing',
            'location' => 'TB Simatupang Corridor, Jakarta Selatan',
            'year' => '2026',
            'project_value' => 125000000000,
            'scope' => 'Perencanaan Teknik Terintegrasi (DED), Koordinasi BIM Multi-Disiplin, Pengawasan Pelaksanaan Struktur, MEP & Arsitektur.',
            'description' => 'Proyek gedung perkantoran prestisius setinggi 18 lantai milik PT. Nugraha Sentosa.',
            'cover_image' => null,
            'video_url' => null,
            'is_featured' => false,
            'order' => 0,
            'seo_title' => 'Wastu Lumina Corporate Office Tower | Portfolio',
            'seo_description' => 'Detail perencanaan proyek gedung perkantoran 18 lantai di TB Simatupang.',
            'seo_keywords' => 'kantor ramah lingkungan, gedung bertingkat jakarta'
        ]);

        // 10. Seed Project Progress Tracker for Client Project
        $progressUpdates = [
            [
                'project_id' => $clientProject->id,
                'date' => '2026-04-15',
                'percentage' => 15,
                'description' => 'Penyelesaian pekerjaan galian tanah (excavation), pemancangan fondasi tiang pancang (bored piles) sedalam 35 meter, dan pemasangan dinding penahan tanah (secant pile wall).'
            ],
            [
                'project_id' => $clientProject->id,
                'date' => '2026-05-20',
                'percentage' => 30,
                'description' => 'Penyusunan pelat dasar (raft foundation) ketebalan 2 meter dengan volume pengecoran massal (mass concrete) sebesar 3.400 m3 serta dimulainya pengecoran tiang kolom lantai rubanah (basement) 1 dan 2.'
            ],
            [
                'project_id' => $clientProject->id,
                'date' => '2026-06-25',
                'percentage' => 48,
                'description' => 'Struktur utama lantai podium (lantai 1 s.d 4) selesai 100%. Pengecoran pelat lantai tipikal (lantai 5 dan 6) sedang berlangsung. Koordinasi model jalur ducting MEP tingkat 1 s.d 4 telah selesai melalui koordinasi BIM.'
            ]
        ];

        foreach ($progressUpdates as $upd) {
            $pRecord = ProjectProgress::create($upd);

            // Add progress images
            ProjectProgressImage::create([
                'project_progress_id' => $pRecord->id,
                'file_path' => "progress/lumina_progress_{$pRecord->percentage}_img1.jpg"
            ]);
            ProjectProgressImage::create([
                'project_progress_id' => $pRecord->id,
                'file_path' => "progress/lumina_progress_{$pRecord->percentage}_img2.jpg"
            ]);
        }

        // 12. Seed Project Documents for Client Project
        $documents = [
            [
                'project_id' => $clientProject->id,
                'title' => 'Surat Perjanjian Kontrak Jasa Konsultansi Perencanaan Nomor: 124/NS-WCN/V/2026',
                'file_path' => 'documents/01_KONTRAK_KERJASAMA_WASTU_LUMINA.pdf',
                'file_type' => 'pdf',
                'file_size' => '4.2 MB',
                'uploaded_by' => 'admin'
            ],
            [
                'project_id' => $clientProject->id,
                'title' => 'Detailed Engineering Design (DED) - Blueprint Gambar Arsitektur Utama (Revisi-02)',
                'file_path' => 'documents/02_BLUEPRINT_ARSITEKTUR_REV02.dwg',
                'file_type' => 'dwg',
                'file_size' => '28.6 MB',
                'uploaded_by' => 'admin'
            ],
            [
                'project_id' => $clientProject->id,
                'title' => 'Rencana Anggaran Biaya (RAB) Pelaksanaan Konstruksi Struktur & MEP - Final',
                'file_path' => 'documents/03_RAB_STRUKTUR_MEP_FINAL.xlsx',
                'file_type' => 'xlsx',
                'file_size' => '1.8 MB',
                'uploaded_by' => 'admin'
            ],
            [
                'project_id' => $clientProject->id,
                'title' => 'Paket Render Desain Interior & Eksterior Ultra-High Definition (LOD 300)',
                'file_path' => 'documents/04_RENDER_EKSTERIOR_INTERIOR_UHD.zip',
                'file_type' => 'zip',
                'file_size' => '142.5 MB',
                'uploaded_by' => 'admin'
            ]
        ];

        foreach ($documents as $doc) {
            ProjectDocument::create($doc);
        }

        // 13. Seed Project Meetings for Client Project
        $meetings = [
            [
                'project_id' => $clientProject->id,
                'meeting_title' => 'Kick-Off Rapat Koordinasi Mingguan Progres Struktur Podium',
                'description' => 'Review hasil uji tekan beton raft foundation umur 28 hari, serta penyesuaian jadwal pengiriman bekisting lantai podium tingkat 3.',
                'meeting_date' => '2026-07-08 10:00:00',
                'location_or_link' => 'Wastu Head Office, Ruang Rapat Gold (Lt. 2) atau Zoom Link: https://zoom.us/j/9876543210'
            ],
            [
                'project_id' => $clientProject->id,
                'meeting_title' => 'Rapat Penyelarasan Jalur Pipa MEP (BIM Clash Coordination)',
                'description' => 'Rapat teknis khusus penyelarasan model 3D pipa sprinkler dan jalur ducting AC sentral pada lantai 4 s.d 8 antara tim engineering Wastu dan MEP Kontraktor.',
                'meeting_date' => '2026-07-15 14:00:00',
                'location_or_link' => 'Google Meet Link: https://meet.google.com/abc-defg-hij'
            ]
        ];

        foreach ($meetings as $meet) {
            ProjectMeeting::create($meet);
        }

        // 14. Seed Project Comments for Client Project (Chat log)
        $comments = [
            [
                'project_id' => $clientProject->id,
                'user_id' => $client->id,
                'message' => 'Selamat pagi tim Wastu. Kami ingin menanyakan apakah draf desain tata ruang (interior layout) lantai 12 (Presidential Office) sudah dapat kami review? Terima kasih.'
            ],
            [
                'project_id' => $clientProject->id,
                'user_id' => $admin->id,
                'message' => 'Selamat pagi Bapak/Ibu dari tim Nugraha Sentosa. Desain tata ruang lantai 12 telah selesai kami detailkan. Kami sudah mengunggah berkas tersebut di tab "Design Approvals" untuk Anda tinjau. Anda bisa langsung memberikan persetujuan atau catatan revisi di sana.'
            ],
            [
                'project_id' => $clientProject->id,
                'user_id' => $client->id,
                'message' => 'Baik, segera kami cek dan diskusikan secara internal dengan jajaran direksi kami. Terima kasih atas respon cepatnya.'
            ]
        ];

        foreach ($comments as $comm) {
            ProjectComment::create($comm);
        }

        // 15. Seed Project Design Approvals for Client Project
        ProjectApproval::create([
            'project_id' => $clientProject->id,
            'title' => 'Draf Layout Rencana Ruang Direksi & CEO (Lantai 12) - Rev 01',
            'description' => 'Rencana sekat ruang kaca tempered, konfigurasi ruang meeting privat, mini lounge, dan pemilihan lantai parket kayu solid oak.',
            'file_path' => 'approvals/LUMINA_TATA_RUANG_LT12_REV01.pdf',
            'status' => 'pending',
            'revision_notes' => null
        ]);

        ProjectApproval::create([
            'project_id' => $clientProject->id,
            'title' => 'Skema Desain Atrium Utama & Foyer Lobby Ground Floor (APPROVED)',
            'description' => 'Sertifikasi tata letak pilar utama berlapis marmer Carrara, ketinggian ceiling 8 meter, dan integrasi dinding kolam air terjun buatan.',
            'file_path' => 'approvals/LUMINA_ATRIUM_LOBBY_GROUND_FINAL.pdf',
            'status' => 'approved',
            'revision_notes' => 'Telah disetujui dalam rapat direksi tanggal 10 Juni 2026. Desain dapat diturunkan menjadi gambar konstruksi lapangan.'
        ]);
    }
}
