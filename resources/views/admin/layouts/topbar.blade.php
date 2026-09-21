<header class="h-20 bg-white border-b border-stone-200/80 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-20 shadow-sm/50">
    <!-- Left side: Mobile Menu Trigger & Title -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition">
            <i class="fa-solid fa-bars-staggered text-lg"></i>
        </button>
        <div>
            <h2 class="font-serif text-lg sm:text-xl font-bold text-stone-900 leading-tight">
                @yield('page_title', 'Dashboard')
            </h2>
            <p class="text-xs text-stone-600 hidden sm:block">
                @yield('page_subtitle', 'Selamat datang di Panel Administrasi Rumah Joglo Omah Ayem')
            </p>
        </div>
    </div>

    <!-- Right side: Date, View Site Button, Profile Menu -->
    <div class="flex items-center gap-3 sm:gap-4">
        <div class="hidden md:flex items-center gap-2 text-xs font-medium text-stone-600 bg-stone-100 px-3.5 py-2 rounded-xl border border-stone-200">
            <i class="fa-regular fa-calendar text-amber-700"></i>
            <span>{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>

        <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-amber-50 text-amber-800 hover:bg-amber-100 border border-amber-200 text-xs font-semibold transition">
            <i class="fa-solid fa-earth-asia"></i>
            <span>Buka Web</span>
        </a>

        <!-- Logout Action Button -->
        <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?');">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 text-xs font-semibold transition">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span class="hidden sm:inline">Logout</span>
            </button>
        </form>
    </div>
</header>

