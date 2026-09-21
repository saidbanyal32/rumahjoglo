<header x-data="{ mobileOpen: false, scrolled: false }"
        @scroll.window="scrolled = (window.pageYOffset > 40)"
        :class="scrolled ? 'bg-luxury-ivory/95 backdrop-blur-md shadow-sm py-4 border-b border-luxury-border' : 'bg-luxury-ivory/80 backdrop-blur-sm py-6 border-b border-luxury-border/60'"
        class="sticky top-0 z-40 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            
            <!-- Left Navigation -->
            <nav class="hidden lg:flex items-center space-x-8 text-xs tracking-ultra uppercase font-medium">
                <a href="{{ route('luxury.home') }}" 
                   class="transition-colors duration-300 {{ request()->routeIs('luxury.home') ? 'text-luxury-forest font-semibold border-b border-luxury-brass pb-1' : 'text-luxury-stone hover:text-luxury-brass' }}">
                    The Sanctuary
                </a>
                <a href="{{ route('luxury.experience') }}" 
                   class="transition-colors duration-300 {{ request()->routeIs('luxury.experience') ? 'text-luxury-forest font-semibold border-b border-luxury-brass pb-1' : 'text-luxury-stone hover:text-luxury-brass' }}">
                    Curated Offerings
                </a>
                <a href="{{ route('luxury.home') }}#spaces" 
                   class="transition-colors duration-300 text-luxury-stone hover:text-luxury-brass">
                    Spaces
                </a>
            </nav>

            <!-- Center Brand / Identity -->
            <div class="text-center">
                <a href="{{ route('luxury.home') }}" class="inline-block group">
                    <span class="block font-serif text-2xl sm:text-3xl lg:text-3xl tracking-widest text-luxury-stone group-hover:text-luxury-forest transition-colors duration-300 uppercase">
                        OMAH AYEM
                    </span>
                    <span class="block text-[9px] sm:text-[10px] tracking-ultra text-luxury-brass uppercase font-medium -mt-0.5">
                        A Javanese Sanctuary &bull; Yogyakarta
                    </span>
                </a>
            </div>

            <!-- Right Navigation & CTA -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="{{ route('luxury.reserve') }}" 
                   class="inline-block text-xs uppercase tracking-ultra px-6 py-2.5 border border-luxury-forest text-luxury-forest hover:bg-luxury-forest hover:text-white transition-all duration-300 font-medium">
                    Concierge Inquiry
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex lg:hidden items-center">
                <button @click="mobileOpen = !mobileOpen" 
                        type="button" 
                        class="p-2 text-luxury-stone hover:text-luxury-brass transition focus:outline-none"
                        aria-label="Toggle navigation">
                    <i :class="mobileOpen ? 'fa-solid fa-xmark text-xl' : 'fa-solid fa-bars text-xl'"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div x-show="mobileOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         @click.away="mobileOpen = false"
         class="lg:hidden bg-luxury-ivory border-b border-luxury-border px-6 py-8 space-y-6 text-center"
         x-cloak>
        <div class="flex flex-col space-y-4 text-xs tracking-ultra uppercase font-medium">
            <a href="{{ route('luxury.home') }}" 
               @click="mobileOpen = false"
               class="py-2 {{ request()->routeIs('luxury.home') ? 'text-luxury-forest font-semibold' : 'text-luxury-stone' }}">
                The Sanctuary (Home)
            </a>
            <a href="{{ route('luxury.experience') }}" 
               @click="mobileOpen = false"
               class="py-2 {{ request()->routeIs('luxury.experience') ? 'text-luxury-forest font-semibold' : 'text-luxury-stone' }}">
                Curated Offerings & Packages
            </a>
            <a href="{{ route('luxury.home') }}#spaces" 
               @click="mobileOpen = false"
               class="py-2 text-luxury-stone">
                The Heritage Spaces
            </a>
            <a href="{{ route('luxury.reserve') }}" 
               @click="mobileOpen = false"
               class="py-2 text-luxury-stone">
                Concierge Event Inquiry
            </a>
            <a href="{{ route('home') }}" 
               @click="mobileOpen = false"
               class="py-2 text-luxury-brass">
                &larr; Switch to Classic Theme
            </a>
        </div>
        <div class="pt-4 border-t border-luxury-border">
            <a href="{{ route('luxury.reserve') }}" 
               @click="mobileOpen = false"
               class="block w-full py-3 px-6 text-xs uppercase tracking-ultra bg-luxury-forest text-white font-medium hover:bg-luxury-forest-deep transition">
                Book A Private Consultation
            </a>
        </div>
    </div>
</header>

