<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->currentLocale()) }}" dir="{{ language_direction() }}">
    <head>
        <meta charset="utf-8" />
        <link href="{{ asset("img/favicon.png") }}" rel="apple-touch-icon" sizes="76x76" />
        <link type="image/png" href="{{ asset("img/favicon.png") }}" rel="icon" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>@yield("title") | {{ config("app.name") }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="{{ setting("meta_description") }}" />
        <meta name="keyword" content="{{ setting("meta_keyword") }}" />
        @include("frontend.includes.meta")

        <!-- Shortcut Icon -->
        <link href="{{ asset("img/favicon.png") }}" rel="shortcut icon" />
        <link type="image/ico" href="{{ asset("img/favicon.png") }}" rel="icon" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

        @vite(["resources/css/app-frontend.css", "resources/js/app-frontend.js"])

        @livewireStyles

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

        <!-- Scripts -->
        @livewireScripts
        @stack("after-scripts")
    </body>
</html>
