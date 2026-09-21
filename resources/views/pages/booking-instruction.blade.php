@extends('layouts.app')

@section('title', 'Instruksi Pembayaran DP - ' . $reservation->booking_code)
@section('meta_description', 'Rincian pembayaran Uang Muka (DP) dan rekening resmi Rumah Joglo Omah Ayem.')

@section('content')
<!-- Header Banner -->
<section class="relative bg-brand-dark text-white py-12 lg:py-16 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80" 
             alt="Booking Banner" 
             class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 text-xs uppercase tracking-widest font-bold text-brand-gold bg-brand-wood/70 px-4 py-1.5 rounded-full mb-3 border border-brand-gold/30">
            <i class="fa-solid fa-receipt"></i>
            <span>Instruksi Pembayaran Uang Muka (DP)</span>
        </span>
        <h1 class="font-serif text-2xl sm:text-4xl font-bold text-brand-cream mb-2">
            Pemesanan #{{ $reservation->booking_code }}
        </h1>
        <p class="text-brand-cream/80 text-xs sm:text-sm max-w-lg mx-auto">
            Selesaikan transfer Uang Muka (DP) untuk mengunci jadwal acara Anda secara resmi.
        </p>
    </div>
</section>

<!-- Konten Utama -->
<section class="py-12 bg-brand-cream min-h-[70vh]" x-data="{ copied: false, copyText(text) { navigator.clipboard.writeText(text); this.copied = true; setTimeout(() => this.copied = false, 2500); } }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Flash Message -->
        @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-900 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                <p class="text-xs sm:text-sm font-semibold">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Card Status & Rincian Tagihan -->
        <div class="bg-white rounded-3xl shadow-joglo border border-brand-sand overflow-hidden">
            <div class="p-6 sm:p-8 bg-brand-sand/30 border-b border-brand-sand flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-brand-muted">Status Pengajuan</span>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $reservation->status_badge }}">
                            {{ $reservation->status_label }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $reservation->payment_status_badge }}">
                            {{ $reservation->payment_status_label }}
                        </span>
                    </div>
                </div>

                <div class="text-left sm:text-right">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-brand-muted">Batas Waktu Penguncian</span>
                    <p class="text-xs font-semibold text-brand-dark mt-0.5">
                        Maksimal 24 Jam sejak pengajuan
                    </p>
                </div>
            </div>

            <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-brand-sand">
                <!-- Rincian Pemesan -->
                <div class="space-y-2 text-xs">
                    <h3 class="font-serif text-sm font-bold text-brand-dark border-b border-brand-sand pb-1 mb-3">
                        Rincian Pemesanan
                    </h3>
                    <div class="flex justify-between py-1 border-b border-stone-100">
                        <span class="text-brand-muted">Nama Pemesan:</span>
                        <span class="font-bold text-brand-dark">{{ $reservation->name }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-stone-100">
                        <span class="text-brand-muted">No. WhatsApp:</span>
                        <span class="font-mono font-semibold text-brand-dark">{{ $reservation->phone }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-stone-100">
                        <span class="text-brand-muted">Tanggal Acara:</span>
                        <span class="font-bold text-amber-800">{{ $reservation->event_date ? $reservation->event_date->translatedFormat('l, d F Y') : '-' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-stone-100">
                        <span class="text-brand-muted">Paket Sewa:</span>
                        <span class="font-semibold text-brand-dark">{{ $reservation->package_name }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-brand-muted">Estimasi Tamu:</span>
                        <span class="text-brand-dark">{{ $reservation->guest_count ?: '-' }}</span>
                    </div>
                </div>

                <!-- Rincian Finansial / Nominal DP -->
                <div class="bg-amber-50/70 p-5 rounded-2xl border border-amber-200/80 flex flex-col justify-between space-y-4">
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-amber-800">Rincian Tagihan Biaya</span>
                        <div class="mt-3 space-y-2 text-xs">
                            <div class="flex justify-between text-stone-600">
                                <span>Total Nilai Paket:</span>
                                <span class="font-semibold">{{ $reservation->formatted_package_price }}</span>
                            </div>
                            <div class="flex justify-between text-stone-600">
                                <span>Persentase DP:</span>
                                <span class="font-semibold">{{ $reservation->dp_percentage }}%</span>
                            </div>
                            <div class="flex justify-between text-stone-600">
                                <span>Sisa Pelunasan (H-14):</span>
                                <span class="font-semibold">{{ $reservation->formatted_remaining_amount }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-amber-300/60 flex items-center justify-between">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-900 block">Total Uang Muka (DP)</span>
                            <span class="text-2xl sm:text-3xl font-serif font-bold text-brand-wood block">
                                {{ $reservation->formatted_dp_amount }}
                            </span>
                        </div>
                        <span class="px-2.5 py-1 rounded-lg bg-amber-200 text-amber-900 text-[10px] font-bold uppercase tracking-wider">
                            Wajib Ditransfer
                        </span>
                    </div>
                </div>
            </div>

            <!-- Rekening Tujuan Transfer -->
            <div class="p-6 sm:p-8 bg-stone-50/50 space-y-4">
                <div>
                    <h3 class="font-serif text-base font-bold text-brand-dark">Pilihan Rekening Transfer Resmi</h3>
                    <p class="text-xs text-brand-muted mt-0.5">
                        Mohon transfer sesuai nominal DP di atas ke salah satu nomor rekening pengelola berikut:
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($banks as $bank)
                    <div class="bg-white p-5 rounded-2xl border border-brand-sand shadow-sm space-y-3 relative">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-lg bg-stone-100 text-brand-dark font-black text-xs tracking-wider border border-stone-200">
                                {{ $bank['name'] }}
                            </span>
                            <span class="text-[10px] text-brand-muted">Rekening Resmi</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-brand-muted uppercase font-bold tracking-wider block">Nomor Rekening:</span>
                            <span class="font-mono text-lg font-bold text-brand-dark tracking-wider block">{{ $bank['number'] }}</span>
                            <span class="text-xs text-brand-wood font-medium block mt-0.5">a.n. {{ $bank['holder'] }}</span>
                        </div>
                        <button type="button" 
                                @click="copyText('{{ preg_replace('/[^0-9]/', '', $bank['number']) }}')" 
                                class="w-full py-2 px-3 rounded-xl bg-brand-sand/40 hover:bg-brand-sand text-brand-wood text-xs font-semibold transition flex items-center justify-center gap-2">
                            <i class="fa-regular fa-copy"></i>
                            <span>Salin Nomor Rekening</span>
                        </button>
                    </div>
                    @endforeach
                </div>

                <!-- Toast feedback salin -->
                <div x-show="copied" x-cloak x-transition class="p-2.5 rounded-xl bg-emerald-600 text-white text-xs text-center font-semibold shadow-md">
                    Nomor rekening berhasil disalin ke clipboard!
                </div>

                <p class="text-xs text-stone-500 italic bg-amber-50/60 p-3 rounded-xl border border-amber-200/50">
                    <i class="fa-solid fa-circle-info text-amber-600 mr-1"></i>
                    {{ $instructions }}
                </p>
            </div>
        </div>

        <!-- Section Bukti Pembayaran / Konfirmasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- 1. Form Upload Bukti Transfer -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-joglo border border-brand-sand space-y-4">
                <div>
                    <h3 class="font-serif text-base font-bold text-brand-dark">Upload Bukti Transfer</h3>
                    <p class="text-xs text-brand-muted mt-0.5">Unggah foto atau screenshot resi transfer untuk mempercepat verifikasi.</p>
                </div>

                @if($reservation->payment_proof)
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 space-y-2">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800">
                        <i class="fa-solid fa-circle-check text-emerald-600"></i> Bukti Transfer Telah Diunggah
                    </span>
                    <a href="{{ $reservation->payment_proof_url }}" target="_blank" class="block aspect-video rounded-xl overflow-hidden border border-emerald-300">
                        <img src="{{ $reservation->payment_proof_url }}" alt="Bukti Transfer" class="w-full h-full object-cover">
                    </a>
                    <p class="text-[11px] text-stone-600">Tim kami sedang memverifikasi pembayaran Anda.</p>
                </div>
                @endif

                <form action="{{ route('booking.upload-proof', ['booking_code' => $reservation->booking_code]) }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="space-y-4 text-xs">
                    @csrf
                    <div>
                        <label class="block font-bold uppercase tracking-wider text-brand-dark mb-1.5">
                            Pilih File Struk / Bukti Transfer (JPG, PNG, Maks 5MB)
                        </label>
                        <input type="file" 
                               name="payment_proof" 
                               required 
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="w-full px-3 py-2 border border-brand-sand rounded-xl bg-brand-cream/50 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-wood file:text-white hover:file:bg-brand-dark cursor-pointer">
                    </div>

                    <div>
                        <label class="block font-bold uppercase tracking-wider text-brand-dark mb-1.5">
                            Metode Transfer yang Digunakan
                        </label>
                        <select name="payment_method" class="w-full px-3 py-2 rounded-xl border border-brand-sand bg-white text-xs">
                            <option value="BCA Transfer">Bank BCA</option>
                            <option value="Mandiri Transfer">Bank Mandiri</option>
                            <option value="Bank Lain / ATM Bersama">Bank Lain / ATM Bersama</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl bg-brand-wood hover:bg-brand-dark text-white font-bold transition shadow-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span>Unggah Bukti Pembayaran</span>
                    </button>
                </form>
            </div>

            <!-- 2. Konfirmasi Instan via WhatsApp Admin -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-joglo border border-brand-sand flex flex-col justify-between space-y-4">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mb-3">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h3 class="font-serif text-base font-bold text-brand-dark">Konfirmasi via WhatsApp Resmi</h3>
                    <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                        Kirimkan resi transfer langsung ke CS WhatsApp kami untuk validasi instan dan penjadwalan survei lokasi bersama tim pengelola.
                    </p>
                </div>

                <div class="space-y-3 pt-4">
                    <a href="{{ $reservation->customer_confirm_whats_app_url }}" 
                       target="_blank" 
                       class="w-full py-3.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm transition shadow-md flex items-center justify-center gap-2 text-center">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span>Kirim Bukti Transfer ke Admin</span>
                    </a>

                    <a href="{{ route('home') }}" class="w-full py-2.5 px-4 rounded-xl border border-brand-sand text-brand-muted hover:text-brand-dark text-xs font-semibold transition text-center block">
                        Kembali ke Halaman Beranda
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

