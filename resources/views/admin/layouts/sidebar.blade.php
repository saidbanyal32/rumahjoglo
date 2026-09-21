@php
    $pendingCount = \App\Models\Reservation::where('status', 'pending')->count();
@endphp

<div class="h-full flex flex-col justify-between bg-stone-900 text-stone-200 border-r border-stone-800">
    <!-- Brand / Header -->
    <div>
        <div class="h-20 flex items-center justify-between px-6 border-b border-stone-800/80 bg-stone-950/40">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-600 to-amber-700 text-white flex items-center justify-center shadow-lg shadow-amber-900/30 group-hover:scale-105 transition transform">
                    <i class="fa-solid fa-hotel text-lg"></i>
                </div>
                <div>
                    <h1 class="font-serif font-bold text-base text-white tracking-wide leading-tight">OMAH AYEM</h1>
                    <p class="text-[10px] text-amber-400 font-semibold tracking-widest uppercase">Admin Panel</p>
                </div>
            </a>
            <!-- Mobile Close Button -->
            <button @click="sidebarOpen = false" class="lg:hidden text-stone-400 hover:text-white p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="px-4 py-6 space-y-1.5">
            <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2">Menu Utama</p>

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-600/20 text-amber-400 border border-amber-500/30 shadow-sm' : 'text-stone-300 hover:bg-stone-800/70 hover:text-white' }}">
                <i class="fa-solid fa-chart-pie w-5 text-center {{ request()->routeIs('admin.dashboard') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                <span>Dashboard Overview</span>
            </a>

            <!-- Reservasi -->
            <a href="{{ route('admin.reservations.index') }}" 
               class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.reservations.*') ? 'bg-amber-600/20 text-amber-400 border border-amber-500/30 shadow-sm' : 'text-stone-300 hover:bg-stone-800/70 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-calendar-check w-5 text-center {{ request()->routeIs('admin.reservations.*') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                    <span>Manajemen Reservasi</span>
                </div>
                @if($pendingCount > 0)
                <span class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-amber-500 text-stone-950 animate-pulse">
                    {{ $pendingCount }}
                </span>
                @endif
            </a>

            <!-- Galeri Foto -->
            <a href="{{ route('admin.gallery.index') }}" 
               class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.gallery.*') ? 'bg-amber-600/20 text-amber-400 border border-amber-500/30 shadow-sm' : 'text-stone-300 hover:bg-stone-800/70 hover:text-white' }}">
                <i class="fa-solid fa-images w-5 text-center {{ request()->routeIs('admin.gallery.*') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                <span>Manajemen Galeri</span>
            </a>

            <div class="pt-4">
                <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2">Konfigurasi</p>
                
                <!-- Pengaturan Web -->
                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.settings.*') ? 'bg-amber-600/20 text-amber-400 border border-amber-500/30 shadow-sm' : 'text-stone-300 hover:bg-stone-800/70 hover:text-white' }}">
                    <i class="fa-solid fa-sliders w-5 text-center {{ request()->routeIs('admin.settings.*') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                    <span>Pengaturan Website</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom Actions / Profile & Website Link -->
    <div class="p-4 border-t border-stone-800/80 bg-stone-950/30 space-y-2">
        <a href="{{ route('home') }}" target="_blank" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-stone-800/50 hover:bg-stone-800 text-stone-300 hover:text-white text-xs font-semibold transition border border-stone-700/40">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-arrow-up-right-from-square text-amber-400"></i>
                <span>Lihat Website Publik</span>
            </span>
            <i class="fa-solid fa-chevron-right text-[10px] text-stone-400"></i>
        </a>

        <!-- User Info & Logout Form -->
        <div class="pt-2 flex items-center justify-between px-2">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 rounded-full bg-amber-600/30 border border-amber-500/50 text-amber-300 flex items-center justify-center font-bold text-xs flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-stone-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>

            <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari Admin Panel?');">
                @csrf
                <button type="submit" title="Keluar / Logout" class="p-2 text-stone-400 hover:text-rose-400 hover:bg-rose-950/30 rounded-lg transition">
                    <i class="fa-solid fa-power-off text-sm"></i>
                </button>
            </form>
        </div>
    </div>
</div>

