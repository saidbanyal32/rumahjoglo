<!DOCTYPE html>
<html lang="id" class="h-full bg-stone-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin Panel - Rumah Joglo Omah Ayem</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Tailwind CSS -->
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
</head>
<body class="h-full font-sans antialiased bg-stone-950 flex flex-col justify-center py-12 sm:px-6 lg:px-8 selection:bg-amber-600 selection:text-white relative overflow-hidden">

    <!-- Background Pattern Accent -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute inset-0" style="background-image: radial-gradient(#C28B28 1px, transparent 1px); background-size: 28px 28px;"></div>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <!-- Logo / Icon -->
        <div class="text-center">
            <div class="inline-flex w-16 h-16 rounded-2xl bg-gradient-to-tr from-amber-600 to-amber-500 text-white items-center justify-center shadow-xl shadow-amber-900/40 mb-4 border border-amber-400/30">
                <i class="fa-solid fa-hotel text-2xl"></i>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">
                Rumah Joglo Omah Ayem
            </h1>
            <p class="text-xs uppercase tracking-widest text-amber-400 font-semibold mt-1">
                Portal Masuk Administrator
            </p>
        </div>

        <!-- Card Form Login -->
        <div class="mt-8 bg-stone-900 py-8 px-6 shadow-2xl border border-stone-800 rounded-3xl sm:px-10 relative">
            
            <!-- Flash Message -->
            @if(session('success'))
            <div class="mb-5 p-3 rounded-xl bg-emerald-950/60 border border-emerald-500/40 text-emerald-300 text-xs flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-400"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-5 p-3 rounded-xl bg-rose-950/60 border border-rose-500/40 text-rose-300 text-xs flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation text-rose-400"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 p-3 rounded-xl bg-rose-950/60 border border-rose-500/40 text-rose-300 text-xs">
                <div class="flex items-center gap-2 mb-1 font-bold text-rose-400">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Gagal Masuk</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5 text-[11px]">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-500">
                            <i class="fa-regular fa-envelope text-sm"></i>
                        </div>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', 'admin@omahayem.com') }}" 
                               required 
                               autofocus
                               placeholder="admin@omahayem.com"
                               class="w-full pl-10 pr-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-stone-200 placeholder-stone-600 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm transition">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-stone-300 mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-500">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required 
                               placeholder="••••••••••••"
                               class="w-full pl-10 pr-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-stone-200 placeholder-stone-600 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm transition">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember"
                               class="w-4 h-4 rounded border-stone-700 bg-stone-950 text-amber-600 focus:ring-amber-500/20 focus:ring-offset-0">
                        <span class="text-xs text-stone-400 select-none">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400 text-stone-950 font-bold text-sm tracking-wide shadow-lg shadow-amber-900/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <span>Masuk ke Dashboard</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </div>
            </form>

            <!-- Default Credential Helper Note for User / Dev -->
            <div class="mt-6 pt-6 border-t border-stone-800/80 text-center">
                <p class="text-[11px] text-stone-400">
                    Kredensial Default: <br>
                    <span class="text-stone-300 font-mono">admin@omahayem.com</span> | <span class="text-stone-300 font-mono">AdminOmahAyem2026!</span>
                </p>
                <div class="mt-3">
                    <a href="{{ route('home') }}" class="text-xs text-amber-400/80 hover:text-amber-300 transition inline-flex items-center gap-1.5">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span>Kembali ke Halaman Beranda Web</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

