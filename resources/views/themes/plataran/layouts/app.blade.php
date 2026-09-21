<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Omah Ayem — A Sanctuary of Javanese Nobility & Tranquil Splendor')</title>
    <meta name="description" content="@yield('meta_description', 'An intimate Javanese heritage sanctuary in Yogyakarta. Exclusive teak pendopo celebrations, bespoke private dining, and serene estate retreats inspired by quiet luxury.')">

    <!-- Google Fonts: Cormorant Garamond & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Montserrat:wght@200;300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS with Luxury Hospitality Theme Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        luxury: {
                            'ivory': '#FAF7F2',       // Warm off-white / ivory canvas
                            'cream': '#F3ECE0',       // Subtle parchment cream
                            'sand': '#E8DFC8',        // Fine sandy neutral
                            'border': '#E4DAD0',      // Hairline delicate divider
                            'stone': '#1C1917',       // Editorial deep charcoal
                            'charcoal': '#2C2724',    // Body text
                            'muted': '#78716C',       // Caption muted tone
                            'forest': '#243427',      // Plataran deep forest green
                            'forest-deep': '#19261C', // Almost black forest
                            'wood': '#3A271C',        // Polished aged teak
                            'brass': '#A78B58',       // Brushed antique brass
                            'brass-light': '#D4C097', // Soft brass highlight
                            'gold': '#C5A365',        // Muted luxury gold
                        }
                    },
                    fontFamily: {
                        serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                        sans: ['"Montserrat"', '"Plus Jakarta Sans"', 'sans-serif'],
                        body: ['"Plus Jakarta Sans"', '"Montserrat"', 'sans-serif'],
                    },
                    letterSpacing: {
                        'ultra': '0.25em',
                        'luxury': '0.15em',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        /* Editorial text selection */
        ::selection {
            background-color: #C5A365;
            color: #FAF7F2;
        }

        /* Delicate luxury scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #FAF7F2;
        }
        ::-webkit-scrollbar-thumb {
            background: #A78B58;
            border-radius: 3px;
        }

        /* Subtle luxury vignette */
        .vignette-luxury {
            background: radial-gradient(circle at center, rgba(28,25,23,0.1) 0%, rgba(28,25,23,0.65) 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans bg-luxury-ivory text-luxury-stone antialiased flex flex-col min-h-screen">

    <!-- Top Multi-Theme Switcher Bar -->
    <div class="bg-luxury-forest-deep text-luxury-ivory/80 text-[11px] uppercase tracking-luxury py-2 px-4 border-b border-luxury-brass/20 text-center flex items-center justify-between z-50">
        <div class="hidden sm:block text-luxury-brass-light/80">
            <i class="fa-solid fa-gem text-[9px] mr-1 text-luxury-gold"></i>
            Plataran Luxury Edition
        </div>
        <div class="mx-auto sm:mx-0 flex items-center gap-4">
            <span class="text-luxury-ivory/60">Exploring: <strong class="text-luxury-ivory font-semibold">Quiet Luxury Hospitality</strong></span>
            <span class="text-luxury-brass/40">|</span>
            <a href="{{ route('home') }}" class="text-luxury-gold hover:text-white underline underline-offset-4 transition font-medium">
                Switch to Classic Theme &rarr;
            </a>
        </div>
    </div>

    <!-- Luxury Header & Navigation -->
    @include('themes.plataran.components.header')

    <!-- Main Editorial Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Luxury Concierge Floating WhatsApp -->
    @include('themes.plataran.components.concierge-wa')

    <!-- Luxury Editorial Footer -->
    @include('themes.plataran.components.footer')

    @stack('scripts')
</body>
</html>

