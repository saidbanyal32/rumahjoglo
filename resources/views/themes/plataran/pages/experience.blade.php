@extends('themes.plataran.layouts.app')

@section('title', 'Curated Offerings & Private Buyout Formats — Omah Ayem')
@section('meta_description', 'Discover bespoke wedding, intimate banquet, and private villa buyout offerings at Omah Ayem Javanese Sanctuary in Yogyakarta.')

@section('content')
<!-- Page Header -->
<section class="relative bg-luxury-stone text-luxury-ivory py-20 lg:py-28 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-30">
        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=2000&q=85" 
             alt="Experience Banner" 
             class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-[10px] tracking-ultra uppercase text-luxury-brass font-semibold block mb-3">
            Bespoke Formats & Private Buyouts
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-normal text-luxury-ivory mb-4">
            Curated Celebrations & Residencies
        </h1>
        <p class="max-w-xl mx-auto text-xs sm:text-sm text-luxury-ivory/80 font-light leading-relaxed">
            Every gathering at Omah Ayem is an exclusive affair. We present refined celebration formats tailored to sacred vows, cherished reunions, and editorial captures.
        </p>
    </div>
</section>

<!-- Offerings List (Editorial Menu Showcase Style) -->
<section class="py-24 bg-luxury-ivory">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">
        
        @foreach($experiences as $index => $exp)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start pb-20 border-b border-luxury-border">
            
            <!-- Left: Curated Visual -->
            <div class="lg:col-span-6">
                <div class="aspect-[4/3] overflow-hidden bg-luxury-sand shadow-lg relative group">
                    <img src="{{ $exp['image'] }}" 
                         alt="{{ $exp['title'] }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute top-4 left-4 px-3 py-1 bg-luxury-stone/85 text-luxury-brass text-[10px] tracking-ultra uppercase font-medium">
                        {{ $exp['guest_recommendation'] }}
                    </div>
                </div>
            </div>

            <!-- Right: Detailed Inclusions & Narrative -->
            <div class="lg:col-span-6 space-y-6">
                <div>
                    <span class="text-[10px] tracking-ultra uppercase text-luxury-brass font-semibold block mb-1">
                        Format 0{{ $index + 1 }} &bull; {{ $exp['duration'] }}
                    </span>
                    <h2 class="font-serif text-3xl text-luxury-stone font-normal">
                        {{ $exp['title'] }}
                    </h2>
                    <p class="font-serif italic text-luxury-forest text-base mt-1">
                        {{ $exp['tagline'] }}
                    </p>
                </div>

                <!-- Price & Value -->
                <div class="py-4 border-y border-luxury-border flex items-baseline justify-between">
                    <div>
                        <span class="text-[10px] text-luxury-muted uppercase tracking-wider block">Bespoke Investment</span>
                        <span class="font-serif text-3xl text-luxury-forest font-semibold">{{ $exp['price'] }}</span>
                    </div>
                    <span class="text-[11px] text-luxury-muted font-light">Exclusive estate buy-out</span>
                </div>

                <!-- Comprehensive Inclusions -->
                <div>
                    <h3 class="text-[11px] uppercase tracking-luxury text-luxury-stone font-semibold mb-3">
                        Curated Privileges & Inclusions:
                    </h3>
                    <ul class="space-y-2.5 text-xs text-luxury-charcoal/85 leading-relaxed">
                        @foreach($exp['inclusions'] as $inc)
                        <li class="flex items-start gap-3">
                            <span class="text-luxury-brass text-sm leading-none mt-0.5">&bull;</span>
                            <span>{{ $inc }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Note -->
                @if(!empty($exp['note']))
                <div class="p-4 bg-luxury-cream/50 border border-luxury-border text-xs text-luxury-charcoal/80 font-serif italic">
                    <span class="font-sans font-semibold text-luxury-stone not-italic uppercase tracking-wider text-[10px] mr-1">Curator's Note:</span>
                    {{ $exp['note'] }}
                </div>
                @endif

                <!-- CTAs -->
                <div class="pt-4 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('luxury.reserve') }}?experience={{ urlencode($exp['title']) }}" 
                       class="px-8 py-3.5 bg-luxury-forest text-luxury-ivory text-xs uppercase tracking-ultra font-medium hover:bg-luxury-forest-deep transition text-center">
                        Request Date Clearance
                    </a>
                    <a href="https://wa.me/{{ $siteSettings['formatted_whatsapp'] ?? '6281234567890' }}?text=Greetings%20Concierge%2C%20I%20am%20inquiring%20about%20{{ urlencode($exp['title']) }}" 
                       target="_blank" 
                       class="px-6 py-3.5 border border-luxury-border text-luxury-stone text-xs uppercase tracking-ultra font-medium hover:bg-luxury-cream transition text-center flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp text-sm text-luxury-forest"></i>
                        <span>Concierge Chat</span>
                    </a>
                </div>
            </div>

        </div>
        @endforeach

    </div>
</section>

<!-- Culinary & External Vendor Ethos -->
<section class="py-20 bg-luxury-cream/50 border-t border-luxury-border">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-[10px] tracking-ultra uppercase text-luxury-brass font-semibold block">Estate Philosophy</span>
        <h3 class="font-serif text-2xl sm:text-3xl text-luxury-stone font-normal">Unrestricted Gastronomic Collaboration</h3>
        <p class="text-xs sm:text-sm text-luxury-charcoal/80 leading-relaxed font-body">
            At Omah Ayem, we believe culinary choices should reflect your personal tastes without penalty. We welcome premier catering ateliers, artisanal coffee roasters, and traditional Javanese royal culinary curators with full back-of-house kitchen staging access and zero corkage surcharges.
        </p>
    </div>
</section>
@endsection

