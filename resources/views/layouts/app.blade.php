<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah Joglo Omah Ayem - Sewa Tempat Pernikahan & Gathering Jogja')</title>
    <meta name="description" content="@yield('meta_description', 'Persewaan Rumah Joglo otentik kayu jati untuk pernikahan tradisional, gathering keluarga, arisan, dan photoshoot di Depok. Suasana asri, sakral, dan privat.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS CDN with Custom Theme Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            'dark': '#24140B',        // Cokelat jati tua sangat gelap
                            'wood': '#482B17',        // Cokelat kayu jati klasik
                            'wood-light': '#6E4527',  // Cokelat kayu hangat
                            'amber': '#C28B28',       // Emas tembaga/amber hangat
                            'gold': '#DFB247',        // Aksen emas berkilau
                            'cream': '#FAF6EE',       // Krem/warm white dasar
                            'sand': '#F1E7D7',        // Pasir krem untuk card/background sekunder
                            'sage': '#4D6B56',        // Hijau sage natural
                            'sage-dark': '#385040',   // Hijau sage tua
                            'sage-light': '#E9F0EB',  // Sage sangat lembut
                            'charcoal': '#1F1A17',    // Hitam arang untuk teks utama
                            'muted': '#72665D'        // Teks abu-abu kecokelatan sekunder
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        display: ['"Cinzel"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        'joglo': '0 10px 30px -10px rgba(44, 26, 17, 0.12)',
                        'joglo-lg': '0 20px 40px -15px rgba(44, 26, 17, 0.18)',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js Core for Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F1E7D7;
        }
        ::-webkit-scrollbar-thumb {
            background: #6E4527;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #482B17;
        }

        /* Subtle batik / ethnic geometric accent background pattern */
        .bg-ethnic-pattern {
            background-color: #FAF6EE;
            background-image: radial-gradient(#C28B28 0.65px, transparent 0.65px), radial-gradient(#C28B28 0.65px, #FAF6EE 0.65px);
            background-size: 26px 26px;
            background-position: 0 0, 13px 13px;
            background-opacity: 0.05;
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans bg-brand-cream text-brand-charcoal antialiased flex flex-col min-h-screen selection:bg-brand-amber selection:text-white">

    <!-- Header & Navigasi -->
    @include('components.navbar')

    <!-- Konten Halaman Utama -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating WhatsApp Action Button -->
    @include('components.whatsapp-button')

    <!-- Footer Informatif -->
    @include('components.footer')

    @stack('scripts')
</body>
</html>

