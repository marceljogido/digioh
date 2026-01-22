<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->currentLocale()) }}" dir="{{ language_direction() }}">
    <head>
        <meta charset="utf-8" />
        <link href="{{ asset("img/favicon.png") }}" rel="apple-touch-icon" sizes="76x76" />
        <link type="image/png" href="{{ asset("img/favicon.png") }}" rel="icon" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>@yield("title") | {{ config("app.name") }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="@yield('meta_description', (app()->getLocale() == 'en' && setting('app_description_en')) ? setting('app_description_en') : setting('meta_description'))" />
        <meta name="keyword" content="@yield('meta_keyword', setting('meta_keyword'))" />
        @include("frontend.includes.meta")

        <!-- Shortcut Icon -->
        <link href="{{ asset("img/favicon.png") }}" rel="shortcut icon" />
        <link type="image/ico" href="{{ asset("img/favicon.png") }}" rel="icon" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

        <!-- AOS Animate On Scroll -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        @vite(["resources/css/app-frontend.css", "resources/js/app-frontend.js"])

        @livewireStyles

        <!-- Custom Animations -->
        <style>
            /* Smooth transitions base - apply to all interactive elements */
            a, button, .card, article, [class*="hover-"] {
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                -webkit-transform: translateZ(0);
                transform: translateZ(0);
            }

            /* Fade animations */
            .animate-fade-in { animation: fadeIn 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
            .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
            .animate-fade-in-down { animation: fadeInDown 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
            .animate-scale-in { animation: scaleIn 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
            
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes fadeInDown {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes scaleIn {
                from { opacity: 0; transform: scale(0.95); }
                to { opacity: 1; transform: scale(1); }
            }

            /* Smooth hover effects - using cubic-bezier for natural feel */
            .hover-lift { 
                transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), 
                            box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                will-change: transform, box-shadow;
            }
            .hover-lift:hover { 
                transform: translateY(-6px); 
                box-shadow: 0 16px 32px rgba(0,0,0,0.12); 
            }
            
            .hover-glow { 
                transition: box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                will-change: box-shadow;
            }
            .hover-glow:hover { 
                box-shadow: 0 0 24px rgba(92, 131, 196, 0.3); 
            }

            /* Gradient animation */
            .animate-gradient {
                background-size: 200% 200%;
                animation: gradientShift 8s ease infinite;
            }
            @keyframes gradientShift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }

            /* Pulse animation - more subtle */
            .animate-pulse-slow { animation: pulseSlow 4s ease-in-out infinite; }
            @keyframes pulseSlow {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.8; }
            }

            /* Counter animation preparation */
            .counter-animate { opacity: 0; transform: translateY(20px); }
            .counter-animate.visible { 
                opacity: 1; 
                transform: translateY(0); 
                transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94); 
            }

            /* Override any jarring transitions on cards */
            article, .card, [class*="rounded-"] {
                transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), 
                            box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                            border-color 0.3s ease;
            }
        </style>


        @stack("after-styles")

        <x-google-analytics />
    </head>

    @php
        $hasHeroOverlap = request()->routeIs('frontend.index') || request()->routeIs('home');
    @endphp
    <body class="bg-transparent {{ $hasHeroOverlap ? 'hero-overlap' : 'pt-16' }}">
        <x-selected-theme />

        @include("frontend.includes.header")

        <main class="bg-white dark:bg-gray-800">
            @yield("content")
        </main>

        @include("frontend.includes.footer")

        <style>
            /* Reset margin default browser */
            html,
            body {
                margin: 0;
                padding: 0;
            }

            /* Default offset for fixed navbar on most pages */
            body.pt-16 {
                padding-top: 4rem;
            }

            /* Home hero overlaps navbar */
            body.hero-overlap {
                padding-top: 0;
            }

            body.hero-overlap main > section.relative.isolate.overflow-hidden {
                margin-top: -4rem; /* match navbar height */
                padding-top: 4rem;
            }
        </style>

        <!-- Floating WhatsApp Button -->
        @php
            $__waNumFloat = preg_replace('/[^0-9]/','', setting('whatsapp_number') ?? '');
            $__waMsgFloat = rawurlencode(setting('whatsapp_prefill') ?? 'Halo DigiOH, saya ingin bertanya.');
            $__waLinkFloat = $__waNumFloat ? "https://wa.me/$__waNumFloat?text=$__waMsgFloat" : route('contact');
        @endphp
        <a href="{{ $__waLinkFloat }}" target="_blank" rel="noopener" class="fixed bottom-6 right-6 z-[999] flex h-16 w-16 items-center justify-center rounded-full bg-[#25D366] text-white shadow-2xl shadow-[#25D366]/40 transition-all hover:-translate-y-2 hover:scale-110 hover:bg-[#128C7E] focus:outline-none focus:ring-4 focus:ring-[#25D366]/50 group" aria-label="{{ __('Hubungi Tim Kami') }}">
            <!-- Tooltip -->
            <span class="absolute right-full mr-4 hidden whitespace-nowrap rounded-lg bg-gray-900 px-4 py-2 text-sm font-bold text-white opacity-0 shadow-lg transition-all group-hover:block group-hover:opacity-100 dark:bg-white dark:text-gray-900">
                {{ __('Hubungi Tim Kami') }}
            </span>
            
            <!-- Icon -->
            <svg class="h-9 w-9" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>

            <!-- Ping Animation (Online Status) -->
            <span class="absolute top-2 right-2 flex h-3 w-3">
              <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-white opacity-75"></span>
              <span class="relative inline-flex h-3 w-3 rounded-full bg-red-500 border-2 border-[#25D366]"></span>
            </span>
        </a>

        <!-- Scripts -->
        @livewireScripts
        
        <!-- AOS Animate On Scroll -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50,
                delay: 0,
            });
        </script>

        @stack("after-scripts")
    </body>
</html>
