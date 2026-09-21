@extends('layouts.app')

@section('title', 'Formulir Reservasi & Pembayaran DP - Rumah Joglo Omah Ayem')
@section('meta_description', 'Formulir pengajuan reservasi tanggal acara dan pembayaran Uang Muka (DP) resmi Rumah Joglo Omah Ayem.')

@section('content')
<!-- Header Banner Halaman -->
<section class="relative bg-brand-dark text-white py-14 lg:py-20 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80" 
             alt="Booking Banner" 
             class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-xs uppercase tracking-widest font-bold text-brand-gold bg-brand-wood/60 px-4 py-1.5 rounded-full mb-3 border border-brand-gold/30">
            Pemesanan & Penguncian Jadwal
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-bold text-brand-cream mb-3">
            Formulir Reservasi & Uang Muka (DP)
        </h1>
        <p class="max-w-xl mx-auto text-brand-cream/80 text-sm sm:text-base">
            Pilih paket sewa impian Anda, periksa ketersediaan tanggal secara instan, dan kunci jadwal resmi dengan sistem Uang Muka (DP).
        </p>
    </div>
</section>

<!-- Formulir Reservasi Interaktif -->
<section class="py-16 bg-brand-cream" 
         x-data="{
             name: '{{ old('name') }}',
             phone: '{{ old('phone') }}',
             email: '{{ old('email') }}',
             eventDate: '{{ old('event_date') }}',
             selectedPkg: '{{ old('package_name', $selectedPackage) }}',
             guestCount: '{{ old('guest_count', '150 - 300 Tamu (Resepsi Sedang)') }}',
             notes: '{{ old('notes') }}',
             
             packages: @json($packages),
             dpPercentage: {{ $dpPercentage ?? 30 }},
             
             dateStatus: null, // null, 'checking', 'available', 'pending', 'booked'
             dateMessage: '',
             isSubmitting: false,

             formatRupiah(number) {
                 return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
             },

             getSelectedPackageData() {
                 if (!this.selectedPkg) return null;
                 return this.packages.find(p => p.name === this.selectedPkg || p.id === this.selectedPkg || p.slug === this.selectedPkg) || null;
             },

             getPackagePrice() {
                 let pkg = this.getSelectedPackageData();
                 return pkg && pkg.raw_price ? pkg.raw_price : 5000000;
             },

             getDpAmount() {
                 return Math.round((this.getPackagePrice() * this.dpPercentage) / 100);
             },

             getRemainingAmount() {
                 return Math.max(0, this.getPackagePrice() - this.getDpAmount());
             },

             async checkDateAvailability() {
                 if (!this.eventDate) {
                     this.dateStatus = null;
                     this.dateMessage = '';
                     return;
                 }

                 this.dateStatus = 'checking';
                 this.dateMessage = 'Memeriksa ketersediaan kalender venue...';

                 try {
                     let res = await fetch(`{{ route('api.check-date') }}?date=${this.eventDate}`);
                     let data = await res.json();
                     
                     if (data.available === false) {
                         this.dateStatus = 'booked';
                         this.dateMessage = data.message;
                     } else if (data.has_pending) {
                         this.dateStatus = 'pending';
                         this.dateMessage = data.message;
                     } else {
                         this.dateStatus = 'available';
                         this.dateMessage = data.message;
                     }
                 } catch (e) {
                     this.dateStatus = null;
                     this.dateMessage = '';
                 }
             },

             consultViaWhatsApp() {
                 let text = `*KONSULTASI JADWAL & RESERVASI - OMAH AYEM*%0A%0A` +
                            `*Nama:* ${this.name || '-' }%0A` +
                            `*WhatsApp:* ${this.phone || '-' }%0A` +
                            `*Rencana Tanggal:* ${this.eventDate || '-' }%0A` +
                            `*Paket:* ${this.selectedPkg || '-' }%0A` +
                            `*Tamu:* ${this.guestCount || '-' }%0A` +
                            `*Catatan:* ${this.notes || '-' }%0A%0A` +
                            `Halo Admin Omah Ayem, saya ingin konsultasi ketersediaan jadwal dan survei lokasi terlebih dahulu. Terima kasih.`;
                 window.open(`https://wa.me/{{ $siteSettings['formatted_whatsapp'] ?? '6281234567890' }}?text=${text}`, '_blank');
             }
         }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Flash Alert Error -->
        @if($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 shadow-sm">
            <div class="flex items-center gap-2 font-bold mb-1">
                <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                <span>Pengajuan Belum Lengkap:</span>
            </div>
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-3xl shadow-joglo border border-brand-sand overflow-hidden">
            <!-- Form Header Info -->
            <div class="bg-brand-sand/40 p-6 sm:p-8 border-b border-brand-sand flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h2 class="font-serif text-2xl font-bold text-brand-dark">Data Pemesan & Rencana Acara</h2>
                    <p class="text-xs text-brand-muted mt-1">Lengkapi data untuk mendapatkan invoice resmi dan instruksi pembayaran Uang Muka (DP).</p>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-bold border border-amber-300">
                    <i class="fa-solid fa-lock text-amber-700"></i>
                    <span>Skema DP {{ $dpPercentage ?? 30 }}% Lock Tanggal</span>
                </span>
            </div>

            <!-- Form Content -->
            <form action="{{ route('booking.store') }}" method="POST" class="p-6 sm:p-10 space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Nama Lengkap <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               x-model="name"
                               required
                               placeholder="Contoh: Raden Mas Danang"
                               class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition">
                    </div>

                    <!-- No. WhatsApp -->
                    <div>
                        <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Nomor WhatsApp Aktif <span class="text-rose-600">*</span>
                        </label>
                        <input type="tel" 
                               name="phone" 
                               id="phone" 
                               x-model="phone"
                               required
                               placeholder="Contoh: 081234567890"
                               class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition font-mono">
                        <p class="text-[11px] text-stone-500 mt-1">Notifikasi invoice & konfirmasi jadwal akan dikirim otomatis ke nomor ini.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Alamat Email (Opsional)
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               x-model="email"
                               placeholder="nama@email.com"
                               class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition">
                    </div>

                    <!-- Tanggal Rencana Acara dengan Real-time Availability Check -->
                    <div>
                        <label for="eventDate" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Rencana Tanggal Acara <span class="text-rose-600">*</span>
                        </label>
                        <input type="date" 
                               name="event_date" 
                               id="eventDate" 
                               x-model="eventDate"
                               @change="checkDateAvailability()"
                               min="{{ date('Y-m-d') }}"
                               required
                               class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition">

                        <!-- Real-time Date Status Feedback -->
                        <div class="mt-2 text-xs" x-show="dateStatus" x-cloak>
                            <template x-if="dateStatus === 'checking'">
                                <div class="flex items-center gap-2 text-stone-500">
                                    <i class="fa-solid fa-spinner animate-spin"></i>
                                    <span x-text="dateMessage"></span>
                                </div>
                            </template>

                            <template x-if="dateStatus === 'available'">
                                <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 flex items-start gap-2">
                                    <i class="fa-solid fa-circle-check text-emerald-600 mt-0.5"></i>
                                    <span class="font-medium" x-text="dateMessage"></span>
                                </div>
                            </template>

                            <template x-if="dateStatus === 'pending'">
                                <div class="p-2.5 rounded-xl bg-amber-50 border border-amber-300 text-amber-900 flex items-start gap-2">
                                    <i class="fa-solid fa-clock text-amber-600 mt-0.5"></i>
                                    <span class="font-medium" x-text="dateMessage"></span>
                                </div>
                            </template>

                            <template x-if="dateStatus === 'booked'">
                                <div class="p-2.5 rounded-xl bg-rose-50 border border-rose-300 text-rose-900 flex items-start gap-2 font-bold">
                                    <i class="fa-solid fa-ban text-rose-600 mt-0.5"></i>
                                    <span x-text="dateMessage"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pilihan Paket / Tipe Acara -->
                    <div>
                        <label for="selectedPkg" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Pilihan Paket Sewa <span class="text-rose-600">*</span>
                        </label>
                        <select name="package_name" 
                                id="selectedPkg" 
                                x-model="selectedPkg"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition bg-white font-medium">
                            <option value="">-- Pilih Paket Sewa --</option>
                            @foreach($packages as $p)
                            <option value="{{ $p['name'] }}">{{ $p['name'] }} ({{ $p['price'] }})</option>
                            @endforeach
                            <option value="Paket Kustom / Konsultasi Khusus">Paket Kustom / Konsultasi Khusus (Mulai Rp 5.000.000)</option>
                        </select>
                    </div>

                    <!-- Estimasi Jumlah Tamu -->
                    <div>
                        <label for="guestCount" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Estimasi Jumlah Tamu Undangan
                        </label>
                        <select name="guest_count" 
                                id="guestCount" 
                                x-model="guestCount"
                                class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition bg-white">
                            <option value="Kurang dari 50 Tamu (Sangat Intim / Photoshoot)">Kurang dari 50 Tamu</option>
                            <option value="50 - 150 Tamu (Intimate Event / Lamaran)">50 - 150 Tamu</option>
                            <option value="150 - 300 Tamu (Resepsi Sedang)">150 - 300 Tamu</option>
                            <option value="300 - 450 Tamu (Grand Wedding)">300 - 450 Tamu</option>
                        </select>
                    </div>
                </div>

                <!-- CARD KALKULASI UANG MUKA (DP) OTOMATIS -->
                <div x-show="selectedPkg" x-cloak class="p-6 rounded-2xl bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-300 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-amber-200/80 pb-3">
                        <div class="flex items-center gap-2 text-brand-dark">
                            <i class="fa-solid fa-calculator text-amber-700"></i>
                            <span class="font-serif font-bold text-sm sm:text-base">Kalkulasi Uang Muka (DP) Resmi</span>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full bg-amber-200 text-amber-900 text-[11px] font-bold">
                            DP <span x-text="dpPercentage"></span>%
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                        <div class="bg-white p-3 rounded-xl border border-amber-200">
                            <span class="text-stone-500 block text-[10px] uppercase font-bold tracking-wider">Total Nilai Paket</span>
                            <span class="font-serif font-bold text-stone-900 text-base sm:text-lg block mt-0.5" x-text="formatRupiah(getPackagePrice())"></span>
                        </div>

                        <div class="bg-white p-3 rounded-xl border-2 border-emerald-500 shadow-sm relative overflow-hidden">
                            <div class="absolute top-0 right-0 bg-emerald-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-bl">BAYAR SEKARANG</div>
                            <span class="text-emerald-800 block text-[10px] uppercase font-bold tracking-wider">Nominal DP (<span x-text="dpPercentage"></span>%)</span>
                            <span class="font-serif font-bold text-emerald-700 text-base sm:text-lg block mt-0.5" x-text="formatRupiah(getDpAmount())"></span>
                        </div>

                        <div class="bg-white p-3 rounded-xl border border-amber-200">
                            <span class="text-stone-500 block text-[10px] uppercase font-bold tracking-wider">Sisa Pelunasan (H-14)</span>
                            <span class="font-serif font-bold text-stone-900 text-base sm:text-lg block mt-0.5" x-text="formatRupiah(getRemainingAmount())"></span>
                        </div>
                    </div>

                    <p class="text-[11px] text-amber-900/90 leading-relaxed bg-amber-100/60 p-3 rounded-xl border border-amber-200/60">
                        <i class="fa-solid fa-shield-halved text-amber-700 mr-1"></i>
                        <strong>Kebijakan Penguncian:</strong> Tanggal acara Anda akan dikunci resmi di kalender Omah Ayem setelah pembayaran Uang Muka (DP) diverifikasi. Sisa pelunasan dapat diselesaikan paling lambat H-14 sebelum hari pelaksanaan.
                    </p>
                </div>

                <!-- Catatan Khusus -->
                <div>
                    <label for="notes" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                        Catatan Khusus / Permintaan Khusus (Opsional)
                    </label>
                    <textarea name="notes" 
                              id="notes" 
                              x-model="notes"
                              rows="3" 
                              placeholder="Misal: Rencana membawa vendor luar, jadwal survei lokasi di hari Sabtu, dsb."
                              class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition"></textarea>
                </div>

                <!-- Tombol Aksi Submit & Alternatif WA -->
                <div class="pt-4 flex flex-col sm:flex-row items-center gap-4">
                    <button type="submit" 
                            :disabled="dateStatus === 'booked'"
                            :class="dateStatus === 'booked' ? 'opacity-50 cursor-not-allowed bg-stone-400' : 'bg-brand-wood hover:bg-brand-dark text-white shadow-lg hover:shadow-xl'"
                            class="w-full sm:flex-1 py-4 px-6 rounded-xl font-bold text-sm sm:text-base transition flex items-center justify-center gap-3">
                        <i class="fa-solid fa-credit-card text-lg text-brand-gold"></i>
                        <span>Lanjut ke Rincian & Pembayaran DP</span>
                    </button>

                    <button type="button" 
                            @click="consultViaWhatsApp()" 
                            class="w-full sm:w-auto py-4 px-6 rounded-xl border-2 border-emerald-600 text-emerald-700 hover:bg-emerald-50 font-bold text-sm transition flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span>Konsultasi via WhatsApp</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Alur Reservasi -->
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
            <div class="p-6 rounded-2xl bg-white border border-brand-sand shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-amber/20 text-brand-wood font-bold mx-auto flex items-center justify-center mb-3">1</div>
                <h4 class="font-serif font-bold text-sm text-brand-dark mb-1">Cek Jadwal & Isi Data</h4>
                <p class="text-xs text-brand-muted">Pilih paket impian dan pastikan tanggal acara belum terkunci oleh pihak lain.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-brand-sand shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-amber/20 text-brand-wood font-bold mx-auto flex items-center justify-center mb-3">2</div>
                <h4 class="font-serif font-bold text-sm text-brand-dark mb-1">Transfer Uang Muka (DP)</h4>
                <p class="text-xs text-brand-muted">Lakukan transfer ke rekening bank resmi dan unggah bukti transfer.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-brand-sand shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-amber/20 text-brand-wood font-bold mx-auto flex items-center justify-center mb-3">3</div>
                <h4 class="font-serif font-bold text-sm text-brand-dark mb-1">Tanggal Terkunci Resmi</h4>
                <p class="text-xs text-brand-muted">Admin menerbitkan konfirmasi resmi dan tanggal acara tidak dapat dipesan orang lain.</p>
            </div>
        </div>
    </div>
</section>
@endsection
