<!-- Luxury Concierge Action Button -->
<div x-data="{ open: false }" 
     class="fixed bottom-8 right-8 z-50 flex items-center gap-3">
    
    <!-- Concierge Label Badge -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-3"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-3"
         class="hidden sm:block bg-luxury-forest-deep text-luxury-ivory text-xs px-4 py-2.5 rounded-none border border-luxury-brass/60 shadow-xl tracking-luxury uppercase font-medium"
         x-cloak>
        <span class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-gold animate-pulse"></span>
            Private Concierge Desk &bull; Direct Consultation
        </span>
    </div>

    <!-- Concierge Luxury Button -->
    <a href="https://wa.me/6281234567890?text=Greetings%20Omah%20Ayem%20Concierge%2C%20I%20would%20like%20to%20inquire%20about%20a%20private%20event%20booking%20and%20sanctuary%20viewing." 
       target="_blank" 
       rel="noopener noreferrer"
       @mouseenter="open = true"
       @mouseleave="open = false"
       class="w-13 h-13 p-3.5 bg-luxury-forest text-luxury-brass-light hover:bg-luxury-forest-deep hover:text-white border border-luxury-brass/70 shadow-2xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center group"
       aria-label="Private Concierge Desk">
        <i class="fa-brands fa-whatsapp text-2xl group-hover:text-luxury-gold transition-colors"></i>
    </a>
</div>

