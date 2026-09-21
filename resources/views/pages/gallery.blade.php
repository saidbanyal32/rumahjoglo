@extends('layouts.app')

@section('title', 'Galeri Foto & Dokumentasi Suasana - Rumah Joglo Omah Ayem')
@section('meta_description', 'Lihat keindahan arsitektur pendopo kayu jati, kamar penginapan ber-AC, taman asri outdoor, serta dekorasi acara pernikahan di Rumah Joglo Omah Ayem.')

@section('content')
<!-- Header Banner Halaman -->
<section class="relative bg-brand-dark text-white py-16 lg:py-24 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="{{ asset('assets/joglo.jpg') }}" 
             alt="Joglo Gallery" 
             class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-xs uppercase tracking-widest font-bold text-brand-gold bg-brand-wood/60 px-4 py-1.5 rounded-full mb-4 border border-brand-gold/30">
            Dokumentasi & Estetika Tempat
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-bold text-brand-cream mb-4">
            Galeri Suasana Omah Ayem
        </h1>
        <p class="max-w-2xl mx-auto text-brand-cream/80 text-sm sm:text-base">
            Jelajahi setiap detail kemegahan arsitektur tumpang sari kayu jati kuno, keteduhan taman, dan kenyamanan fasilitas kami.
        </p>
    </div>
</section>

<!-- Konten Galeri dengan Filter Alpine.js & Lightbox Modal -->
<section class="py-16 sm:py-20 bg-brand-cream" 
         x-data="{ 
             activeCategory: 'all',
             activeModal: false,
             modalImg: '',
             modalTitle: '',
             modalDesc: '',
             openModal(img, title, desc) {
                 this.modalImg = img;
                 this.modalTitle = title;
                 this.modalDesc = desc;
                 this.activeModal = true;
             }
         }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Bar Kategori -->
        <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-12">
            @foreach($categories as $cat)
            <button type="button" 
                    @click="activeCategory = '{{ $cat['id'] }}'"
                    :class="activeCategory === '{{ $cat['id'] }}' 
                            ? 'bg-brand-wood text-white shadow-md border-brand-wood' 
                            : 'bg-white text-brand-charcoal hover:bg-brand-sand border-brand-sand'"
                    class="px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold border transition-all duration-200">
                {{ $cat['label'] }}
            </button>
            @endforeach
        </div>

        <!-- Grid Foto Galeri -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($gallery as $item)
            <div x-show="activeCategory === 'all' || activeCategory === '{{ $item['category'] }}'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 @click="openModal('{{ $item['image'] }}', '{{ $item['title'] }}', '{{ $item['desc'] }}')"
                 class="group relative rounded-2xl overflow-hidden bg-white shadow-joglo border border-brand-sand cursor-pointer aspect-[4/3] transform transition duration-300 hover:-translate-y-1 hover:shadow-joglo-lg">
                
                <img src="{{ $item['image'] }}" 
                     alt="{{ $item['title'] }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">
                
                <!-- Overlay Gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/85 via-brand-dark/30 to-transparent opacity-80 group-hover:opacity-95 transition duration-300"></div>
                
                <!-- Zoom Icon Badge -->
                <div class="absolute top-4 right-4 w-9 h-9 rounded-full bg-brand-dark/70 text-brand-gold flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <i class="fa-solid fa-magnifying-glass-plus text-sm"></i>
                </div>

                <!-- Text Overlay -->
                <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                    <span class="inline-block px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-brand-amber text-brand-dark mb-1.5">
                        {{ $item['category_label'] }}
                    </span>
                    <h3 class="font-serif text-lg font-bold leading-tight">
                        {{ $item['title'] }}
                    </h3>
                    <p class="text-xs text-brand-cream/80 mt-1 line-clamp-2">
                        {{ $item['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Banner Info Bawah -->
        <div class="mt-16 text-center bg-brand-sand/40 border border-brand-sand rounded-2xl p-8 max-w-3xl mx-auto">
            <h3 class="font-serif text-xl font-bold text-brand-dark mb-2">
                Ingin Melihat Langsung Suasana Joglo Omah Ayem?
            </h3>
            <p class="text-brand-muted text-sm mb-6">
                Kami dengan senang hati menemani Anda untuk sesi survei lokasi dan konsultasi tata letak acara Anda.
            </p>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20jadwal%20survei%20lokasi%20Joglo%20Omah%20Ayem" 
               target="_blank" 
               class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm transition shadow-md">
                <i class="fa-brands fa-whatsapp text-lg"></i>
                <span>Jadwalkan Survei via WhatsApp</span>
            </a>
        </div>
    </div>

    <!-- Lightbox Modal Preview -->
    <div x-show="activeModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="activeModal = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         x-cloak>
        <div @click.away="activeModal = false" 
             class="bg-brand-dark text-white rounded-2xl overflow-hidden max-w-4xl w-full shadow-2xl border border-white/20 relative">
            <button @click="activeModal = false" 
                    class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-black/60 text-white hover:bg-brand-amber hover:text-brand-dark flex items-center justify-center transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            
            <div class="max-h-[75vh] overflow-hidden bg-black flex items-center justify-center">
                <img :src="modalImg" :alt="modalTitle" class="w-full h-auto max-h-[75vh] object-contain">
            </div>

            <div class="p-6 bg-brand-dark border-t border-white/10">
                <h4 class="font-serif text-xl font-bold text-brand-gold" x-text="modalTitle"></h4>
                <p class="text-sm text-brand-cream/80 mt-1" x-text="modalDesc"></p>
            </div>
        </div>
    </div>
</section>
@endsection

