@extends('layouts.app')

@section('title', 'Kontak & Peta Lokasi - Rumah Joglo Omah Ayem')
@section('meta_description', 'Alamat lengkap, rute akses kendaraan, kontak pengelola, dan peta Google Maps Rumah Joglo Omah Ayem di Di Depok, Jawa Barat.')

@section('content')
<!-- Header Banner Halaman -->
<section class="relative bg-brand-dark text-white py-14 lg:py-20 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&w=1920&q=80" 
             alt="Contact Banner" 
             class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-xs uppercase tracking-widest font-bold text-brand-gold bg-brand-wood/60 px-4 py-1.5 rounded-full mb-3 border border-brand-gold/30">
            Akses & Komunikasi
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-bold text-brand-cream mb-3">
            Kontak & Lokasi Kami
        </h1>
        <p class="max-w-xl mx-auto text-brand-cream/80 text-sm sm:text-base">
            Temukan lokasi asri Rumah Joglo Omah Ayem di Depok dan hubungi tim kami untuk jadwal survei tempat.
        </p>
    </div>
</section>

<!-- Konten Utama: Kontak & Peta -->
<section class="py-16 bg-brand-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            <!-- Kartu Info Kontak -->
            <div class="bg-white p-8 rounded-3xl shadow-joglo border border-brand-sand space-y-6">
                <h2 class="font-serif text-2xl font-bold text-brand-dark border-b border-brand-sand/70 pb-4">
                    Pusat Informasi
                </h2>

                <div class="space-y-5">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl bg-brand-sand/60 text-brand-wood flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-map-location-dot text-brand-amber"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-brand-muted">Alamat Lengkap</h3>
                            <p class="text-sm font-semibold text-brand-dark mt-0.5">
                                Jl. Taman Duta Timur, Bakti Jaya, Kec. Sukmajaya, Kota Depok, Jawa Barat 16416
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-brand-muted">WhatsApp Reservasi</h3>
                            <a href="https://wa.me/6281234567890" target="_blank" class="text-sm font-bold text-emerald-700 hover:underline mt-0.5 block">
                                +62 812-3456-7890
                            </a>
                            <p class="text-xs text-brand-muted">Respons cepat: 08.00 - 21.00 WIB</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl bg-brand-sand/60 text-brand-wood flex items-center justify-center text-lg shrink-0">
                            <i class="fa-regular fa-envelope text-brand-amber"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-brand-muted">Email Korespondensi</h3>
                            <a href="mailto:info@jogloomahayem.id" class="text-sm font-semibold text-brand-dark hover:text-brand-amber mt-0.5 block">
                                info@jogloomahayem.id
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl bg-brand-sand/60 text-brand-wood flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-car-side text-brand-amber"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-brand-muted">Akses Kendaraan</h3>
                            <p class="text-xs text-brand-muted mt-0.5 leading-relaxed">
                                Akses aspal halus dua arah, dapat dilalui oleh bus pariwisata medium, mobil keluarga, dan elf.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-brand-sand/70">
                    <a href="https://maps.google.com/?q=Sleman+Yogyakarta" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="w-full py-3 px-4 rounded-xl bg-brand-wood hover:bg-brand-dark text-white font-semibold text-sm transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-diamond-turn-right text-brand-gold"></i>
                        <span>Buka Penunjuk Arah (Google Maps)</span>
                    </a>
                </div>
            </div>

            <!-- Peta Lokasi Google Maps Embed -->
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-joglo border border-brand-sand overflow-hidden flex flex-col">
                <div class="p-5 bg-brand-sand/30 border-b border-brand-sand flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm font-bold text-brand-dark">
                        <i class="fa-solid fa-map text-brand-amber"></i>
                        <span>Peta Interaktif Lokasi Venue</span>
                    </div>
                    <span class="text-xs text-brand-muted">Kawasan Sejuk Ngaglik, Sleman</span>
                </div>
                
                <div class="relative w-full flex-grow min-h-[360px] lg:min-h-[420px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.535073400517!2d110.3789476!3d-7.7329599!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5913e61c3383%3A0x2a11b66ab4c57700!2sJl.+Palagan+Tentara+Pelajar%2C+Kabupaten+Sleman%2C+Daerah+Istimewa+Yogyakarta!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" 
                        class="w-full h-full border-0 absolute inset-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Peta Lokasi Rumah Joglo Omah Ayem">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- Panduan Rute & Patokan Arah -->
        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-joglo border border-brand-sand mb-16">
            <h3 class="font-serif text-2xl font-bold text-brand-dark mb-6 flex items-center gap-3">
                <i class="fa-solid fa-route text-brand-amber"></i>
                <span>Panduan Rute Menuju Lokasi</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                <div class="p-5 rounded-2xl bg-brand-sand/30 border border-brand-sand">
                    <span class="font-bold text-brand-wood block mb-1">Dari Bandara YIA / Stasiun Tugu</span>
                    <p class="text-brand-muted text-xs leading-relaxed">
                        Menuju ke arah utara melalui Ring Road Utara, ambil belokan ke Jl. Palagan Tentara Pelajar. Lurus ke utara sekitar 15 menit hingga KM 9.
                    </p>
                </div>
                <div class="p-5 rounded-2xl bg-brand-sand/30 border border-brand-sand">
                    <span class="font-bold text-brand-wood block mb-1">Dari Pusat Kota / Malioboro</span>
                    <p class="text-brand-muted text-xs leading-relaxed">
                        Menempuh jarak kurang lebih 25 menit. Melewati Jl. Magelang atau Jl. Monjali lalu terhubung ke arah Palagan.
                    </p>
                </div>
                <div class="p-5 rounded-2xl bg-brand-sand/30 border border-brand-sand">
                    <span class="font-bold text-brand-wood block mb-1">Patokan Utama</span>
                    <p class="text-brand-muted text-xs leading-relaxed">
                        Dekat dengan SPBU Palagan Km. 9. Masuk ke arah gang beraspal 100 meter ke timur, terdapat plang nama kayu ukir "Rumah Joglo Omah Ayem".
                    </p>
                </div>
            </div>
        </div>

        <!-- Pertanyaan yang Sering Diajukan (FAQ) -->
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <span class="text-xs uppercase font-bold tracking-widest text-brand-amber">Bantuan Informasi</span>
                <h3 class="font-serif text-3xl font-bold text-brand-dark mt-1">
                    Pertanyaan Seputar Kunjungan & Sewa
                </h3>
            </div>

            <div class="space-y-4" x-data="{ openFaq: 0 }">
                @foreach($faqs as $index => $faq)
                <div class="bg-white rounded-2xl border border-brand-sand overflow-hidden shadow-sm">
                    <button type="button" 
                            @click="openFaq = (openFaq === {{ $index }} ? null : {{ $index }})" 
                            class="w-full p-6 text-left font-bold text-base text-brand-dark flex items-center justify-between gap-4 hover:bg-brand-sand/20 transition">
                        <span>{{ $faq['q'] }}</span>
                        <i :class="openFaq === {{ $index }} ? 'fa-solid fa-chevron-up text-brand-amber' : 'fa-solid fa-chevron-down text-brand-muted'" class="text-sm shrink-0"></i>
                    </button>
                    <div x-show="openFaq === {{ $index }}" 
                         x-transition 
                         class="px-6 pb-6 text-sm text-brand-muted leading-relaxed border-t border-brand-sand/40 pt-4"
                         x-cloak>
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@endsection

