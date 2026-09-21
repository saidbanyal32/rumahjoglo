<!-- Floating WhatsApp Action Button -->
<div x-data="{ tooltip: false }" 
     class="fixed bottom-6 right-6 z-50 flex items-center gap-3">
    <!-- Popover / Tooltip Text -->
    <div x-show="tooltip" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-x-2"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-2"
         class="hidden sm:block bg-white text-brand-charcoal text-xs font-semibold px-3 py-2 rounded-xl shadow-xl border border-brand-sand"
         x-cloak>
        <span class="flex items-center gap-1.5 text-brand-wood">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Tanya Ketersediaan Jadwal (Fast Response)
        </span>
    </div>

    <!-- WhatsApp Main Button -->
    @php
        $waNum = $siteSettings['formatted_whatsapp'] ?? \App\Models\Setting::getWhatsAppNumber('6281234567890');
        $waText = rawurlencode('Halo Admin Rumah Joglo Omah Ayem, saya tertarik untuk menanyakan ketersediaan jadwal sewa tempat...');
    @endphp
    <a href="https://wa.me/{{ $waNum }}?text={{ $waText }}" 
       target="_blank" 
       rel="noopener noreferrer"
       @mouseenter="tooltip = true"
       @mouseleave="tooltip = false"
       class="relative group w-14 h-14 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white flex items-center justify-center shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105"
       aria-label="Chat via WhatsApp">
        <!-- Pulsing Ring -->
        <span class="absolute -inset-1 rounded-full bg-emerald-400 opacity-40 animate-ping group-hover:opacity-75"></span>
        <i class="fa-brands fa-whatsapp text-2xl sm:text-3xl relative z-10"></i>
    </a>
</div>

