@extends('layouts.app')

@section('title', 'Rumah Joglo Omah Ayem - Persewaan Venue Pernikahan & Gathering Jogja')
@section('meta_description', 'Persewaan Rumah Joglo kayu jati otentik di Depok, Jawa Barat. Venue berkelas untuk pernikahan tradisional Jawa, homestay keluarga, gathering, dan photoshoot.')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[85vh] lg:min-h-[90vh] flex items-center justify-center overflow-hidden bg-brand-dark text-white">
    <!-- Background Image with Warm Vignette Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/joglo.jpg') }}" 
             alt="Pendopo Kayu Jati Omah Ayem" 
             class="w-full h-full object-cover object-center transform scale-105 filter brightness-75 contrast-105">
        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-brand-dark/60 to-black/40"></div>
        <div class="absolute inset-0 bg-brand-wood/20 mix-blend-multiply"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <!-- Tag / Eyebrow -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-sand/15 backdrop-blur-md border border-brand-gold/40 text-brand-gold text-xs sm:text-sm font-semibold tracking-widest uppercase mb-6 shadow-sm">
            <i class="fa-solid fa-gem text-xs"></i>
            <span>Venue Klasik Bernuansa Tradisi Jawa Otentik</span>
        </div>

        <!-- Main Headline -->
        <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-brand-cream leading-tight sm:leading-tight mb-6">
            Kehangatan Budaya, <br class="hidden sm:inline">
            <span class="text-brand-gold italic font-normal">Kenyamanan Istimewa</span> untuk Momen Berharga
        </h1>

        <!-- Subheadline -->
        <p class="max-w-3xl mx-auto text-base sm:text-lg lg:text-xl text-brand-cream/85 font-light leading-relaxed mb-10">
            Rayakan pernikahan sakral, kehangatan kumpul keluarga, dan acara istimewa Anda di pendopo joglo kayu jati pilihan dengan lanskap taman asri di Depok.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('packages') }}" 
               class="w-full sm:w-auto px-8 py-4 rounded-full bg-brand-amber text-brand-dark font-bold text-base hover:bg-brand-gold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                <i class="fa-solid fa-list-check"></i>
                <span>Lihat Paket & Fasilitas</span>
            </a>
            <a href="{{ route('booking') }}" 
               class="w-full sm:w-auto px-8 py-4 rounded-full bg-white/10 hover:bg-white/20 text-white font-semibold text-base border border-white/30 backdrop-blur-sm transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fa-regular fa-calendar-check text-brand-gold"></i>
                <span>Cek Ketersediaan Jadwal</span>
            </a>
        </div>

        <!-- Quick Trust Badges -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-16 pt-8 border-t border-white/15 text-xs sm:text-sm text-brand-cream/80">
            <div class="flex items-center justify-center gap-2">
                <i class="fa-solid fa-tree text-brand-gold"></i>
                <span>100% Kayu Jati Asli</span>
            </div>
            <div class="flex items-center justify-center gap-2">
                <i class="fa-solid fa-users text-brand-gold"></i>
                <span>Kapasitas s.d 400 Tamu</span>
            </div>
            <div class="flex items-center justify-center gap-2">
                <i class="fa-solid fa-square-parking text-brand-gold"></i>
                <span>Parkir Luas</span>
            </div>
            <div class="flex items-center justify-center gap-2">
                <i class="fa-solid fa-shield-heart text-brand-gold"></i>
                <span>Eksklusif & Privat</span>
            </div>
        </div>
    </div>
</section>

<!-- Highlight Values Section -->
<section class="py-20 bg-brand-cream relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase font-bold tracking-widest text-brand-amber">Kenapa Omah Ayem</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-dark mt-2 mb-4">
                Kemegahan Arsitektur yang Menentramkan Hati
            </h2>
            <div class="w-20 h-1 bg-brand-amber mx-auto rounded-full mb-4"></div>
            <p class="text-brand-muted text-base leading-relaxed">
                Di Omah Ayem, setiap sudut dirancang untuk menghadirkan atmosfer Jawa yang sakral, teduh, dan berkelas tanpa melupakan kenyamanan fasilitas modern.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($values as $value)
            <div class="bg-white p-8 rounded-2xl shadow-joglo border border-brand-sand/60 hover:shadow-joglo-lg hover:-translate-y-1 transition duration-300">
                <div class="w-14 h-14 rounded-2xl bg-brand-sand/60 text-brand-wood flex items-center justify-center text-2xl mb-6">
                    <i class="fa-solid {{ $value['icon'] }} text-brand-amber"></i>
                </div>
                <h3 class="font-serif text-xl font-bold text-brand-dark mb-3">
                    {{ $value['title'] }}
                </h3>
                <p class="text-brand-muted text-sm leading-relaxed">
                    {{ $value['desc'] }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Kategori Penggunaan / Layanan -->
<section class="py-20 bg-brand-sand/30 border-y border-brand-sand">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs uppercase font-bold tracking-widest text-brand-amber">Peruntukan Tempat</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-dark mt-1">
                    Cocok untuk Segala Momen Berkesan
                </h2>
            </div>
            <a href="{{ route('packages') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-brand-wood font-bold hover:text-brand-amber transition text-sm">
                Lihat Semua Paket Lengkap <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($serviceCategories as $item)
            <div class="group relative rounded-2xl overflow-hidden shadow-joglo bg-white border border-brand-sand/70 flex flex-col">
                <div class="relative h-60 overflow-hidden">
                    <img src="{{ $item['image'] }}" 
                         alt="{{ $item['title'] }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-brand-dark/80 backdrop-blur-sm text-brand-gold text-xs font-semibold uppercase tracking-wider">
                        {{ $item['badge'] }}
                    </span>
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-serif text-xl font-bold text-brand-dark mb-2 group-hover:text-brand-wood transition">
                            {{ $item['title'] }}
                        </h3>
                        <p class="text-brand-muted text-sm leading-relaxed mb-6">
                            {{ $item['desc'] }}
                        </p>
                    </div>
                    <a href="{{ route('booking') }}?paket={{ urlencode($item['title']) }}" 
                       class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl border border-brand-wood text-brand-wood hover:bg-brand-wood hover:text-white font-semibold text-sm transition">
                        <span>Konsultasikan Acara Ini</span>
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Fasilitas Utama -->
<section class="py-20 bg-brand-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase font-bold tracking-widest text-brand-amber">Fasilitas Komprehensif</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-dark mt-2 mb-4">
                Kenyamanan Penuh untuk Tuan Rumah & Tamu
            </h2>
            <div class="w-20 h-1 bg-brand-amber mx-auto rounded-full mb-4"></div>
            <p class="text-brand-muted text-base">
                Kami menyediakan sarana lengkap yang terawat rapi demi kelancaran hari istimewa Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($facilities as $facility)
            <div class="p-6 rounded-2xl bg-white border border-brand-sand shadow-sm hover:border-brand-amber/60 hover:shadow-joglo transition duration-300 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand-sand/60 text-brand-amber flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid {{ $facility['icon'] }}"></i>
                </div>
                <div>
                    <span class="inline-block text-[11px] font-bold text-brand-wood bg-brand-sand/40 px-2 py-0.5 rounded mb-1">
                        {{ $facility['highlight'] }}
                    </span>
                    <h3 class="font-serif text-base font-bold text-brand-dark mb-1">
                        {{ $facility['title'] }}
                    </h3>
                    <p class="text-brand-muted text-xs leading-relaxed">
                        {{ $facility['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Highlight Paket Pilihan -->
<!-- <section class="py-20 bg-brand-dark text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase font-bold tracking-widest text-brand-gold">Pilihan Paket Sewa</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-cream mt-2 mb-4">
                Paket Fleksibel Sesuai Kebutuhan Anda
            </h2>
            <div class="w-20 h-1 bg-brand-amber mx-auto rounded-full mb-4"></div>
            <p class="text-brand-cream/75 text-sm sm:text-base">
                Mulai dari photoshoot sederhana hingga pesta pernikahan berskala besar dengan rincian biaya yang transparan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
            @foreach($packages as $pkg)
            <div class="rounded-3xl p-8 flex flex-col justify-between transition duration-300 {{ $pkg['featured'] ? 'bg-gradient-to-b from-brand-wood to-brand-wood-light border-2 border-brand-amber shadow-2xl relative' : 'bg-white/5 border border-white/10 hover:border-white/25' }}">
                @if($pkg['featured'])
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 px-4 py-1 rounded-full bg-brand-amber text-brand-dark text-xs font-bold uppercase tracking-wider shadow-md">
                    {{ $pkg['tag'] }}
                </div>
                @endif

                <div>
                    <span class="text-xs uppercase tracking-wider font-semibold text-brand-gold">
                        {{ $pkg['duration'] }}
                    </span>
                    <h3 class="font-serif text-2xl font-bold text-white mt-1 mb-2">
                        {{ $pkg['name'] }}
                    </h3>
                    <p class="text-xs text-brand-cream/70 mb-6 leading-relaxed">
                        {{ $pkg['subtitle'] }}
                    </p>

                    <div class="mb-6 pb-6 border-b border-white/15">
                        <span class="text-xs text-brand-cream/60">Mulai dari</span>
                        <div class="text-3xl font-extrabold text-brand-gold mt-0.5">
                            {{ $pkg['price'] }}
                        </div>
                    </div>

                    <ul class="space-y-3 mb-8 text-xs sm:text-sm text-brand-cream/80">
                        @foreach(array_slice($pkg['inclusions'], 0, 5) as $inc)
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-circle-check text-brand-gold mt-1 shrink-0 text-xs"></i>
                            <span>{{ $inc }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <a href="{{ route('booking') }}?paket={{ urlencode($pkg['name']) }}" 
                       class="w-full py-3 px-6 rounded-full font-bold text-sm text-center block transition shadow-md {{ $pkg['featured'] ? 'bg-brand-amber text-brand-dark hover:bg-brand-gold' : 'bg-white/15 text-white hover:bg-white/25 border border-white/20' }}">
                        Pilih Paket Ini
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('packages') }}" class="inline-flex items-center gap-2 text-brand-gold hover:text-white font-semibold text-sm transition">
                <span>Lihat rincian semua paket & tabel perbandingan fasilitas</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section> -->

<!-- Galeri Foto Ringkas -->
<section class="py-20 bg-brand-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs uppercase font-bold tracking-widest text-brand-amber">Sudut Estetik</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-dark mt-1">
                    Galeri Suasana Omah Ayem
                </h2>
            </div>
            <a href="{{ route('gallery') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-brand-wood font-bold hover:text-brand-amber transition text-sm">
                Lihat Galeri Foto Lengkap <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($gallery as $photo)
            <div class="group relative rounded-2xl overflow-hidden shadow-md bg-brand-sand aspect-[4/3]">
                <img src="{{ $photo['image'] }}" 
                     alt="{{ $photo['title'] }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/80 via-brand-dark/20 to-transparent opacity-80 group-hover:opacity-95 transition duration-300"></div>
                <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                    <span class="text-[11px] uppercase tracking-wider font-semibold text-brand-gold">
                        {{ $photo['category_label'] }}
                    </span>
                    <h3 class="font-serif text-lg font-bold leading-snug">
                        {{ $photo['title'] }}
                    </h3>
                    <p class="text-xs text-brand-cream/80 line-clamp-2 mt-1 hidden sm:block">
                        {{ $photo['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimoni Pengunjung -->
<section class="py-20 bg-brand-sand/40 border-t border-brand-sand">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase font-bold tracking-widest text-brand-amber">Kesan & Pengalaman</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-dark mt-2 mb-4">
                Apa Kata Mereka yang Telah Berbagi Momen
            </h2>
            <div class="w-20 h-1 bg-brand-amber mx-auto rounded-full mb-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testi)
            <div class="bg-white p-8 rounded-2xl shadow-joglo border border-brand-sand flex flex-col justify-between">
                <div>
                    <!-- Rating Stars -->
                    <div class="flex items-center gap-1 text-amber-500 text-sm mb-4">
                        @for($i = 0; $i < $testi['rating']; $i++)
                        <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>
                    <p class="text-brand-charcoal text-sm italic leading-relaxed mb-6">
                        "{{ $testi['quote'] }}"
                    </p>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-brand-sand/60">
                    <img src="{{ $testi['avatar'] }}" 
                         alt="{{ $testi['name'] }}" 
                         class="w-11 h-11 rounded-full object-cover border-2 border-brand-amber/40">
                    <div>
                        <h4 class="font-bold text-sm text-brand-dark">{{ $testi['name'] }}</h4>
                        <p class="text-xs text-brand-muted">{{ $testi['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Bar Bawah -->
<section class="py-16 bg-brand-wood text-white relative overflow-hidden">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="font-serif text-3xl sm:text-4xl font-bold mb-4">
            Ingin Mengabadikan Momen Sakral di Rumah Joglo Omah Ayem?
        </h2>
        <p class="text-brand-cream/80 text-base max-w-2xl mx-auto mb-8">
            Diskusikan rencana pernikahan, jadwal gathering keluarga, atau jadwal survei langsung bersama tim kami.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('booking') }}" 
               class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-brand-amber text-brand-dark font-bold hover:bg-brand-gold shadow-lg transition">
                Isi Formulir Reservasi
            </a>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Joglo%20Omah%20Ayem%2C%20saya%20ingin%20jadwalkan%20survei%20lokasi" 
               target="_blank" 
               class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-emerald-700 hover:bg-emerald-600 text-white font-bold transition flex items-center justify-center gap-2">
                <i class="fa-brands fa-whatsapp text-lg"></i>
                <span>Jadwalkan Survei Lokasi</span>
            </a>
        </div>
    </div>
</section>
@endsection

