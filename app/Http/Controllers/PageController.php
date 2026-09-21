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
     * Data Paket Sewa
     */
    private function getPackages()
    {
        return config('packages.items', []);
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
     * Halaman Reservasi / Inquiry dengan kalkulasi DP & Rekening Transfer
     */
    public function booking(Request $request)
    {
        $packages = $this->getPackages();
        $selectedPackage = $request->query('paket', '');
        $dpPercentage = (int) \App\Models\Setting::get('dp_percentage', 30);

        return view('pages.booking', compact('packages', 'selectedPackage', 'dpPercentage'));
    }

    /**
     * Endpoint API: Cek ketersediaan tanggal acara (Pencegahan Double Booking)
     */
    public function checkDate(Request $request)
    {
        $date = $request->query('date');
        if (!$date) {
            return response()->json(['available' => false, 'message' => 'Tanggal belum dipilih.'], 400);
        }

        $result = \App\Services\BookingService::checkDate($date);
        return response()->json($result);
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

    /**
     * Simpan pengajuan reservasi baru ke database, hitung DP, kirim WA otomatis, & arahkan ke instruksi transfer
     */
    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:150'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'package_name' => ['required', 'string', 'max:255'],
            'guest_count' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'event_date.required' => 'Tanggal rencana acara wajib dipilih.',
            'event_date.after_or_equal' => 'Tanggal acara tidak boleh di masa lampau.',
            'package_name.required' => 'Pilihan paket sewa wajib dipilih.',
        ]);

        // 1. Validasi Double Booking: Pastikan tanggal belum dikunci pihak lain
        if (\App\Models\Reservation::isDateBooked($validated['event_date'])) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, tanggal yang Anda pilih telah dipesan dan terkunci untuk acara lain. Silakan pilih tanggal alternatif.',
                ], 422);
            }

            return back()->withErrors([
                'event_date' => 'Maaf, tanggal tersebut telah dipesan untuk acara lain. Silakan pilih tanggal alternatif.'
            ])->withInput();
        }

        // 2. Hitung Nominal Paket & Uang Muka (DP)
        $pkg = \App\Services\BookingService::findPackage($validated['package_name']);
        $packagePrice = $pkg ? ($pkg['raw_price'] ?? 5000000) : 5000000;
        $calc = \App\Services\BookingService::calculateDp($packagePrice);

        // 3. Generate Kode Booking & Simpan ke Database
        $bookingCode = \App\Services\BookingService::generateBookingCode();

        $reservation = \App\Models\Reservation::create([
            'booking_code' => $bookingCode,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'event_date' => $validated['event_date'],
            'package_name' => $validated['package_name'],
            'package_price' => $calc['package_price'],
            'dp_percentage' => $calc['dp_percentage'],
            'dp_amount' => $calc['dp_amount'],
            'remaining_amount' => $calc['remaining_amount'],
            'guest_count' => $validated['guest_count'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending_payment',
            'payment_status' => 'unpaid',
        ]);

        // 4. Otomasi Pengiriman WhatsApp (Trigger 1: Pemesan & Trigger 3: Admin)
        \App\Services\WhatsAppService::sendPendingBookingNotice($reservation);
        \App\Services\WhatsAppService::sendAdminNewBookingAlert($reservation);

        $instructionUrl = route('booking.instruction', ['booking_code' => $reservation->booking_code]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan reservasi berhasil dicatat. Silakan lakukan pembayaran Uang Muka (DP).',
                'booking_code' => $reservation->booking_code,
                'instruction_url' => $instructionUrl,
                'whatsapp_url' => $reservation->customer_confirm_whats_app_url,
            ]);
        }

        return redirect()->route('booking.instruction', ['booking_code' => $reservation->booking_code])
            ->with('success', 'Reservasi Anda telah tercatat. Silakan lakukan transfer Uang Muka (DP) ke rekening resmi kami untuk mengunci tanggal acara.');
    }

    /**
     * Halaman Rincian Booking & Instruksi Transfer Rekening Resmi
     */
    public function bookingInstruction($booking_code)
    {
        $reservation = \App\Models\Reservation::where('booking_code', $booking_code)->firstOrFail();

        $banks = [
            [
                'name' => \App\Models\Setting::get('bank_name_1', 'BCA'),
                'number' => \App\Models\Setting::get('bank_account_number_1', '8465-123-456'),
                'holder' => \App\Models\Setting::get('bank_account_holder_1', 'Rumah Joglo Omah Ayem'),
                'logo' => 'BCA',
                'color' => 'from-blue-600 to-blue-800'
            ],
            [
                'name' => \App\Models\Setting::get('bank_name_2', 'Bank Mandiri'),
                'number' => \App\Models\Setting::get('bank_account_number_2', '137-00-1234567-8'),
                'holder' => \App\Models\Setting::get('bank_account_holder_2', 'Rumah Joglo Omah Ayem'),
                'logo' => 'MANDIRI',
                'color' => 'from-amber-600 to-amber-800'
            ]
        ];

        $instructions = \App\Models\Setting::get('payment_instructions', 'Silakan lakukan transfer Uang Muka (DP) ke rekening resmi kami di atas dan sertakan Kode Booking pada berita transfer.');

        return view('pages.booking-instruction', compact('reservation', 'banks', 'instructions'));
    }

    /**
     * Upload Bukti Transfer oleh Pemesan
     */
    public function uploadPaymentProof(Request $request, $booking_code)
    {
        $reservation = \App\Models\Reservation::where('booking_code', $booking_code)->firstOrFail();

        $request->validate([
            'payment_proof' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'payment_method' => ['nullable', 'string', 'max:100'],
        ], [
            'payment_proof.required' => 'Berkas bukti transfer wajib dipilih.',
            'payment_proof.image' => 'Berkas harus berupa gambar.',
            'payment_proof.max' => 'Ukuran berkas maksimal 5MB.',
        ]);

        $path = $request->file('payment_proof')->store('proofs', 'public');

        $reservation->update([
            'payment_proof' => $path,
            'payment_method' => $request->input('payment_method', 'Transfer Bank'),
        ]);

        return redirect()->back()
            ->with('success', 'Bukti transfer berhasil diunggah! Pengelola kami akan memverifikasi mutasi dan mengonfirmasi jadwal acara Anda.');
    }
}


