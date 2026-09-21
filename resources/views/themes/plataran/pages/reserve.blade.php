@extends('themes.plataran.layouts.app')

@section('title', 'Concierge Event Inquiry & Date Clearance — Omah Ayem')
@section('meta_description', 'Submit a private event brief for your wedding, intimate banquet, or retreat at Omah Ayem Javanese Sanctuary. Direct consultation with our Estate Curator.')

@section('content')
<!-- Page Header -->
<section class="relative bg-luxury-stone text-luxury-ivory py-20 lg:py-28 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=2000&q=85" 
             alt="Reserve Banner" 
             class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-[10px] tracking-ultra uppercase text-luxury-brass font-semibold block mb-3">
            Private Consultation Desk
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-normal text-luxury-ivory mb-4">
            Concierge Event Brief
        </h1>
        <p class="max-w-xl mx-auto text-xs sm:text-sm text-luxury-ivory/80 font-light leading-relaxed">
            To preserve the sanctuary's intimacy, we host only one distinguished event per calendar date. Please share your vision below to verify availability.
        </p>
    </div>
</section>

<!-- Concierge Inquiry Form (Alpine.js Interactive Form) -->
<section class="py-24 bg-luxury-ivory" 
         x-data="{
             fullName: '',
             phone: '',
             email: '',
             eventDate: '',
             chosenExperience: '{{ $selectedExperience }}',
             estimatedGuests: '150 - 250 Guests',
             visionNotes: '',
             submittedAlert: false,

             compileWhatsAppText() {
                 let text = `*ESTATE CONCIERGE INQUIRY - OMAH AYEM*%0A%0A` +
                            `*Principal Contact:* ${this.fullName || '-' }%0A` +
                            `*WhatsApp:* ${this.phone || '-' }%0A` +
                            `*Email:* ${this.email || '-' }%0A` +
                            `*Proposed Date:* ${this.eventDate || '-' }%0A` +
                            `*Desired Offering:* ${this.chosenExperience || '-' }%0A` +
                            `*Estimated Attendance:* ${this.estimatedGuests || '-' }%0A` +
                            `*Special Curatorial Brief:* ${this.visionNotes || '-' }%0A%0A` +
                            `Kindly advise on calendar availability and private walkthrough arrangements. Warm regards.`;
                 return `https://wa.me/6281234567890?text=${text}`;
             },

             submitInquiry() {
                 if (!this.fullName || !this.phone || !this.eventDate) {
                     alert('Kindly provide your full name, contact number, and intended event date.');
                     return;
                 }
                 window.open(this.compileWhatsAppText(), '_blank');
             }
         }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white p-8 sm:p-14 border border-luxury-border shadow-sm">
            
            <div class="text-center mb-12 pb-8 border-b border-luxury-border">
                <span class="text-[9px] uppercase tracking-ultra text-luxury-brass font-semibold block mb-1">Confidential & Direct</span>
                <h2 class="font-serif text-2xl sm:text-3xl text-luxury-stone font-normal">Sanctuary Reservation Request</h2>
                <p class="text-xs text-luxury-muted mt-2">All submissions are directly routed to the Estate General Manager.</p>
            </div>

            <form @submit.prevent="submitInquiry()" class="space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Full Name -->
                    <div class="space-y-2">
                        <label for="fullName" class="block text-[11px] uppercase tracking-luxury text-luxury-stone font-semibold">
                            Full Name / Title <span class="text-luxury-brass">*</span>
                        </label>
                        <input type="text" 
                               id="fullName" 
                               x-model="fullName"
                               required
                               placeholder="e.g. Raden Mas Danang & Partner"
                               class="w-full px-0 py-3 bg-transparent border-b border-luxury-border focus:border-luxury-forest outline-none text-sm transition font-body text-luxury-stone">
                    </div>

                    <!-- Contact Phone / WhatsApp -->
                    <div class="space-y-2">
                        <label for="phone" class="block text-[11px] uppercase tracking-luxury text-luxury-stone font-semibold">
                            WhatsApp / Mobile <span class="text-luxury-brass">*</span>
                        </label>
                        <input type="tel" 
                               id="phone" 
                               x-model="phone"
                               required
                               placeholder="+62 812..."
                               class="w-full px-0 py-3 bg-transparent border-b border-luxury-border focus:border-luxury-forest outline-none text-sm transition font-body text-luxury-stone">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-[11px] uppercase tracking-luxury text-luxury-stone font-semibold">
                            Email Address
                        </label>
                        <input type="email" 
                               id="email" 
                               x-model="email"
                               placeholder="name@exclusive.com"
                               class="w-full px-0 py-3 bg-transparent border-b border-luxury-border focus:border-luxury-forest outline-none text-sm transition font-body text-luxury-stone">
                    </div>

                    <!-- Proposed Date -->
                    <div class="space-y-2">
                        <label for="eventDate" class="block text-[11px] uppercase tracking-luxury text-luxury-stone font-semibold">
                            Intended Date <span class="text-luxury-brass">*</span>
                        </label>
                        <input type="date" 
                               id="eventDate" 
                               x-model="eventDate"
                               required
                               class="w-full px-0 py-3 bg-transparent border-b border-luxury-border focus:border-luxury-forest outline-none text-sm transition font-body text-luxury-stone">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Offering Select -->
                    <div class="space-y-2">
                        <label for="chosenExperience" class="block text-[11px] uppercase tracking-luxury text-luxury-stone font-semibold">
                            Curated Celebration Format <span class="text-luxury-brass">*</span>
                        </label>
                        <select id="chosenExperience" 
                                x-model="chosenExperience"
                                required
                                class="w-full px-0 py-3 bg-transparent border-b border-luxury-border focus:border-luxury-forest outline-none text-sm transition font-body text-luxury-stone">
                            <option value="">-- Select An Offering --</option>
                            @foreach($experiences as $exp)
                            <option value="{{ $exp['title'] }}">{{ $exp['title'] }} ({{ $exp['price'] }})</option>
                            @endforeach
                            <option value="Bespoke Estate Buyout / Custom Format">Bespoke Estate Buyout / Custom Format</option>
                        </select>
                    </div>

                    <!-- Estimated Guests -->
                    <div class="space-y-2">
                        <label for="estimatedGuests" class="block text-[11px] uppercase tracking-luxury text-luxury-stone font-semibold">
                            Estimated Guest Count
                        </label>
                        <select id="estimatedGuests" 
                                x-model="estimatedGuests"
                                class="w-full px-0 py-3 bg-transparent border-b border-luxury-border focus:border-luxury-forest outline-none text-sm transition font-body text-luxury-stone">
                            <option value="Under 50 Guests (Intimate / Ceremony Only)">Under 50 Guests (Intimate / Ceremony Only)</option>
                            <option value="50 - 150 Guests (Intimate Heritage Soirée)">50 - 150 Guests (Intimate Heritage Soirée)</option>
                            <option value="150 - 300 Guests (Noble Wedding Banquet)">150 - 300 Guests (Noble Wedding Banquet)</option>
                            <option value="300 - 450 Guests (Grand Royal Matrimony)">300 - 450 Guests (Grand Royal Matrimony)</option>
                        </select>
                    </div>
                </div>

                <!-- Curatorial Vision & Notes -->
                <div class="space-y-2">
                    <label for="visionNotes" class="block text-[11px] uppercase tracking-luxury text-luxury-stone font-semibold">
                        Curatorial Vision & Special Requirements
                    </label>
                    <textarea id="visionNotes" 
                              x-model="visionNotes"
                              rows="3" 
                              placeholder="Please share any preferred culinary style, specific walkthrough schedule, or bespoke staging desires..."
                              class="w-full px-0 py-3 bg-transparent border-b border-luxury-border focus:border-luxury-forest outline-none text-sm transition font-body text-luxury-stone"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" 
                            class="w-full py-4 px-8 bg-luxury-forest text-luxury-ivory hover:bg-luxury-forest-deep text-xs uppercase tracking-ultra font-semibold transition-all duration-300 flex items-center justify-center gap-3">
                        <i class="fa-brands fa-whatsapp text-lg text-luxury-gold"></i>
                        <span>Transmit Brief to Estate Concierge</span>
                    </button>
                    <p class="text-[10px] text-luxury-muted text-center tracking-wider mt-3">
                        Your inquiry opens a dedicated high-priority consultation thread with our venue management team.
                    </p>
                </div>

            </form>

        </div>

    </div>
</section>
@endsection

