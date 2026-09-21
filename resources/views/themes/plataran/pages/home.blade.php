@extends('themes.plataran.layouts.app')

@section('title', 'Omah Ayem — A Sanctuary of Javanese Heritage & Quiet Splendor')
@section('meta_description', 'Experience the noble serenity of authentic Javanese joglo architecture in Sleman, Yogyakarta. Inspired by the understated luxury of Plataran hospitality.')

@section('content')
<!-- Hero Section: Cinematic Full-Bleed -->
<section class="relative min-h-[92vh] flex items-center justify-center overflow-hidden bg-luxury-stone text-luxury-ivory">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/joglo.jpg') }}" 
             alt="Omah Ayem Pendopo Sanctuary" 
             class="w-full h-full object-cover object-center filter brightness-[0.75] contrast-[1.05] transform scale-100 transition duration-1000">
        <div class="absolute inset-0 bg-gradient-to-t from-luxury-stone via-luxury-stone/40 to-black/30"></div>
        <div class="absolute inset-0 bg-luxury-forest/20 mix-blend-multiply"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <!-- Eyebrow -->
        <div class="inline-flex items-center gap-3 mb-6">
            <span class="w-10 h-[1px] bg-luxury-brass/70"></span>
            <span class="text-[10px] sm:text-xs tracking-ultra uppercase text-luxury-brass font-medium">
                The Heritage Estate &bull; Sleman, Yogyakarta
            </span>
            <span class="w-10 h-[1px] bg-luxury-brass/70"></span>
        </div>

        <!-- Main Editorial Headline -->
        <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-normal tracking-wide text-luxury-ivory leading-[1.15] mb-6">
            Where Javanese Heritage Whispers in <br class="hidden sm:inline">
            <span class="italic font-light text-luxury-brass-light">Tranquil Splendor</span>
        </h1>

        <!-- Subheading -->
        <p class="max-w-2xl mx-auto text-sm sm:text-base text-luxury-ivory/80 font-light tracking-wide leading-relaxed mb-12">
            An exclusive sanctuary of centenary teak pavilions, sacred courtyards, and verdant garden lawns. Curated for distinguished matrimonies, private banquets, and restorative escapes.
        </p>

        <!-- Ghost CTAs -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-5 text-xs tracking-ultra uppercase">
            <a href="{{ route('luxury.experience') }}" 
               class="w-full sm:w-auto px-8 py-4 bg-luxury-forest text-luxury-ivory border border-luxury-brass/60 hover:bg-luxury-forest-deep transition-all duration-300 font-medium">
                Explore The Offerings
            </a>
            <a href="{{ route('luxury.reserve') }}" 
               class="w-full sm:w-auto px-8 py-4 bg-transparent hover:bg-white/10 text-luxury-ivory border border-luxury-ivory/30 transition-all duration-300 font-medium">
                Schedule Private Viewing
            </a>
        </div>
    </div>
</section>

<!-- Secondary Sub-Navigation / Anchor Bar -->
<div class="sticky top-[73px] z-30 bg-luxury-ivory/95 backdrop-blur-md border-b border-luxury-border py-3 hidden md:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center space-x-10 text-[11px] uppercase tracking-ultra font-medium text-luxury-muted">
            <a href="#spirit" class="hover:text-luxury-stone transition">The Spirit</a>
            <span class="text-luxury-border">&bull;</span>
            <a href="#spaces" class="hover:text-luxury-stone transition">The Sanctuaries</a>
            <span class="text-luxury-border">&bull;</span>
            <a href="#offerings" class="hover:text-luxury-stone transition">Offerings</a>
            <span class="text-luxury-border">&bull;</span>
            <a href="#privileges" class="hover:text-luxury-stone transition">Estate Privileges</a>
            <span class="text-luxury-border">&bull;</span>
            <a href="{{ route('luxury.reserve') }}" class="text-luxury-brass hover:text-luxury-forest transition font-semibold">Reserve</a>
        </div>
    </div>
</div>

<!-- Section 1: The Spirit of Ayem (Editorial Storytelling) -->
<section id="spirit" class="py-24 sm:py-32 bg-luxury-ivory">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Left: Curated Portrait Image -->
            <div class="lg:col-span-5 relative">
                <div class="aspect-[3/4] overflow-hidden bg-luxury-sand relative shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=85" 
                         alt="Teak Wood Detailing" 
                         class="w-full h-full object-cover">
                </div>
                <!-- Floating Decorative Frame Line -->
                <div class="hidden sm:block absolute -bottom-6 -right-6 w-full h-full border border-luxury-brass/40 -z-10 pointer-events-none"></div>
            </div>

            <!-- Right: Editorial Narrative -->
            <div class="lg:col-span-7 lg:pl-6 space-y-6">
                <div class="flex items-center gap-3">
                    <span class="text-[10px] tracking-ultra uppercase text-luxury-brass font-semibold">Philosophy of Quietude</span>
                </div>
                
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-luxury-stone font-normal leading-tight">
                    The Soul of Ancient Teak & <br>
                    <span class="italic text-luxury-forest">Enduring Peace</span>
                </h2>

                <p class="font-serif italic text-luxury-brass text-lg sm:text-xl font-light leading-relaxed">
                    "Ayem in the ancient Javanese idiom transcends mere quiet; it speaks of an untroubled soul, where time slows down to honor the sacred."
                </p>

                <div class="space-y-4 text-xs sm:text-sm text-luxury-charcoal/80 leading-relaxed font-body">
                    <p>
                        Nestled in the tranquil rural periphery of Sleman, framed by the distant silhouette of Mount Merapi, <strong>Rumah Joglo Omah Ayem</strong> stands as a tribute to classical Mataram vernacular architecture. Every beam and mortise-tenon joint of our grand pendopo has been lovingly gathered from antique heritage dwellings.
                    </p>
                    <p>
                        Here, luxury is not defined by excess, but by authenticity: the aroma of seasoned teak timber, the rustle of frangipani blossoms caught in evening breezes, and the gentle chime of gamelan echoing across reflection pools.
                    </p>
                </div>

                <div class="pt-6 border-t border-luxury-border flex items-center gap-8 text-xs tracking-ultra uppercase">
                    <div>
                        <span class="block font-serif text-2xl text-luxury-stone font-semibold">100+</span>
                        <span class="text-[10px] text-luxury-muted">Years Aged Teak</span>
                    </div>
                    <div class="h-8 w-[1px] bg-luxury-border"></div>
                    <div>
                        <span class="block font-serif text-2xl text-luxury-stone font-semibold">1,200</span>
                        <span class="text-[10px] text-luxury-muted">Sqm Secluded Grounds</span>
                    </div>
                    <div class="h-8 w-[1px] bg-luxury-border"></div>
                    <div>
                        <span class="block font-serif text-2xl text-luxury-stone font-semibold">Single</span>
                        <span class="text-[10px] text-luxury-muted">Private Buyout</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Section 2: The Spaces / Sanctuaries -->
<section id="spaces" class="py-24 bg-luxury-cream/40 border-y border-luxury-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto mb-20">
            <span class="text-[10px] tracking-ultra uppercase text-luxury-brass font-semibold block mb-2">Architectural Ensemble</span>
            <h2 class="font-serif text-3xl sm:text-4xl text-luxury-stone font-normal">The Estate Sanctuaries</h2>
            <div class="w-12 h-[1px] bg-luxury-brass mx-auto mt-4 mb-4"></div>
            <p class="text-xs sm:text-sm text-luxury-muted leading-relaxed">
                Interconnected pavilions conceived for grand ceremonies, discreet royal preparation, and starlit open-air dining.
            </p>
        </div>

        <!-- Showcase Items (Alternating Editorial Composition) -->
        <div class="space-y-24">
            @foreach($spaces as $index => $space)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center {{ $index % 2 == 1 ? 'lg:flex-row-reverse' : '' }}">
                
                <!-- Image Container -->
                <div class="lg:col-span-7 {{ $index % 2 == 1 ? 'lg:order-2' : '' }}">
                    <div class="relative overflow-hidden aspect-[16/10] bg-luxury-sand shadow-lg group">
                        <img src="{{ $space['image'] }}" 
                             alt="{{ $space['name'] }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-luxury-stone/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    </div>
                </div>

                <!-- Text Content -->
                <div class="lg:col-span-5 {{ $index % 2 == 1 ? 'lg:order-1' : '' }} space-y-4">
                    <span class="text-[10px] uppercase tracking-ultra text-luxury-brass font-semibold">
                        Space 0{{ $index + 1 }} &bull; {{ $space['dimension'] }}
                    </span>
                    <h3 class="font-serif text-2xl sm:text-3xl text-luxury-stone font-normal">
                        {{ $space['name'] }}
                    </h3>
                    <p class="text-[11px] tracking-luxury uppercase text-luxury-forest font-medium -mt-2">
                        {{ $space['subtitle'] }}
                    </p>
                    <p class="text-xs sm:text-sm text-luxury-charcoal/80 leading-relaxed font-body">
                        {{ $space['description'] }}
                    </p>
                    <div class="pt-2 text-xs text-luxury-muted flex items-center gap-2">
                        <i class="fa-solid fa-users text-luxury-brass text-[11px]"></i>
                        <span>{{ $space['capacity'] }}</span>
                    </div>
                    <div class="pt-4">
                        <a href="{{ route('luxury.experience') }}" 
                           class="inline-flex items-center gap-2 text-xs uppercase tracking-luxury text-luxury-stone hover:text-luxury-brass transition border-b border-luxury-stone pb-1">
                            <span>Explore Bespoke Formats</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Section 3: Signature Experiences (Offerings) -->
<section id="offerings" class="py-24 bg-luxury-ivory">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 pb-6 border-b border-luxury-border">
            <div>
                <span class="text-[10px] tracking-ultra uppercase text-luxury-brass font-semibold block mb-1">Tailored Receptions</span>
                <h2 class="font-serif text-3xl sm:text-4xl text-luxury-stone font-normal">Curated Celebrations</h2>
            </div>
            <a href="{{ route('luxury.experience') }}" 
               class="mt-4 md:mt-0 text-xs tracking-luxury uppercase text-luxury-stone hover:text-luxury-brass transition border-b border-luxury-border pb-1">
                View All Inclusions & Tariff &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            @foreach(array_slice($experiences, 0, 2) as $exp)
            <div class="bg-white p-8 sm:p-10 border border-luxury-border shadow-sm hover:border-luxury-brass/80 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="aspect-[16/9] overflow-hidden bg-luxury-sand mb-6">
                        <img src="{{ $exp['image'] }}" alt="{{ $exp['title'] }}" class="w-full h-full object-cover">
                    </div>
                    <span class="text-[10px] uppercase tracking-ultra text-luxury-brass font-semibold block mb-1">
                        {{ $exp['duration'] }}
                    </span>
                    <h3 class="font-serif text-2xl text-luxury-stone font-normal mb-2">
                        {{ $exp['title'] }}
                    </h3>
                    <p class="text-xs text-luxury-muted mb-6 leading-relaxed">
                        {{ $exp['tagline'] }}
                    </p>
                    
                    <ul class="space-y-2.5 text-xs text-luxury-charcoal/80 mb-8">
                        @foreach(array_slice($exp['inclusions'], 0, 4) as $inc)
                        <li class="flex items-start gap-2.5">
                            <span class="text-luxury-brass text-sm leading-none">&bull;</span>
                            <span>{{ $inc }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="pt-6 border-t border-luxury-border flex items-baseline justify-between">
                    <div>
                        <span class="block text-[10px] text-luxury-muted uppercase tracking-wider">Starting Tariff</span>
                        <span class="font-serif text-2xl text-luxury-forest font-semibold">{{ $exp['price'] }}</span>
                    </div>
                    <a href="{{ route('luxury.reserve') }}?experience={{ urlencode($exp['title']) }}" 
                       class="text-xs uppercase tracking-luxury px-5 py-2.5 bg-luxury-forest text-luxury-ivory hover:bg-luxury-forest-deep transition">
                        Enquire
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Section 4: Estate Privileges (Fine-Line Icons) -->
<section id="privileges" class="py-20 bg-luxury-forest-deep text-luxury-ivory border-t border-luxury-brass/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-[10px] tracking-ultra uppercase text-luxury-gold font-semibold block mb-1">Five-Star Standards</span>
            <h2 class="font-serif text-3xl sm:text-4xl text-luxury-ivory font-normal">The Estate Privileges</h2>
            <div class="w-10 h-[1px] bg-luxury-brass mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($privileges as $priv)
            <div class="p-8 border border-luxury-ivory/10 hover:border-luxury-brass/50 transition duration-300 text-center space-y-3">
                <div class="w-12 h-12 rounded-full border border-luxury-brass/40 mx-auto flex items-center justify-center text-luxury-gold text-lg mb-4">
                    <i class="fa-solid {{ $priv['icon'] }}"></i>
                </div>
                <h3 class="font-serif text-lg text-luxury-ivory font-medium">{{ $priv['title'] }}</h3>
                <p class="text-[11px] uppercase tracking-luxury text-luxury-brass-light font-light">{{ $priv['subtitle'] }}</p>
                <p class="text-xs text-luxury-ivory/70 leading-relaxed font-light">
                    {{ $priv['desc'] }}
                </p>
            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Section 5: Editorial Invitation Banner -->
<section class="py-24 bg-luxury-stone text-luxury-ivory text-center relative overflow-hidden">
    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-[10px] tracking-ultra uppercase text-luxury-brass font-semibold block mb-3">Begin Your Story</span>
        <h2 class="font-serif text-3xl sm:text-5xl text-luxury-ivory font-normal leading-tight mb-6">
            Schedule a Private Walkthrough & Tasting
        </h2>
        <p class="text-xs sm:text-sm text-luxury-ivory/80 font-light leading-relaxed max-w-xl mx-auto mb-10">
            Allow our dedicated estate curator to walk you through the grounds, discuss custom lighting arrangements, and reserve your sacred date.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-xs tracking-ultra uppercase">
            <a href="{{ route('luxury.reserve') }}" 
               class="w-full sm:w-auto px-8 py-4 bg-luxury-brass text-luxury-stone font-semibold hover:bg-luxury-brass-light transition">
                Submit Event Brief
            </a>
            <a href="https://wa.me/{{ $siteSettings['formatted_whatsapp'] ?? '6281234567890' }}?text=Greetings%20Omah%20Ayem%2C%20I%20would%20like%20to%20schedule%20a%20private%20sanctuary%20walkthrough." 
               target="_blank" 
               class="w-full sm:w-auto px-8 py-4 border border-luxury-ivory/30 text-luxury-ivory hover:bg-white/10 transition">
                WhatsApp Concierge Desk
            </a>
        </div>
    </div>
</section>
@endsection

