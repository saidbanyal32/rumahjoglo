@extends('layouts.app')

@section('title', 'Formulir Reservasi & Inquiry - Rumah Joglo Omah Ayem')
@section('meta_description', 'Kirim inquiry reservasi dan cek ketersediaan tanggal acara di Rumah Joglo Omah Ayem. Respons cepat via WhatsApp resmi.')

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
            Pemesanan & Pengecekan Jadwal
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-bold text-brand-cream mb-3">
            Formulir Reservasi & Inquiry
        </h1>
        <p class="max-w-xl mx-auto text-brand-cream/80 text-sm sm:text-base">
            Isi formulir di bawah ini untuk memeriksa ketersediaan tanggal dan estimasi biaya acara impian Anda di Omah Ayem.
        </p>
    </div>
</section>

<!-- Formulir Reservasi Interaktif -->
<section class="py-16 bg-brand-cream" 
         x-data="{
             name: '',
             phone: '',
             email: '',
             eventDate: '',
             selectedPkg: '{{ $selectedPackage }}',
             guestCount: '150',
             notes: '',
             submittedModal: false,
             
             generateWhatsAppUrl() {
                 let text = `*INQUIRY RESERVASI - RUMAH JOGLO OMAH AYEM*%0A%0A` +
                            `*Nama Pemesan:* ${this.name || '-' }%0A` +
                            `*No. WhatsApp:* ${this.phone || '-' }%0A` +
                            `*Email:* ${this.email || '-' }%0A` +
                            `*Rencana Tanggal Acara:* ${this.eventDate || '-' }%0A` +
                            `*Pilihan Paket/Acara:* ${this.selectedPkg || '-' }%0A` +
                            `*Estimasi Jumlah Tamu:* ${this.guestCount || '-' } Orang%0A` +
                            `*Catatan Khusus:* ${this.notes || '-' }%0A%0A` +
                            `Mohon informasi ketersediaan jadwal dan prosedur survei lokasi. Terima kasih.`;
                 return `https://wa.me/6281234567890?text=${text}`;
             },

             submitDirectWA() {
                 if (!this.name || !this.phone || !this.eventDate) {
                     alert('Mohon lengkapi Nama, No. WhatsApp, dan Tanggal Rencana Acara terlebih dahulu.');
                     return;
                 }
                 window.open(this.generateWhatsAppUrl(), '_blank');
             },

             submitPreview() {
                 if (!this.name || !this.phone || !this.eventDate) {
                     alert('Mohon lengkapi Nama, No. WhatsApp, dan Tanggal Rencana Acara terlebih dahulu.');
                     return;
                 }
                 this.submittedModal = true;
             }
         }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-3xl shadow-joglo border border-brand-sand overflow-hidden">
            <!-- Form Header Info -->
            <div class="bg-brand-sand/40 p-6 sm:p-8 border-b border-brand-sand flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h2 class="font-serif text-2xl font-bold text-brand-dark">Data Pengajuan Acara</h2>
                    <p class="text-xs text-brand-muted mt-1">Formulir ini bersifat permohonan informasi awal (tanpa pungutan biaya apapun).</p>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Admin Online Siap Merespons
                </span>
            </div>

            <!-- Form Content -->
            <form @submit.prevent="submitDirectWA()" class="p-6 sm:p-10 space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Nama Lengkap <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" 
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
                               id="phone" 
                               x-model="phone"
                               required
                               placeholder="Contoh: 081234567890"
                               class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Alamat Email (Opsional)
                        </label>
                        <input type="email" 
                               id="email" 
                               x-model="email"
                               placeholder="nama@email.com"
                               class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition">
                    </div>

                    <!-- Tanggal Rencana Acara -->
                    <div>
                        <label for="eventDate" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Rencana Tanggal Acara <span class="text-rose-600">*</span>
                        </label>
                        <input type="date" 
                               id="eventDate" 
                               x-model="eventDate"
                               required
                               class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pilihan Paket / Tipe Acara -->
                    <div>
                        <label for="selectedPkg" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Pilihan Paket Sewa / Jenis Acara <span class="text-rose-600">*</span>
                        </label>
                        <select id="selectedPkg" 
                                x-model="selectedPkg"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition bg-white">
                            <option value="">-- Pilih Paket Sewa --</option>
                            @foreach($packages as $p)
                            <option value="{{ $p['name'] }}">{{ $p['name'] }} ({{ $p['price'] }})</option>
                            @endforeach
                            <option value="Paket Kustom / Lainnya">Paket Kustom / Konsultasi Khusus</option>
                        </select>
                    </div>

                    <!-- Estimasi Jumlah Tamu -->
                    <div>
                        <label for="guestCount" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                            Estimasi Jumlah Tamu Undangan
                        </label>
                        <select id="guestCount" 
                                x-model="guestCount"
                                class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition bg-white">
                            <option value="Kurang dari 50 Tamu (Sangat Intim / Photoshoot)">Kurang dari 50 Tamu</option>
                            <option value="50 - 150 Tamu (Intimate Event / Lamaran)">50 - 150 Tamu</option>
                            <option value="150 - 300 Tamu (Resepsi Sedang)">150 - 300 Tamu</option>
                            <option value="300 - 450 Tamu (Grand Wedding)">300 - 450 Tamu</option>
                        </select>
                    </div>
                </div>

                <!-- Catatan Khusus / Permintaan Vendor -->
                <div>
                    <label for="notes" class="block text-xs font-bold uppercase tracking-wider text-brand-dark mb-2">
                        Catatan Khusus / Kebutuhan Tambahan (Opsional)
                    </label>
                    <textarea id="notes" 
                              x-model="notes"
                              rows="3" 
                              placeholder="Misal: Perlu tambahan genset, preferensi jadwal survei lokasi di hari Sabtu, dsb."
                              class="w-full px-4 py-3 rounded-xl border border-brand-sand focus:border-brand-amber focus:ring-2 focus:ring-brand-amber/20 outline-none text-sm transition"></textarea>
                </div>

                <!-- Tombol Aksi Submit -->
                <div class="pt-4 flex flex-col sm:flex-row items-center gap-4">
                    <button type="submit" 
                            class="w-full sm:flex-1 py-4 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm sm:text-base transition shadow-md flex items-center justify-center gap-3">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                        <span>Kirim Reservasi via WhatsApp Langsung</span>
                    </button>

                    <button type="button" 
                            @click="submitPreview()" 
                            class="w-full sm:w-auto py-4 px-6 rounded-xl border border-brand-wood text-brand-wood hover:bg-brand-wood hover:text-white font-semibold text-sm transition flex items-center justify-center gap-2">
                        <i class="fa-regular fa-eye"></i>
                        <span>Simulasi / Preview Data</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Alur Reservasi -->
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
            <div class="p-6 rounded-2xl bg-white border border-brand-sand shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-amber/20 text-brand-wood font-bold mx-auto flex items-center justify-center mb-3">1</div>
                <h4 class="font-serif font-bold text-sm text-brand-dark mb-1">Cek Jadwal Tanggal</h4>
                <p class="text-xs text-brand-muted">Admin memastikan tanggal pilihan Anda belum dipesan pihak lain.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-brand-sand shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-amber/20 text-brand-wood font-bold mx-auto flex items-center justify-center mb-3">2</div>
                <h4 class="font-serif font-bold text-sm text-brand-dark mb-1">Survei Lokasi</h4>
                <p class="text-xs text-brand-muted">Kunjungi langsung Rumah Joglo Omah Ayem untuk merasakan suasana tempat.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-brand-sand shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-amber/20 text-brand-wood font-bold mx-auto flex items-center justify-center mb-3">3</div>
                <h4 class="font-serif font-bold text-sm text-brand-dark mb-1">Lock Tanggal (DP)</h4>
                <p class="text-xs text-brand-muted">Kunci tanggal impian Anda secara resmi dengan uang muka aman.</p>
            </div>
        </div>
    </div>

    <!-- Modal Preview Dummy -->
    <div x-show="submittedModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-cloak>
        <div @click.away="submittedModal = false" 
             class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl border border-brand-sand relative">
            <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <h3 class="font-serif text-2xl font-bold text-center text-brand-dark mb-2">
                Ringkasan Pengajuan Reservasi
            </h3>
            <p class="text-xs text-center text-brand-muted mb-6">
                Berikut data yang siap dikirimkan ke pihak pengelola Rumah Joglo Omah Ayem:
            </p>

            <div class="bg-brand-sand/30 p-4 rounded-xl space-y-2 text-xs text-brand-charcoal mb-6 border border-brand-sand">
                <p><strong>Nama:</strong> <span x-text="name"></span></p>
                <p><strong>WhatsApp:</strong> <span x-text="phone"></span></p>
                <p><strong>Email:</strong> <span x-text="email || '-'"></span></p>
                <p><strong>Tanggal Acara:</strong> <span x-text="eventDate"></span></p>
                <p><strong>Paket Pilihan:</strong> <span x-text="selectedPkg || '-'"></span></p>
                <p><strong>Estimasi Tamu:</strong> <span x-text="guestCount"></span></p>
                <p><strong>Catatan:</strong> <span x-text="notes || '-'"></span></p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button" 
                        @click="submitDirectWA()" 
                        class="flex-1 py-3 px-4 rounded-xl bg-emerald-600 text-white text-xs font-bold hover:bg-emerald-700 transition flex items-center justify-center gap-2">
                    <i class="fa-brands fa-whatsapp text-base"></i>
                    <span>Lanjutkan ke WhatsApp</span>
                </button>
                <button type="button" 
                        @click="submittedModal = false" 
                        class="py-3 px-4 rounded-xl border border-brand-sand text-brand-muted hover:text-brand-dark text-xs font-semibold transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</section>
@endsection

