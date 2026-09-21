<nav x-data="{ mobileOpen: false, scrolled: false }"
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md py-3' : 'bg-brand-cream/90 backdrop-blur-sm py-5'"
     class="sticky top-0 z-40 transition-all duration-300 border-b border-brand-sand/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <!-- Brand / Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-brand-wood text-brand-gold flex items-center justify-center shadow-md group-hover:bg-brand-dark transition-colors duration-300">
                    <i class="fa-solid fa-place-of-worship text-lg sm:text-xl"></i>
                </div>
                <div>
                    <span class="block font-display text-lg sm:text-xl font-bold tracking-wide text-brand-dark group-hover:text-brand-wood transition-colors">
                        OMAH AYEM
                    </span>
                    <span class="block text-[10px] sm:text-xs tracking-widest uppercase font-medium text-brand-amber -mt-1">
                        Rumah Joglo Tradisional
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" 
                   class="text-sm font-semibold transition-colors duration-200 {{ request()->routeIs('home') ? 'text-brand-amber font-bold' : 'text-brand-charcoal hover:text-brand-amber' }}">
                   Beranda
                </a>
                <!-- <a href="{{ route('packages') }}" 
                   class="text-sm font-semibold transition-colors duration-200 {{ request()->routeIs('packages') ? 'text-brand-amber font-bold' : 'text-brand-charcoal hover:text-brand-amber' }}">
                   Paket & Fasilitas
                </a> -->
                <a href="{{ route('gallery') }}" 
                   class="text-sm font-semibold transition-colors duration-200 {{ request()->routeIs('gallery') ? 'text-brand-amber font-bold' : 'text-brand-charcoal hover:text-brand-amber' }}">
                   Galeri Foto
                </a>
                <a href="{{ route('contact') }}" 
                   class="text-sm font-semibold transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-brand-amber font-bold' : 'text-brand-charcoal hover:text-brand-amber' }}">
                   Kontak & Lokasi
                </a>
            </div>

            <!-- CTA Button Desktop -->
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('booking') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand-wood text-white font-medium text-sm hover:bg-brand-dark shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5 border border-brand-wood/80">
                    <i class="fa-regular fa-calendar-check text-brand-gold"></i>
                    <span>Cek Jadwal / Booking</span>
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileOpen = !mobileOpen" 
                        type="button" 
                        class="p-2 rounded-lg text-brand-charcoal hover:text-brand-wood hover:bg-brand-sand/50 transition focus:outline-none"
                        aria-label="Toggle navigation">
                    <i :class="mobileOpen ? 'fa-solid fa-xmark text-2xl' : 'fa-solid fa-bars text-2xl'"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div x-show="mobileOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.away="mobileOpen = false"
         class="md:hidden bg-brand-cream border-t border-brand-sand/70 px-4 pt-3 pb-6 space-y-3 shadow-xl"
         x-cloak>
        <div class="flex flex-col space-y-2 pt-2">
            <a href="{{ route('home') }}" 
               @click="mobileOpen = false"
               class="px-3 py-2.5 rounded-lg text-base font-semibold {{ request()->routeIs('home') ? 'bg-brand-sand text-brand-wood font-bold' : 'text-brand-charcoal hover:bg-brand-sand/50' }}">
                <i class="fa-solid fa-house-chimney w-6 text-brand-amber"></i> Beranda
            </a>
            <a href="{{ route('packages') }}" 
               @click="mobileOpen = false"
               class="px-3 py-2.5 rounded-lg text-base font-semibold {{ request()->routeIs('packages') ? 'bg-brand-sand text-brand-wood font-bold' : 'text-brand-charcoal hover:bg-brand-sand/50' }}">
                <i class="fa-solid fa-tags w-6 text-brand-amber"></i> Paket & Fasilitas
            </a>
            <a href="{{ route('gallery') }}" 
               @click="mobileOpen = false"
               class="px-3 py-2.5 rounded-lg text-base font-semibold {{ request()->routeIs('gallery') ? 'bg-brand-sand text-brand-wood font-bold' : 'text-brand-charcoal hover:bg-brand-sand/50' }}">
                <i class="fa-solid fa-images w-6 text-brand-amber"></i> Galeri Foto
            </a>
            <a href="{{ route('contact') }}" 
               @click="mobileOpen = false"
               class="px-3 py-2.5 rounded-lg text-base font-semibold {{ request()->routeIs('contact') ? 'bg-brand-sand text-brand-wood font-bold' : 'text-brand-charcoal hover:bg-brand-sand/50' }}">
                <i class="fa-solid fa-map-location-dot w-6 text-brand-amber"></i> Kontak & Lokasi
            </a>
        </div>

        <div class="pt-3 border-t border-brand-sand">
            <a href="{{ route('booking') }}" 
               @click="mobileOpen = false"
               class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-brand-wood text-white font-semibold text-center shadow-md hover:bg-brand-dark transition">
                <i class="fa-regular fa-calendar-check text-brand-gold"></i>
                <span>Cek Jadwal / Booking Sekarang</span>
            </a>
        </div>
    </div>
</nav>

