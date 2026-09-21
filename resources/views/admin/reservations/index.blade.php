@extends('admin.layouts.app')

@section('title', 'Manajemen Reservasi')
@section('page_title', 'Daftar Reservasi & Verifikasi DP')
@section('page_subtitle', 'Pantau pengajuan tanggal, verifikasi bukti transfer uang muka (DP), dan kirim konfirmasi resmi')

@section('content')
<div class="space-y-6" x-data="{
    detailModal: false,
    statusModal: false,
    proofModal: false,
    activeProofUrl: '',
    selectedReservation: null,
    
    openDetail(item) {
        this.selectedReservation = item;
        this.detailModal = true;
    },
    openStatus(item) {
        this.selectedReservation = item;
        this.statusModal = true;
    },
    openProof(url) {
        this.activeProofUrl = url;
        this.proofModal = true;
    }
}">

    <!-- 1. FILTER TABS & SEARCH BAR -->
    <div class="bg-white p-4 sm:p-6 rounded-3xl border border-stone-200/80 shadow-sm flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
        
        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.reservations.index', ['status' => 'all', 'search' => $search]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $status === 'all' ? 'bg-stone-900 text-white shadow-sm' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                <span>Semua</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'all' ? 'bg-stone-700 text-stone-200' : 'bg-stone-200 text-stone-700' }}">
                    {{ $counts['all'] }}
                </span>
            </a>

            <a href="{{ route('admin.reservations.index', ['status' => 'pending', 'search' => $search]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $status === 'pending' ? 'bg-amber-600 text-white shadow-sm' : 'bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200' }}">
                <span>Menunggu DP</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'pending' ? 'bg-amber-800 text-amber-200' : 'bg-amber-200 text-amber-900' }}">
                    {{ $counts['pending'] }}
                </span>
            </a>

            <a href="{{ route('admin.reservations.index', ['status' => 'confirmed', 'search' => $search]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $status === 'confirmed' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100 border border-emerald-200' }}">
                <span>DP Lunas / Terkunci</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'confirmed' ? 'bg-emerald-800 text-emerald-200' : 'bg-emerald-200 text-emerald-900' }}">
                    {{ $counts['confirmed'] }}
                </span>
            </a>

            <a href="{{ route('admin.reservations.index', ['status' => 'completed', 'search' => $search]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $status === 'completed' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50 text-blue-800 hover:bg-blue-100 border border-blue-200' }}">
                <span>Selesai</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'completed' ? 'bg-blue-800 text-blue-200' : 'bg-blue-200 text-blue-900' }}">
                    {{ $counts['completed'] }}
                </span>
            </a>

            <a href="{{ route('admin.reservations.index', ['status' => 'cancelled', 'search' => $search]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $status === 'cancelled' ? 'bg-rose-600 text-white shadow-sm' : 'bg-rose-50 text-rose-800 hover:bg-rose-100 border border-rose-200' }}">
                <span>Dibatalkan</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'cancelled' ? 'bg-rose-800 text-rose-200' : 'bg-rose-200 text-rose-900' }}">
                    {{ $counts['cancelled'] }}
                </span>
            </a>
        </div>

        <!-- Search input form -->
        <form action="{{ route('admin.reservations.index') }}" method="GET" class="w-full lg:w-72 relative">
            <input type="hidden" name="status" value="{{ $status }}">
            <input type="text" 
                   name="search" 
                   value="{{ $search }}"
                   placeholder="Cari kode booking, nama, WA..."
                   class="w-full pl-9 pr-4 py-2 rounded-xl bg-stone-50 border border-stone-200 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-xs transition">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-stone-400 text-xs"></i>
            @if($search)
            <a href="{{ route('admin.reservations.index', ['status' => $status]) }}" class="absolute right-3 top-2.5 text-stone-400 hover:text-stone-600 text-xs">
                <i class="fa-solid fa-xmark"></i>
            </a>
            @endif
        </form>
    </div>

    <!-- 2. DATA TABLE -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        @if($reservations->isEmpty())
        <div class="p-16 text-center">
            <div class="w-16 h-16 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center mx-auto mb-3 text-2xl">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <h4 class="font-serif font-bold text-stone-800 text-base">Tidak Ada Data Reservasi</h4>
            <p class="text-xs text-stone-600 mt-1 max-w-sm mx-auto">
                @if($search)
                Pencarian "{{ $search }}" tidak menemukan hasil pada status "{{ $status }}".
                @else
                Belum ada reservasi pada kategori status ini.
                @endif
            </p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-200 text-[11px] uppercase tracking-wider font-bold text-stone-500">
                        <th class="py-4 px-6">Pemesan & Kode</th>
                        <th class="py-4 px-6">Kontak WhatsApp</th>
                        <th class="py-4 px-6">Tanggal Acara</th>
                        <th class="py-4 px-6">Paket Sewa</th>
                        <th class="py-4 px-6">Rincian DP & Bukti</th>
                        <th class="py-4 px-6">Status Acara</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-stone-700">
                    @foreach($reservations as $res)
                    <tr class="hover:bg-stone-50/50 transition">
                        <!-- Nama & Kode Booking -->
                        <td class="py-4 px-6">
                            <span class="font-bold text-stone-900 block text-sm">{{ $res->name }}</span>
                            <span class="font-mono text-[11px] text-amber-700 font-semibold block">#{{ $res->booking_code }}</span>
                            @if($res->notes)
                            <span class="inline-flex items-center gap-1 text-[10px] text-stone-500 mt-0.5">
                                <i class="fa-solid fa-note-sticky text-[9px]"></i> Ada catatan khusus
                            </span>
                            @endif
                        </td>

                        <!-- WhatsApp -->
                        <td class="py-4 px-6">
                            <span class="font-mono font-medium text-stone-800 block">{{ $res->phone }}</span>
                            <a href="{{ $res->whats_app_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-[11px] text-emerald-700 font-bold hover:text-emerald-800 mt-0.5">
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>Hubungi WA</span>
                            </a>
                        </td>

                        <!-- Tanggal Acara -->
                        <td class="py-4 px-6">
                            <span class="font-semibold text-stone-900 block">
                                {{ $res->event_date ? $res->event_date->translatedFormat('d F Y') : '-' }}
                            </span>
                            <span class="text-[10px] text-stone-500">
                                {{ $res->event_date ? $res->event_date->diffForHumans() : '' }}
                            </span>
                        </td>

                        <!-- Pilihan Paket -->
                        <td class="py-4 px-6">
                            <span class="font-medium text-stone-900 block">{{ $res->package_name }}</span>
                            <span class="text-[10px] text-stone-500">{{ $res->guest_count ?: '-' }}</span>
                        </td>

                        <!-- Rincian DP & Bukti Pembayaran -->
                        <td class="py-4 px-6">
                            <span class="font-serif font-bold text-stone-900 block">{{ $res->formatted_dp_amount }}</span>
                            <div class="flex items-center gap-1.5 mt-1">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold border {{ $res->payment_status_badge }}">
                                    {{ $res->payment_status_label }}
                                </span>
                                @if($res->payment_proof)
                                <button type="button" 
                                        @click="openProof('{{ $res->payment_proof_url }}')" 
                                        class="text-[11px] font-bold text-emerald-700 hover:text-emerald-800 inline-flex items-center gap-1 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200"
                                        title="Lihat Bukti Transfer">
                                    <i class="fa-solid fa-receipt"></i>
                                    <span>Bukti</span>
                                </button>
                                @endif
                            </div>
                        </td>

                        <!-- Status Badge & Quick Change -->
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-1.5">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold border {{ $res->status_badge }}">
                                    {{ $res->status_label }}
                                </span>
                                <button type="button" 
                                        @click="openStatus({{ json_encode($res) }})" 
                                        title="Ubah Status Manual" 
                                        class="p-1 text-stone-400 hover:text-amber-600 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </div>
                        </td>

                        <!-- Action Buttons -->
                        <td class="py-4 px-6 text-right">
                            <div class="inline-flex items-center gap-1.5 justify-end">
                                <!-- Tombol Verifikasi DP Cepat -->
                                @if($res->status !== 'confirmed' && $res->status !== 'completed')
                                <form action="{{ route('admin.reservations.confirm-payment', $res->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Konfirmasi pembayaran DP untuk {{ $res->name }}? Status akan diubah menjadi Terkonfirmasi dan notifikasi WA resmi akan otomatis terkirim.');"
                                      class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="px-2.5 py-1.5 rounded-xl bg-emerald-600 text-white hover:bg-emerald-500 font-bold text-xs transition flex items-center gap-1 shadow-sm" 
                                            title="Verifikasi Pembayaran DP & Kunci Tanggal">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Konfirmasi DP</span>
                                    </button>
                                </form>
                                @endif

                                <!-- View Detail Modal Trigger -->
                                <button type="button" 
                                        @click="openDetail({{ json_encode($res) }})"
                                        title="Lihat Detail Lengkap" 
                                        class="px-2.5 py-1.5 rounded-xl bg-stone-100 text-stone-700 hover:bg-stone-200 transition font-medium text-xs flex items-center gap-1">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>Detail</span>
                                </button>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.reservations.destroy', $res->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Hapus data reservasi {{ $res->name }}?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Data" class="p-2 text-stone-400 hover:text-rose-600 transition rounded-lg hover:bg-rose-50">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="p-4 border-t border-stone-100">
            {{ $reservations->links() }}
        </div>
        @endif
    </div>

    <!-- 3. MODAL DETAIL RESERVASI -->
    <div x-show="detailModal" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition>
        
        <div @click.away="detailModal = false" 
             class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-stone-200 relative max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-4 border-b border-stone-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-stone-900">Detail Reservasi & Pembayaran</h3>
                        <p class="text-xs text-amber-800 font-mono font-bold">Kode: #<span x-text="selectedReservation ? selectedReservation.booking_code : ''"></span></p>
                    </div>
                </div>
                <button @click="detailModal = false" class="p-2 text-stone-400 hover:text-stone-700 transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="py-5 space-y-4 text-xs" x-if="selectedReservation">
                <!-- Rincian Pemesan -->
                <div class="grid grid-cols-2 gap-4 bg-stone-50 p-4 rounded-2xl border border-stone-200/60">
                    <div>
                        <span class="text-stone-500 uppercase tracking-wider font-semibold block text-[10px]">Nama Pemesan</span>
                        <span class="text-stone-900 font-bold text-sm block mt-0.5" x-text="selectedReservation.name"></span>
                    </div>
                    <div>
                        <span class="text-stone-500 uppercase tracking-wider font-semibold block text-[10px]">Kontak WhatsApp</span>
                        <span class="text-stone-900 font-mono font-bold block mt-0.5" x-text="selectedReservation.phone"></span>
                    </div>
                    <div>
                        <span class="text-stone-500 uppercase tracking-wider font-semibold block text-[10px]">Email</span>
                        <span class="text-stone-900 font-medium block mt-0.5" x-text="selectedReservation.email || '-'"></span>
                    </div>
                    <div>
                        <span class="text-stone-500 uppercase tracking-wider font-semibold block text-[10px]">Tanggal Acara</span>
                        <span class="text-amber-800 font-bold block mt-0.5" x-text="selectedReservation.event_date ? selectedReservation.event_date.substring(0, 10) : '-'"></span>
                    </div>
                </div>

                <!-- Rincian Finansial / DP -->
                <div class="bg-amber-50/70 p-4 rounded-2xl border border-amber-200 space-y-2">
                    <span class="text-amber-900 font-bold uppercase tracking-wider block text-[10px]">Rincian Finansial & DP</span>
                    <div class="grid grid-cols-3 gap-2 text-center pt-1">
                        <div class="bg-white p-2.5 rounded-xl border border-amber-200">
                            <span class="text-[10px] text-stone-500 block">Total Paket</span>
                            <span class="font-bold text-stone-900 block mt-0.5" x-text="'Rp ' + Number(selectedReservation.package_price || 0).toLocaleString('id-ID')"></span>
                        </div>
                        <div class="bg-white p-2.5 rounded-xl border-2 border-emerald-500">
                            <span class="text-[10px] text-emerald-800 font-bold block">Nominal DP</span>
                            <span class="font-bold text-emerald-700 block mt-0.5" x-text="'Rp ' + Number(selectedReservation.dp_amount || 0).toLocaleString('id-ID')"></span>
                        </div>
                        <div class="bg-white p-2.5 rounded-xl border border-amber-200">
                            <span class="text-[10px] text-stone-500 block">Sisa Pelunasan</span>
                            <span class="font-bold text-stone-900 block mt-0.5" x-text="'Rp ' + Number(selectedReservation.remaining_amount || 0).toLocaleString('id-ID')"></span>
                        </div>
                    </div>
                </div>

                <!-- Catatan Pemesan & Admin -->
                <div class="space-y-3">
                    <div>
                        <span class="text-stone-500 uppercase tracking-wider font-semibold block text-[10px] mb-1">Catatan Khusus Pemesan</span>
                        <div class="p-3 bg-stone-100 rounded-xl text-stone-800 italic" x-text="selectedReservation.notes || 'Tidak ada catatan khusus.'"></div>
                    </div>
                    <div>
                        <span class="text-stone-500 uppercase tracking-wider font-semibold block text-[10px] mb-1">Catatan Internal Pengelola / Admin</span>
                        <div class="p-3 bg-stone-100 rounded-xl text-stone-800" x-text="selectedReservation.admin_notes || 'Belum ada catatan internal.'"></div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-stone-200 flex items-center justify-between gap-3">
                <button type="button" 
                        @click="detailModal = false; openStatus(selectedReservation)" 
                        class="px-4 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-bold text-xs transition flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Ubah Status & Catatan</span>
                </button>

                <button type="button" 
                        @click="detailModal = false" 
                        class="px-4 py-2.5 rounded-xl border border-stone-300 text-stone-600 hover:bg-stone-100 font-semibold text-xs transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- 4. MODAL UBAH STATUS RESERVASI -->
    <div x-show="statusModal" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition>
        
        <div @click.away="statusModal = false" 
             class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-stone-200 relative">
            
            <div class="flex items-center justify-between pb-4 border-b border-stone-200">
                <h3 class="font-serif text-lg font-bold text-stone-900">Ubah Status Reservasi</h3>
                <button @click="statusModal = false" class="p-1.5 text-stone-400 hover:text-stone-700 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form :action="selectedReservation ? `/admin/reservations/${selectedReservation.id}/status` : '#'" 
                  method="POST" 
                  class="py-4 space-y-4 text-xs">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block font-semibold uppercase tracking-wider text-stone-600 mb-1.5">
                        Status Acara
                    </label>
                    <select name="status" 
                            x-model="selectedReservation ? selectedReservation.status : 'pending_payment'"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-xs font-semibold bg-white">
                        <option value="pending_payment">Menunggu Pembayaran DP (Pending Payment)</option>
                        <option value="confirmed">Disetujui / Terkonfirmasi (DP Diterima)</option>
                        <option value="completed">Selesai Dilaksanakan (Completed)</option>
                        <option value="cancelled">Dibatalkan (Cancelled)</option>
                    </select>
                    <p class="text-[10px] text-stone-500 mt-1">Mengubah ke 'Disetujui / Terkonfirmasi' akan otomatis mengunci tanggal dan mengirim konfirmasi resmi WA ke pemesan.</p>
                </div>

                <div>
                    <label class="block font-semibold uppercase tracking-wider text-stone-600 mb-1.5">
                        Catatan Internal Pengelola
                    </label>
                    <textarea name="admin_notes" 
                              rows="3" 
                              x-model="selectedReservation ? selectedReservation.admin_notes : ''"
                              placeholder="Misal: DP 30% via BCA terverifikasi, janji survei hari Sabtu, dsb."
                              class="w-full px-3.5 py-2 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-xs"></textarea>
                </div>

                <div class="pt-3 flex items-center justify-end gap-2">
                    <button type="button" 
                            @click="statusModal = false" 
                            class="px-4 py-2 rounded-xl border border-stone-300 text-stone-600 hover:bg-stone-100 font-semibold">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-bold transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 5. MODAL LIGHTBOX BUKTI TRANSFER -->
    <div x-show="proofModal" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
         x-transition>
        <div @click.away="proofModal = false" class="max-w-2xl w-full bg-stone-900 rounded-3xl overflow-hidden shadow-2xl border border-stone-800 relative">
            <div class="p-4 border-b border-stone-800 flex items-center justify-between text-white">
                <h4 class="font-serif font-bold text-sm">Bukti Transfer Pembayaran</h4>
                <button @click="proofModal = false" class="p-1.5 text-stone-400 hover:text-white">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-4 flex items-center justify-center max-h-[75vh] overflow-hidden bg-stone-950">
                <img :src="activeProofUrl" alt="Bukti Transfer" class="max-h-[70vh] object-contain rounded-xl">
            </div>
            <div class="p-4 border-t border-stone-800 flex justify-end">
                <a :href="activeProofUrl" target="_blank" download class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-white text-xs font-bold transition flex items-center gap-2">
                    <i class="fa-solid fa-download"></i>
                    <span>Buka File Asli</span>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
