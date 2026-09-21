<!DOCTYPE html>
<html lang="id" class="h-full bg-stone-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Rumah Joglo Omah Ayem</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            'dark': '#24140B',
                            'wood': '#482B17',
                            'amber': '#C28B28',
                            'gold': '#DFB247',
                            'cream': '#FAF6EE',
                            'sand': '#F1E7D7',
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f5f5f4; }
        ::-webkit-scrollbar-thumb { background: #d6d3d1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a29e; }
    </style>
    @stack('styles')
</head>
<body class="h-full font-sans antialiased text-stone-800 bg-stone-50" x-data="{ sidebarOpen: false }">

    <div class="min-h-full flex">
        <!-- Desktop Sidebar (Fixed Left) -->
        <aside class="hidden lg:block w-72 flex-shrink-0 fixed inset-y-0 z-30">
            @include('admin.layouts.sidebar')
        </aside>

        <!-- Mobile Sidebar Drawer -->
        <div x-show="sidebarOpen" 
             x-cloak
             class="fixed inset-0 z-50 lg:hidden flex"
             role="dialog" 
             aria-modal="true">
            <!-- Backdrop -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-stone-900/80 backdrop-blur-sm" 
                 @click="sidebarOpen = false"></div>

            <!-- Off-canvas panel -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="relative max-w-xs w-full bg-stone-900 h-full shadow-2xl">
                @include('admin.layouts.sidebar')
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 lg:pl-72 flex flex-col min-w-0">
            <!-- Topbar Header -->
            @include('admin.layouts.topbar')

            <!-- Page Body -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <!-- Alerts / Flash Messages -->
                @include('admin.layouts.alerts')

                <!-- Main Section Content -->
                @yield('content')
            </main>

            <!-- Admin Footer -->
            <footer class="py-4 px-6 sm:px-8 border-t border-stone-200 text-center text-xs text-stone-600 bg-white">
                <p>&copy; {{ date('Y') }} <strong>Rumah Joglo Omah Ayem</strong> &bull; Panel Manajemen & Administrasi Venue.</p>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

