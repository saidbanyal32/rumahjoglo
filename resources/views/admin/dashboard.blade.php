@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')
@section('page_title', 'Ringkasan Aktivitas Venue')
@section('page_subtitle', 'Pantau arus reservasi masuk, status persetujuan jadwal, dan koleksi galeri')

@section('content')
<div class="space-y-8">

    <!-- 1. STATISTIC CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        <!-- Total Reservasi -->
        <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-stone-600">Total Reservasi</p>
                <h3 class="text-3xl font-serif font-bold text-stone-900 mt-1">{{ $totalReservations }}</h3>
                <p class="text-[11px] text-stone-600 mt-1">Semua inquiry yang pernah masuk</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-stone-100 text-stone-800 flex items-center justify-center text-xl">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>

        <!-- Reservasi Pending -->
        <div class="bg-white p-6 rounded-3xl border border-amber-200/80 shadow-sm flex items-center justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-2 h-full bg-amber-500"></div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-amber-700">Perlu Konfirmasi</p>
                <h3 class="text-3xl font-serif font-bold text-amber-900 mt-1">{{ $pendingReservations }}</h3>
                <p class="text-[11px] text-amber-700 font-medium mt-1">Menunggu respons admin</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>

        <!-- Reservasi Disetujui -->
        <div class="bg-white p-6 rounded-3xl border border-emerald-200/80 shadow-sm flex items-center justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-2 h-full bg-emerald-500"></div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-700">Disetujui / Terjadwal</p>
                <h3 class="text-3xl font-serif font-bold text-emerald-900 mt-1">{{ $confirmedReservations }}</h3>
                <p class="text-[11px] text-emerald-700 font-medium mt-1">Tanggal telah dikunci</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>

        <!-- Koleksi Galeri -->
        <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-stone-600">Aset Foto Galeri</p>
                <h3 class="text-3xl font-serif font-bold text-stone-900 mt-1">{{ $totalGalleries }}</h3>
                <p class="text-[11px] text-stone-600 mt-1">Foto aktif di website</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-photo-film"></i>
            </div>
        </div>
    </div>

    <!-- 2. QUICK ACTIONS BANNER -->
    <div class="bg-gradient-to-r from-stone-900 via-stone-800 to-amber-950 p-6 sm:p-8 rounded-3xl text-white shadow-md flex flex-col md:flex-row items-start md:items-center justify-between gap-6 border border-stone-700/50">
        <div>
            <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-xs font-bold uppercase tracking-wider">Aksi Cepat</span>
            <h3 class="font-serif text-2xl font-bold text-white mt-2">Kelola & Siapkan Jadwal Acara</h3>
            <p class="text-xs sm:text-sm text-stone-300 mt-1 max-w-xl">
                Gunakan fitur chat WhatsApp langsung untuk merespons calon mempelai atau keluarga yang baru saja mengajukan reservasi.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.reservations.index', ['status' => 'pending']) }}" class="px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-stone-950 font-bold text-xs transition flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-list-check"></i>
                <span>Tinjau Pending ({{ $pendingReservations }})</span>
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="px-4 py-2.5 rounded-xl bg-stone-700/60 hover:bg-stone-700 text-white font-semibold text-xs transition border border-stone-600 flex items-center gap-2">
                <i class="fa-solid fa-upload"></i>
                <span>Upload Foto Galeri</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="px-4 py-2.5 rounded-xl bg-stone-700/60 hover:bg-stone-700 text-white font-semibold text-xs transition border border-stone-600 flex items-center gap-2">
                <i class="fa-solid fa-gear"></i>
                <span>Pengaturan Web</span>
            </a>
        </div>
    </div>

    <!-- 3. TABEL 5 RESERVASI TERBARU -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-stone-200/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-serif text-xl font-bold text-stone-900">5 Reservasi Terbaru Masuk</h3>
                <p class="text-xs text-stone-600 mt-0.5">Daftar permohonan reservasi paling akhir dari calon penyewa</p>
            </div>
            <a href="{{ route('admin.reservations.index') }}" class="text-xs font-bold text-amber-700 hover:text-amber-800 flex items-center gap-1.5 transition">
                <span>Lihat Semua Reservasi</span>
                <i class="fa-solid fa-arrow-right text-[11px]"></i>
            </a>
        </div>

        @if($latestReservations->isEmpty())
        <div class="p-12 text-center">
            <div class="w-16 h-16 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center mx-auto mb-3 text-2xl">
                <i class="fa-regular fa-folder-open"></i>
            </div>
            <p class="text-sm font-semibold text-stone-700">Belum Ada Reservasi Masuk</p>
            <p class="text-xs text-stone-600 mt-1">Data pemesanan dari form website akan otomatis muncul di sini.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-200 text-[11px] uppercase tracking-wider font-bold text-stone-500">
                        <th class="py-4 px-6">Nama Pemesan</th>
                        <th class="py-4 px-6">Kontak / WhatsApp</th>
                        <th class="py-4 px-6">Tanggal Rencana</th>
                        <th class="py-4 px-6">Pilihan Paket</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-stone-700">
                    @foreach($latestReservations as $res)
                    <tr class="hover:bg-stone-50/50 transition">
                        <!-- Nama & Email -->
                        <td class="py-4 px-6">
                            <span class="font-bold text-stone-900 block text-sm">{{ $res->name }}</span>
                            <span class="text-[11px] text-stone-600">{{ $res->email ?: 'Tanpa email' }}</span>
                        </td>

                        <!-- Kontak -->
                        <td class="py-4 px-6">
                            <span class="font-mono font-medium text-stone-800">{{ $res->phone }}</span>
                        </td>

                        <!-- Tanggal Acara -->
                        <td class="py-4 px-6">
                            <span class="font-semibold text-stone-900 block">
                                {{ $res->event_date ? $res->event_date->translatedFormat('d M Y') : '-' }}
                            </span>
                            <span class="text-[10px] text-stone-600">{{ $res->event_date ? $res->event_date->diffForHumans() : '' }}</span>
                        </td>

                        <!-- Paket & Tamu -->
                        <td class="py-4 px-6">
                            <span class="font-medium text-stone-800 block">{{ $res->package_name }}</span>
                            <span class="text-[10px] text-stone-600">{{ $res->guest_count ?: 'Estimasi tamu tidak disebut' }}</span>
                        </td>

                        <!-- Status -->
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold border {{ $res->status_badge }}">
                                {{ $res->status_label }}
                            </span>
                        </td>

                        <!-- Aksi Cepat: WhatsApp & Detail -->
                        <td class="py-4 px-6 text-right">
                            <div class="inline-flex items-center gap-2 justify-end">
                                <a href="{{ $res->whats_app_url }}" 
                                   target="_blank" 
                                   title="Buka Chat WhatsApp Resmi" 
                                   class="p-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white transition border border-emerald-200">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                </a>
                                <a href="{{ route('admin.reservations.index', ['search' => $res->name]) }}" 
                                   title="Lihat Detail di Manajemen Reservasi" 
                                   class="p-2 rounded-xl bg-stone-100 text-stone-600 hover:bg-stone-800 hover:text-white transition border border-stone-200">
                                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>
@endsection

