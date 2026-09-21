<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Data Dummy Global / Fasilitas Utama
     */
    private function getFacilities()
    {
        return [
            [
                'title' => 'Kapasitas s.d 400 Tamu',
                'desc' => 'Pendopo utama semi-terbuka luas berpadu dengan halaman asri, cocok untuk acara intim hingga resepsi besar.',
                'icon' => 'fa-users',
                'highlight' => 'Pendopo 15x18m'
            ],
            [
                'title' => 'Area Parkir Luas & Aman',
                'desc' => 'Daya tampung hingga 45 mobil dan 100+ sepeda motor dengan petugas keamanan khusus.',
                'icon' => 'fa-square-parking',
                'highlight' => 'Kapasitas 45+ Mobil'
            ],
            [
                'title' => 'Kamar Rias & Vila AC',
                'desc' => '2 kamar rias privat full AC dengan cermin rias profesional, kamar mandi dalam, dan water heater.',
                'icon' => 'fa-bed',
                'highlight' => '2 Kamar Privat Ber-AC'
            ],
            [
                'title' => 'Daya Listrik 10.000 VA',
                'desc' => 'Daya listrik mencukupi untuk kebutuhan lighting dan sound system, dilengkapi genset backup darurat.',
                'icon' => 'fa-bolt',
                'highlight' => 'Listrik Stabil + Genset Backup'
            ],
            [
                'title' => 'Dapur Bersih & Area Katering',
                'desc' => 'Area preparation katering khusus yang higienis, terpisah dari area tamu utama, dengan akses loading mudah.',
                'icon' => 'fa-utensils',
                'highlight' => 'Akses Loading Mandiri'
            ],
            [
                'title' => 'Taman Asri & Gazebo Kayu',
                'desc' => 'Lanskap rumput hijau jepang, pohon rindang peneduh, serta spot foto bernuansa pedesaan Jawa yang menenangkan.',
                'icon' => 'fa-tree',
                'highlight' => 'Spot Foto Alami'
            ],
        ];
    }

    /**
     * Data Dummy Paket Sewa
     */
    private function getPackages()
    {
        return [
            [
                'id' => 'photoshoot',
                'name' => 'Paket Photoshoot & Video',
                'slug' => 'photoshoot-commercial',
                'subtitle' => 'Untuk Prewedding, Buku Tahunan, Katalog Produk & Syuting Komersial',
                'price' => 'Rp 2.500.000',
                'duration' => 'Maksimal 6 Jam Penggunaan',
                'featured' => false,
                'tag' => 'Favorit Prewedding',
                'inclusions' => [
                    'Akses seluruh area Joglo & Taman Terbuka',
                    '1 Ruang Ganti / Rias ber-AC',
                    'Daya listrik standar untuk lighting foto/video',
                    'Akses properti dekorasi joglo antik',
                    'Free air mineral galon & dispenser',
                    'Kapasitas kru s.d 15 orang'
                ],
                'note' => 'Cocok untuk sesi foto pagi (golden hour) atau sore hari.'
            ],
            [
                'id' => 'intimate-event',
                'name' => 'Paket Half-Day Intimate Event',
                'slug' => 'half-day-event',
                'subtitle' => 'Pilihan tepat untuk Lamaran, Akad Nikah, Siraman, Arisan, atau Ulang Tahun',
                'price' => 'Rp 8.500.000',
                'duration' => '6 Jam Pemakaian (Pagi / Sore)',
                'featured' => false,
                'tag' => 'Paling Populer',
                'inclusions' => [
                    'Kapasitas s.d 150 tamu undangan',
                    'Pendopo utama & teras samping',
                    '1 Ruang VIP / Kamar Rias ber-AC',
                    'Sound system standar (2 mic wireless + speaker)',
                    'Kursi futura 50 unit + cover krem',
                    'Area katering & dapur preparation',
                    'Daya listrik 5.000 VA',
                    'Petugas kebersihan & keamanan stand-by'
                ],
                'note' => 'Bebas biaya vendor luar (no corkage fee untuk rekanan standar).'
            ],
            [
                'id' => 'wedding-fullday',
                'name' => 'Paket Grand Pendopo Wedding',
                'slug' => 'grand-wedding-fullday',
                'subtitle' => 'Penyelenggaraan Resepsi Pernikahan Megah & Sakral bernuansa Tradisional Jawa',
                'price' => 'Rp 18.500.000',
                'duration' => '12 Jam Pemakaian Fleksibel',
                'featured' => true,
                'tag' => 'Paling Diminati',
                'inclusions' => [
                    'Kapasitas leluasa s.d 400 tamu',
                    'Eksklusif seluruh area (Pendopo, Taman, Gazebo, Selasar)',
                    '2 Kamar Penginapan/Rias ber-AC (Bisa untuk transit keluarga)',
                    'Daya listrik 10.000 VA + Genset standby cadangan',
                    'Kursi futura 100 unit + cover elegan',
                    'Meja prasmanan & gubukan kayu jati otentik',
                    'Tim kebersihan selama acara & pasca acara',
                    'Ruang transit keluarga inti & toilet khusus pengantin',
                    'Area parkir terkelola dengan petugas parkir berpengalaman',
                    'Izin keramaian & koordinasi lingkungan'
                ],
                'note' => 'Bonus menginap 1 malam di Rumah Glamping Kayu untuk pengantin.'
            ],
            [
                'id' => 'homestay-gathering',
                'name' => 'Paket Inap & Family Gathering',
                'slug' => 'homestay-gathering',
                'subtitle' => 'Liburan keluarga besar, arisan trah, atau retreat komunitas dalam ketenangan pedesaan',
                'price' => 'Rp 4.750.000',
                'duration' => '24 Jam (Check-in 14.00, Check-out 12.00)',
                'featured' => false,
                'tag' => 'Keluarga & Komunitas',
                'inclusions' => [
                    'Akomodasi inap kapasitas 15–20 orang',
                    '3 Kamar tidur ber-AC dengan ranjang kayu jati',
                    'Pendopo luas untuk kumpul santai & karaoke',
                    'Dapur lengkap dengan alat masak, kompor, dan kulkas',
                    'Alat bakar BBQ di halaman taman',
                    'Smart TV, High-speed Wi-Fi 50 Mbps, Sound karaoke',
                    'Sarapan tradisional khas ndeso untuk 15 porsi',
                    'Parkir muat 10+ mobil keluarga'
                ],
                'note' => 'Suasana hening dan sejuk, jauh dari kebisingan jalan protokol.'
            ],
        ];
    }

    /**
     * Data Dummy Galeri Foto
     */
    private function getGallery()
    {
        return [
            [
                'title' => 'Pendopo Utama Kayu Jati',
                'category' => 'pendopo',
                'category_label' => 'Pendopo Utama',
                'image' => asset('assets/joglo.jpg'),
                'desc' => 'Tiang saka guru jati lawas dengan ukiran tumpang sari otentik Jepara yang memukau.'
            ],
            [
                'title' => 'Dekorasi Pelaminan Tradisional',
                'category' => 'acara',
                'category_label' => 'Momen Acara',
                'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=80',
                'desc' => 'Sentuhan dekorasi bunga melati dan gebyok kayu jati menciptakan suasana sakral.'
            ],
            [
                'title' => 'Halaman Rumput & Garden Area',
                'category' => 'taman',
                'category_label' => 'Taman & Outdoor',
                'image' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&w=1200&q=80',
                'desc' => 'Taman tropis asri nan lapang, ideal untuk resepsi outdoor dan standing party.'
            ],
            [
                'title' => 'Selasar Lampu Antik & Suasana Malam',
                'category' => 'pendopo',
                'category_label' => 'Pendopo Utama',
                'image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80',
                'desc' => 'Cahaya temaram lampu gantung antik Jawa menambah romansa hangat di malam hari.'
            ],
            [
                'title' => 'Kamar Tidur Utama & Rias Pengantin',
                'category' => 'kamar',
                'category_label' => 'Kamar & Penginapan',
                'image' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=1200&q=80',
                'desc' => 'Kamar rias sejuk berfasilitas lengkap untuk kenyamanan calon pengantin dan keluarga.'
            ],
            [
                'title' => 'Meja Prasmanan & Setup Katering',
                'category' => 'acara',
                'category_label' => 'Momen Acara',
                'image' => 'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=1200&q=80',
                'desc' => 'Area prasmanan dengan sirkulasi alur tamu yang lapang dan teratur.'
            ],
            [
                'title' => 'Gazebo Santai di Pinggir Kolam',
                'category' => 'taman',
                'category_label' => 'Taman & Outdoor',
                'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80',
                'desc' => 'Gazebo kayu santai dengan semilir angin sejuk dan gemericik air menenangkan.'
            ],
            [
                'title' => 'Kamar Mandi Bersih & Modern',
                'category' => 'kamar',
                'category_label' => 'Kamar & Penginapan',
                'image' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=1200&q=80',
                'desc' => 'Kamar mandi dengan sanitary ware modern, water heater, dan kebersihan terjamin.'
            ],
            [
                'title' => 'Sesi Prewedding Nuansa Adat',
                'category' => 'acara',
                'category_label' => 'Momen Acara',
                'image' => 'https://images.unsplash.com/photo-1537633552985-df8429e8048b?auto=format&fit=crop&w=1200&q=80',
                'desc' => 'Estetika klasik yang menghasilkan foto prewedding anggun dan penuh kenangan.'
            ]
        ];
    }

    /**
     * Data Dummy Testimoni
     */
    private function getTestimonials()
    {
        return [
            [
                'name' => 'Dimas & Anindya',
                'role' => 'Pasangan Pengantin (Resepsi Tradisional)',
                'quote' => 'Joglo Omah Ayem mewujudkan mimpi pernikahan adat Jawa kami yang sakral sekaligus akrab. Ukiran jati dan tumpang sarinya luar biasa estetik, tamu-tamu kami sangat terkesan dengan suasana adem dan pelayanannya yang ramah.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'date' => 'Agustus 2026'
            ],
            [
                'name' => 'Bambang Kusumo',
                'role' => 'Ketua Panitia Reuni & Trah Keluarga',
                'quote' => 'Tempatnya betul-betul ayem dan tenang sesuai namanya. Fasilitas kamarnya bersih ber-AC, pendopo sangat luas untuk berkumpul 100 orang lebih, dan anak-anak puas berlarian di rumput taman yang asri.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'date' => 'Juli 2026'
            ],
            [
                'name' => 'Renata Pramesti',
                'role' => 'Creative Director / Photoshoot Client',
                'quote' => 'Pencahayaan alami di pendopo sangat menawan untuk syuting video dan photoshoot baju etnik. Pengelola sangat kooperatif dan daya listrik aman. Pasti akan kembali lagi untuk project selanjutnya!',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
                'date' => 'September 2026'
            ]
        ];
    }

    /**
     * Halaman Beranda
     */
    public function home()
    {
        $facilities = $this->getFacilities();
        $packages = array_slice($this->getPackages(), 0, 3);
        $gallery = array_slice($this->getGallery(), 0, 6);
        $testimonials = $this->getTestimonials();

        $values = [
            [
                'title' => 'Kayu Jati Otentik & Bersejarah',
                'desc' => 'Dibangun menggunakan material kayu jati tua pilihan dengan tumpang sari asli yang memancarkan aura sakral dan kemegahan Jawa klasik.',
                'icon' => 'fa-landmark'
            ],
            [
                'title' => 'Pendopo Luas & Teras Alami',
                'desc' => 'Desain semi-terbuka dengan sirkulasi udara pegunungan yang sejuk, menyatukan keindahan arsitektur dengan kenyamanan tropis.',
                'icon' => 'fa-campground'
            ],
            [
                'title' => 'Suasana Privat & Penuh Kedamaian',
                'desc' => 'Terletak di kawasan yang asri nan tenang, memberikan privasi penuh untuk Anda dan keluarga dalam merayakan momen terindah.',
                'icon' => 'fa-heart'
            ]
        ];

        $serviceCategories = [
            [
                'title' => 'Pernikahan & Acara Sakral',
                'desc' => 'Mewujudkan resepsi pernikahan tradisional maupun kontemporer yang elegan dengan latar pendopo megah.',
                'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80',
                'badge' => 'Wedding & Engagement'
            ],
            [
                'title' => 'Inap Keluarga & Komunitas',
                'desc' => 'Kenyamanan homestay bernuansa pedesaan dengan fasilitas lengkap untuk liburan keluarga atau arisan trah.',
                'image' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=800&q=80',
                'badge' => 'Gathering & Homestay'
            ],
            [
                'title' => 'Photoshoot & Creative Space',
                'desc' => 'Lokasi estetik dengan pencahayaan alami untuk foto prewedding, buku tahunan, shooting video, atau workshop.',
                'image' => asset('assets/joglo.jpg'),
                'badge' => 'Photoshoot & Studio'
            ]
        ];

        return view('pages.home', compact('facilities', 'packages', 'gallery', 'testimonials', 'values', 'serviceCategories'));
    }

    /**
     * Halaman Katalog Paket & Fasilitas
     */
    public function packages()
    {
        $packages = $this->getPackages();
        $facilities = $this->getFacilities();
        
        $addOns = [
            ['name' => 'Tambahan Kursi Futura + Cover', 'price' => 'Rp 15.000 / unit'],
            ['name' => 'Sound System Konser 5.000 Watt', 'price' => 'Rp 2.000.000 / hari'],
            ['name' => 'Genset Silent 40 KVA Full-Day', 'price' => 'Rp 2.500.000 / hari'],
            ['name' => 'Tenda Plafon Transparan / Sarnafil', 'price' => 'Mulai Rp 35.000 / m2'],
            ['name' => 'Extra Bed Kamar Inap', 'price' => 'Rp 150.000 / bed'],
            ['name' => 'Coffee Break Tradisional (Wedang Ronde/Bajigur)', 'price' => 'Rp 25.000 / porsi']
        ];

        return view('pages.packages', compact('packages', 'facilities', 'addOns'));
    }

    /**
     * Halaman Galeri Lengkap
     */
    public function gallery()
    {
        $gallery = $this->getGallery();
        $categories = [
            ['id' => 'all', 'label' => 'Semua Foto'],
            ['id' => 'pendopo', 'label' => 'Pendopo Utama'],
            ['id' => 'kamar', 'label' => 'Kamar & Penginapan'],
            ['id' => 'taman', 'label' => 'Taman & Outdoor'],
            ['id' => 'acara', 'label' => 'Momen Acara'],
        ];

        return view('pages.gallery', compact('gallery', 'categories'));
    }

    /**
     * Halaman Reservasi / Inquiry
     */
    public function booking(Request $request)
    {
        $packages = $this->getPackages();
        $selectedPackage = $request->query('paket', '');

        return view('pages.booking', compact('packages', 'selectedPackage'));
    }

    /**
     * Halaman Kontak & Lokasi
     */
    public function contact()
    {
        $faqs = [
            [
                'q' => 'Apakah bisa melakukan survei lokasi terlebih dahulu?',
                'a' => 'Sangat bisa! Kami menyambut kedatangan Anda untuk melihat langsung Rumah Joglo Omah Ayem. Silakan hubungi admin kami via WhatsApp minimal 1 hari sebelumnya agar kami dapat memastikan lokasi tidak sedang digunakan acara privat.'
            ],
            [
                'q' => 'Bagaimana sistem pembayaran dan penguncian tanggal acara?',
                'a' => 'Untuk mengamankan tanggal (blocking date), diperlukan Down Payment (DP) sebesar 30%. Pelunasan dapat dilakukan paling lambat H-14 sebelum hari pelaksanaan acara.'
            ],
            [
                'q' => 'Apakah diperbolehkan membawa vendor katering atau dekorasi dari luar?',
                'a' => 'Tentu saja! Kami memberikan kebebasan bagi Anda untuk memilih vendor rekanan sendiri (katering, dekorasi, dokumentasi, WO) tanpa pungutan biaya corkage yang memberatkan.'
            ],
            [
                'q' => 'Berapa batas jam acara maksimal di malam hari?',
                'a' => 'Untuk menghormati ketenangan lingkungan pedesaan sekitar, acara pesta dan penggunaan sound system keras di malam hari dibatasi maksimal hingga pukul 22.00 WIB.'
            ]
        ];

        return view('pages.contact', compact('faqs'));
    }
}

