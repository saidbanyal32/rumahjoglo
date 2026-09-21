@extends('layouts.app')

@section('title', 'Katalog Paket Sewa & Fasilitas - Rumah Joglo Omah Ayem')
@section('meta_description', 'Daftar paket sewa pendopo joglo pernikahan, intimate wedding, family gathering homestay, dan photoshoot dengan harga transparan dan fasilitas lengkap.')

@section('content')
<!-- Header Banner Halaman -->
<section class="relative bg-brand-dark text-white py-16 lg:py-24 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1920&q=80" 
             alt="Joglo Omah Ayem Lighting" 
             class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-xs uppercase tracking-widest font-bold text-brand-gold bg-brand-wood/60 px-4 py-1.5 rounded-full mb-4 border border-brand-gold/30">
            Penawaran Eksklusif & Transparan
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-bold text-brand-cream mb-4">
            Katalog Paket Sewa & Fasilitas
        </h1>
        <p class="max-w-2xl mx-auto text-brand-cream/80 text-sm sm:text-base">
            Pilihan paket fleksibel yang dirancang khusus untuk kenyamanan acara sakral pernikahan, kehangatan kumpul keluarga, maupun sesi fotografi profesional.
        </p>
    </div>
</section>

<!-- Grid Paket Sewa Utama -->
<section class="py-20 bg-brand-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
            @foreach($packages as $pkg)
            <div class="bg-white rounded-3xl overflow-hidden shadow-joglo border {{ $pkg['featured'] ? 'border-2 border-brand-amber' : 'border-brand-sand' }} flex flex-col justify-between transition-all duration-300 hover:shadow-joglo-lg">
                <!-- Header Card -->
                <div class="p-8 sm:p-10 border-b border-brand-sand/60 {{ $pkg['featured'] ? 'bg-brand-sand/30' : '' }}">
                    <div class="flex items-center justify-between gap-4 mb-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $pkg['featured'] ? 'bg-brand-amber text-brand-dark' : 'bg-brand-wood text-white' }}">
                            {{ $pkg['tag'] }}
                        </span>
                        <span class="text-xs font-semibold text-brand-muted flex items-center gap-1.5">
                            <i class="fa-regular fa-clock text-brand-amber"></i>
                            {{ $pkg['duration'] }}
                        </span>
                    </div>

                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-brand-dark mb-2">
                        {{ $pkg['name'] }}
                    </h2>
                    <p class="text-brand-muted text-sm mb-6 leading-relaxed">
                        {{ $pkg['subtitle'] }}
                    </p>

                    <div class="flex items-baseline gap-2">
                        <span class="text-xs text-brand-muted">Mulai dari</span>
                        <span class="text-3xl sm:text-4xl font-extrabold text-brand-wood">
                            {{ $pkg['price'] }}
                        </span>
                        <span class="text-xs text-brand-muted font-medium">/ acara</span>
                    </div>
                </div>

                <!-- Inclusions / Rincian Apa Saja yang Didapat -->
                <div class="p-8 sm:p-10 flex-grow flex flex-col justify-between bg-white">
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-widest text-brand-amber mb-4">
                            Fasilitas yang Termasuk:
                        </h3>
                        <ul class="space-y-3 mb-6 text-sm text-brand-charcoal">
                            @foreach($pkg['inclusions'] as $inc)
                            <li class="flex items-start gap-3">
                                <div class="w-5 h-5 rounded-full bg-brand-sage-light text-brand-sage flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fa-solid fa-check text-xs"></i>
                                </div>
                                <span class="leading-snug">{{ $inc }}</span>
                            </li>
                            @endforeach
                        </ul>

                        @if(!empty($pkg['note']))
                        <div class="p-3.5 rounded-xl bg-brand-sand/40 border border-brand-sand text-xs text-brand-wood-light flex items-start gap-2.5 mb-8">
                            <i class="fa-solid fa-circle-info text-brand-amber mt-0.5 shrink-0"></i>
                            <span>{{ $pkg['note'] }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Action CTA -->
                    <div class="pt-4 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('booking') }}?paket={{ urlencode($pkg['name']) }}" 
                           class="flex-1 py-3.5 px-6 rounded-xl font-bold text-sm text-center transition shadow-md {{ $pkg['featured'] ? 'bg-brand-wood hover:bg-brand-dark text-white' : 'bg-brand-sand/80 hover:bg-brand-wood hover:text-white text-brand-wood' }}">
                            Pilih & Cek Jadwal Paket Ini
                        </a>
                        <a href="https://wa.me/{{ $siteSettings['formatted_whatsapp'] ?? '6281234567890' }}?text=Halo%20Admin%2C%20saya%20tertarik%20dengan%20{{ urlencode($pkg['name']) }}" 
                           target="_blank" 
                           class="px-4 py-3.5 rounded-xl border border-emerald-600 text-emerald-700 hover:bg-emerald-50 text-center transition flex items-center justify-center text-lg"
                           title="Tanya CS via WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Fasilitas Bawaan & Sarana Lengkap -->
<section class="py-16 bg-brand-sand/40 border-y border-brand-sand">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs uppercase font-bold tracking-widest text-brand-amber">Standar Kenyamanan</span>
            <h2 class="font-serif text-3xl font-bold text-brand-dark mt-1 mb-3">
                Fasilitas Unggulan di Rumah Joglo Omah Ayem
            </h2>
            <p class="text-brand-muted text-sm">
                Seluruh fasilitas dirawat secara berkala untuk menjamin higienitas, estetika, dan kelancaran acara Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($facilities as $facility)
            <div class="bg-white p-6 rounded-2xl border border-brand-sand shadow-sm flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand-sand/50 text-brand-wood flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid {{ $facility['icon'] }} text-brand-amber"></i>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-base text-brand-dark mb-1">
                        {{ $facility['title'] }}
                    </h3>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        {{ $facility['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Add-On Tambahan Opsional -->
<section class="py-20 bg-brand-cream">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs uppercase font-bold tracking-widest text-brand-amber">Penyesuaian Kebutuhan</span>
            <h2 class="font-serif text-3xl font-bold text-brand-dark mt-1 mb-3">
                Layanan Tambahan (Add-Ons)
            </h2>
            <p class="text-brand-muted text-sm">
                Perlu perlengkapan ekstra? Kami menyediakan opsi tambahan yang dapat dikombinasikan dengan paket utama Anda.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-brand-sand overflow-hidden shadow-joglo">
            <div class="divide-y divide-brand-sand/60">
                @foreach($addOns as $addon)
                <div class="p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-brand-sand/20 transition">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-plus text-brand-amber text-lg"></i>
                        <span class="font-semibold text-sm sm:text-base text-brand-dark">{{ $addon['name'] }}</span>
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-brand-wood text-sm sm:text-base">{{ $addon['price'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Ketentuan Ringkas -->
        <div class="mt-8 p-6 rounded-2xl bg-brand-sand/30 border border-brand-sand text-xs text-brand-muted leading-relaxed">
            <h4 class="font-bold text-brand-dark text-sm mb-2 flex items-center gap-2">
                <i class="fa-solid fa-scroll text-brand-amber"></i> Catatan & Ketentuan Reservasi:
            </h4>
            <ul class="list-disc list-inside space-y-1">
                <li>Harga di atas belum termasuk biaya konsumsi katering & dekorasi pelaminan (tersedia rekomendasi vendor rekanan terbaik).</li>
                <li>Uang muka (DP) minimal 30% untuk mengikat tanggal acara pada kalender reservasi.</li>
                <li>Jadwal loading dekorasi dibuka H-1 mulai pukul 18.00 WIB (menyesuaikan agenda venue).</li>
            </ul>
        </div>
    </div>
</section>
@endsection

