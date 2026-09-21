<footer class="bg-brand-dark text-brand-cream/80 pt-16 pb-8 border-t-4 border-brand-amber">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-brand-wood-light/40">
            <!-- Kolom 1: Profil Brand -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-brand-amber text-brand-dark flex items-center justify-center font-bold">
                        <i class="fa-solid fa-place-of-worship text-lg"></i>
                    </div>
                    <div>
                        <span class="block font-display text-xl font-bold tracking-wide text-white">OMAH AYEM</span>
                        <span class="block text-xs uppercase tracking-widest text-brand-gold">Rumah Joglo Tradisional</span>
                    </div>
                </div>
                <p class="text-sm text-brand-cream/70 leading-relaxed">
                    Persewaan pendopo joglo otentik kayu jati Jawa klasik. Menghadirkan kehangatan tradisi, kenyamanan modern, serta ketenangan alam untuk setiap perayaan sakral dan kebersamaan keluarga Anda.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <a href="{{ $siteSettings['social_instagram'] ?? 'https://instagram.com' }}" target="_blank" rel="noopener noreferrer" 
                       class="w-9 h-9 rounded-full bg-brand-wood text-white hover:bg-brand-amber hover:text-brand-dark flex items-center justify-center transition" title="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="{{ $siteSettings['social_tiktok'] ?? 'https://tiktok.com' }}" target="_blank" rel="noopener noreferrer" 
                       class="w-9 h-9 rounded-full bg-brand-wood text-white hover:bg-brand-amber hover:text-brand-dark flex items-center justify-center transition" title="TikTok">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                    <a href="{{ $siteSettings['social_youtube'] ?? 'https://youtube.com' }}" target="_blank" rel="noopener noreferrer" 
                       class="w-9 h-9 rounded-full bg-brand-wood text-white hover:bg-brand-amber hover:text-brand-dark flex items-center justify-center transition" title="YouTube">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="{{ $siteSettings['social_facebook'] ?? 'https://facebook.com' }}" target="_blank" rel="noopener noreferrer" 
                       class="w-9 h-9 rounded-full bg-brand-wood text-white hover:bg-brand-amber hover:text-brand-dark flex items-center justify-center transition" title="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </div>
            </div>

            <!-- Kolom 2: Navigasi Cepat -->
            <div class="space-y-4">
                <h4 class="font-display text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-amber"></span>
                    Tautan Cepat
                </h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-brand-gold transition flex items-center gap-2">
                            <i class="fa-solid fa-angle-right text-xs text-brand-amber"></i> Beranda Utama
                        </a>
                    </li>
                    <!-- <li>
                        <a href="{{ route('packages') }}" class="hover:text-brand-gold transition flex items-center gap-2">
                            <i class="fa-solid fa-angle-right text-xs text-brand-amber"></i> Pilihan Paket & Harga
                        </a>
                    </li> -->
                    <li>
                        <a href="{{ route('gallery') }}" class="hover:text-brand-gold transition flex items-center gap-2">
                            <i class="fa-solid fa-angle-right text-xs text-brand-amber"></i> Galeri & Suasana
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('booking') }}" class="hover:text-brand-gold transition flex items-center gap-2">
                            <i class="fa-solid fa-angle-right text-xs text-brand-amber"></i> Form Cek Jadwal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="hover:text-brand-gold transition flex items-center gap-2">
                            <i class="fa-solid fa-angle-right text-xs text-brand-amber"></i> Kontak & Peta Lokasi
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kolom 3: Layanan & Acara -->
            <div class="space-y-4">
                <h4 class="font-display text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-amber"></span>
                    Peruntukan Venue
                </h4>
                <ul class="space-y-2.5 text-sm text-brand-cream/80">
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-xs text-brand-gold"></i> Pernikahan Sakral & Resepsi
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-xs text-brand-gold"></i> Lamaran & Akad Nikah Intim
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-xs text-brand-gold"></i> Homestay & Family Gathering
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-xs text-brand-gold"></i> Photoshoot & Syuting Video
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-xs text-brand-gold"></i> Reuni, Arisan Trah & Workshop
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Alamat & Kontak -->
            <div class="space-y-4">
                <h4 class="font-display text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-amber"></span>
                    Informasi & Lokasi
                </h4>
                <ul class="space-y-3 text-sm text-brand-cream/80">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot text-brand-amber mt-1 shrink-0"></i>
                        <span>{{ $siteSettings['address'] ?? 'Jl. Anggajaya II No. 12, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283' }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp text-brand-amber shrink-0 text-base"></i>
                        <a href="https://wa.me/{{ $siteSettings['formatted_whatsapp'] ?? '6281234567890' }}" target="_blank" class="hover:text-brand-gold transition">
                            +{{ $siteSettings['contact_whatsapp'] ?? '6281234567890' }} (CS Reservasi)
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-clock text-brand-amber shrink-0 text-sm"></i>
                        <span>Jam Survei: 08.00 – 17.00 WIB (Dengan Janji)</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-brand-cream/60">
            <p>&copy; {{ date('Y') }} Rumah Joglo Omah Ayem. Seluruh hak cipta dilindungi.</p>
            <p class="flex items-center gap-2">
                <span>Didesain dengan nuansa tradisional Jawa & modernitas kontemporer</span>
            </p>
        </div>
    </div>
</footer>

