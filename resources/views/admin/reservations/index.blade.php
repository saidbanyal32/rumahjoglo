@extends('admin.layouts.app')

@section('title', 'Manajemen Reservasi')
@section('page_title', 'Daftar Reservasi & Jadwal Booking')
@section('page_subtitle', 'Pantau pengajuan tanggal, verifikasi ketersediaan jadwal, dan komunikasikan via WhatsApp')

@section('content')
<div class="space-y-6" x-data="{
    detailModal: false,
    statusModal: false,
    selectedReservation: null,
    
    openDetail(item) {
        this.selectedReservation = item;
        this.detailModal = true;
    },
    openStatus(item) {
        this.selectedReservation = item;
        this.statusModal = true;
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
                <span>Pending / Menunggu</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'pending' ? 'bg-amber-800 text-amber-200' : 'bg-amber-200 text-amber-900' }}">
                    {{ $counts['pending'] }}
                </span>
            </a>

            <a href="{{ route('admin.reservations.index', ['status' => 'confirmed', 'search' => $search]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 {{ $status === 'confirmed' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100 border border-emerald-200' }}">
                <span>Disetujui (Confirmed)</span>
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
                   placeholder="Cari nama, WhatsApp, paket..."
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
                        <th class="py-4 px-6">Pemesan</th>
                        <th class="py-4 px-6">Kontak WhatsApp</th>
                        <th class="py-4 px-6">Tanggal Acara</th>
                        <th class="py-4 px-6">Paket / Estimasi Tamu</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-stone-700">
                    @foreach($reservations as $res)
                    <tr class="hover:bg-stone-50/50 transition">
                        <!-- Nama & Email -->
                        <td class="py-4 px-6">
                            <span class="font-bold text-stone-900 block text-sm">{{ $res->name }}</span>
                            <span class="text-[11px] text-stone-600">{{ $res->email ?: 'Email tidak dicantumkan' }}</span>
                            @if($res->notes)
                            <span class="inline-flex items-center gap-1 text-[10px] text-amber-700 font-semibold mt-1">
                                <i class="fa-solid fa-note-sticky text-[9px]"></i> Memiliki catatan khusus
                            </span>
                            @endif
                        </td>

                        <!-- WhatsApp -->
                        <td class="py-4 px-6">
                            <span class="font-mono font-medium text-stone-800 block">{{ $res->phone }}</span>
                            <a href="{{ $res->whats_app_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-[11px] text-emerald-700 font-bold hover:text-emerald-800 mt-0.5">
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>Kirim Konfirmasi WA</span>
                            </a>
                        </td>

                        <!-- Tanggal Acara -->
                        <td class="py-4 px-6">
                            <span class="font-semibold text-stone-900 block">
                                {{ $res->event_date ? $res->event_date->translatedFormat('d F Y') : '-' }}
                            </span>
                            <span class="text-[10px] text-stone-600">
                                {{ $res->event_date ? $res->event_date->diffForHumans() : '' }}
                            </span>
                        </td>

                        <!-- Pilihan Paket -->
                        <td class="py-4 px-6">
                            <span class="font-medium text-stone-900 block">{{ $res->package_name }}</span>
                            <span class="text-[11px] text-stone-600">{{ $res->guest_count ?: 'Tamu tidak diisi' }}</span>
                        </td>

                        <!-- Status Badge & Quick Change -->
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold border {{ $res->status_badge }}">
                                    {{ $res->status_label }}
                                </span>
                                <button type="button" 
                                        @click="openStatus({{ json_encode($res) }})" 
                                        title="Ubah Status" 
                                        class="p-1 text-stone-400 hover:text-amber-600 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </div>
                        </td>

                        <!-- Action Buttons -->
                        <td class="py-4 px-6 text-right">
                            <div class="inline-flex items-center gap-1.5 justify-end">
                                <!-- View Detail Modal Trigger -->
                                <button type="button" 
                                        @click="openDetail({{ json_encode($res) }})"
                                        title="Lihat Detail Lengkap" 
                                        class="px-2.5 py-1.5 rounded-xl bg-stone-100 text-stone-700 hover:bg-stone-200 transition font-medium text-xs flex items-center gap-1.5">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>Detail</span>
                                </button>

                                <!-- Direct WhatsApp Link -->
                                <a href="{{ $res->whats_app_url }}" 
                                   target="_blank" 
                                   title="Buka Chat WhatsApp Resmi" 
                                   class="px-2.5 py-1.5 rounded-xl bg-emerald-600 text-white hover:bg-emerald-500 transition font-medium text-xs flex items-center gap-1.5 shadow-sm">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                    <span>Chat WA</span>
                                </a>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.reservations.destroy', $res->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data reservasi dari {{ $res->name }}?');"
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
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="detailModal = false" 
             class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-stone-200 relative max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-4 border-b border-stone-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-stone-900">Detail Reservasi Venue</h3>
                        <p class="text-xs text-stone-600">ID Registrasi: #<span x-text="selectedReservation ? selectedReservation.id : ''"></span></p>
                    </div>
                </div>
                <button @click="detailModal = false" class="p-2 text-stone-400 hover:text-stone-700 transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="py-5 space-y-4 text-xs" x-if="selectedReservation">
                <div class="grid grid-cols-2 gap-4 bg-stone-50 p-4 rounded-2xl border border-stone-200/60">
                    <div>
                        <span class="text-stone-600 uppercase tracking-wider font-semibold block text-[10px]">Nama Pemesan</span>
                        <span class="text-stone-900 font-bold text-sm block mt-0.5" x-text="selectedReservation.name"></span>
                    </div>
                    <div>
                        <span class="text-stone-600 uppercase tracking-wider font-semibold block text-[10px]">Kontak WhatsApp</span>
                        <span class="text-stone-900 font-mono font-bold block mt-0.5" x-text="selectedReservation.phone"></span>
                    </div>
                    <div>
                        <span class="text-stone-600 uppercase tracking-wider font-semibold block text-[10px]">Email Pemesan</span>
                        <span class="text-stone-900 font-medium block mt-0.5" x-text="selectedReservation.email || '-'"></span>
                    </div>
                    <div>
                        <span class="text-stone-600 uppercase tracking-wider font-semibold block text-[10px]">Tanggal Rencana</span>
                        <span class="text-amber-800 font-bold block mt-0.5" x-text="selectedReservation.event_date ? selectedReservation.event_date.substring(0, 10) : '-'"></span>
                    </div>
                </div>

                <div class="bg-stone-50 p-4 rounded-2xl border border-stone-200/60 space-y-2">
                    <div>
                        <span class="text-stone-600 uppercase tracking-wider font-semibold block text-[10px]">Pilihan Paket Sewa</span>
                        <span class="text-stone-900 font-bold text-sm block" x-text="selectedReservation.package_name"></span>
                    </div>
                    <div>
                        <span class="text-stone-600 uppercase tracking-wider font-semibold block text-[10px]">Estimasi Jumlah Tamu</span>
                        <span class="text-stone-800 font-medium block" x-text="selectedReservation.guest_count || '-'"></span>
                    </div>
                </div>

                <!-- Catatan Khusus -->
                <div>
                    <span class="text-stone-600 uppercase tracking-wider font-semibold block text-[10px] mb-1">Catatan Khusus dari Pemesan</span>
                    <div class="p-3 bg-amber-50/70 border border-amber-200/80 rounded-xl text-stone-800 italic" x-text="selectedReservation.notes || 'Tidak ada catatan khusus dari pemesan.'"></div>
                </div>

                <!-- Catatan Internal Admin -->
                <div>
                    <span class="text-stone-600 uppercase tracking-wider font-semibold block text-[10px] mb-1">Catatan Internal Pengelola / Admin</span>
                    <div class="p-3 bg-stone-100 border border-stone-200 rounded-xl text-stone-800" x-text="selectedReservation.admin_notes || 'Belum ada catatan internal.'"></div>
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
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
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
                        Status Saat Ini & Pembaruan
                    </label>
                    <select name="status" 
                            x-model="selectedReservation ? selectedReservation.status : 'pending'"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-xs font-semibold bg-white">
                        <option value="pending">Menunggu Konfirmasi (Pending)</option>
                        <option value="confirmed">Disetujui / Terkonfirmasi (Confirmed)</option>
                        <option value="completed">Selesai Dilaksanakan (Completed)</option>
                        <option value="cancelled">Dibatalkan (Cancelled)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold uppercase tracking-wider text-stone-600 mb-1.5">
                        Catatan Internal Pengelola (Opsional)
                    </label>
                    <textarea name="admin_notes" 
                              rows="3" 
                              x-model="selectedReservation ? selectedReservation.admin_notes : ''"
                              placeholder="Misal: Sudah bayar DP 30%, janji survei hari Sabtu jam 14.00, dsb."
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

</div>
@endsection

