<footer class="bg-luxury-forest-deep text-luxury-ivory/80 pt-20 pb-12 border-t border-luxury-brass/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Top Monogram & Epitaph -->
        <div class="text-center pb-16 border-b border-luxury-ivory/10">
            <div class="w-12 h-12 mx-auto rounded-full border border-luxury-brass/50 flex items-center justify-center text-luxury-gold mb-6">
                <i class="fa-solid fa-place-of-worship text-sm"></i>
            </div>
            <h3 class="font-serif text-3xl sm:text-4xl text-luxury-ivory tracking-wider uppercase mb-3">
                OMAH AYEM
            </h3>
            <p class="font-serif italic text-luxury-brass-light text-base max-w-xl mx-auto font-light">
                "Where centuries of Javanese royal heritage whisper in timeless harmony with nature's quietude."
            </p>
        </div>

        <!-- 3 Columns Editorial Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 py-16 border-b border-luxury-ivory/10 text-xs">
            
            <!-- Column 1: The Estate -->
            <div class="space-y-4">
                <h4 class="text-luxury-gold uppercase tracking-ultra font-semibold text-[11px]">The Sanctuary</h4>
                <p class="text-luxury-ivory/70 leading-relaxed font-light">
                    Jl. Palagan Tentara Pelajar Km. 9, Sariharjo, Ngaglik, Sleman Regency, Special Region of Yogyakarta 55581, Indonesia.
                </p>
                <div class="pt-2 text-[10px] tracking-widest text-luxury-brass/80 font-mono">
                    7°43'58.7"S 110°22'44.2"E
                </div>
            </div>

            <!-- Column 2: The Concierge -->
            <div class="space-y-4">
                <h4 class="text-luxury-gold uppercase tracking-ultra font-semibold text-[11px]">Private Concierge</h4>
                <p class="text-luxury-ivory/70 leading-relaxed font-light">
                    For private sanctuary viewings, bespoke event consultations, and date clearance:
                </p>
                <div class="space-y-1.5 pt-1">
                    <p class="text-luxury-ivory font-medium tracking-wider">+62 812-3456-7890 (Private Desk)</p>
                    <p class="text-luxury-brass-light font-light">concierge@jogloomahayem.id</p>
                </div>
            </div>

            <!-- Column 3: The Ethos & Navigation -->
            <div class="space-y-4">
                <h4 class="text-luxury-gold uppercase tracking-ultra font-semibold text-[11px]">Discreet Inquiries</h4>
                <ul class="space-y-2 text-luxury-ivory/75">
                    <li>
                        <a href="{{ route('luxury.home') }}" class="hover:text-luxury-gold transition tracking-wider">The Estate Sanctuary</a>
                    </li>
                    <li>
                        <a href="{{ route('luxury.experience') }}" class="hover:text-luxury-gold transition tracking-wider">Curated Wedding & Dining Offerings</a>
                    </li>
                    <li>
                        <a href="{{ route('luxury.reserve') }}" class="hover:text-luxury-gold transition tracking-wider">Submit Private Event Brief</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}" class="text-luxury-brass hover:text-white transition tracking-wider">Return to Classic Website Theme &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Line -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-[11px] text-luxury-ivory/40 tracking-wider">
            <p>&copy; {{ date('Y') }} Omah Ayem Javanese Sanctuary. All Privileges Reserved.</p>
            <p class="mt-2 sm:mt-0 font-light">Hospitality Architecture in Harmony with Borobudur & Mataram Legacy</p>
        </div>
    </div>
</footer>

