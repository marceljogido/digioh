<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Reset Password</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app-frontend.css', 'resources/js/app-frontend.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <x-selected-theme />
        <div class="flex min-h-screen items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <div class="mx-auto h-16 w-16">
                        <x-application-logo class="h-full w-full fill-current text-indigo-600" />
                    </div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        {{ __('Password Reset') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ __('Instructions for resetting your password') }}
                    </p>
                </div>

                <div class="mt-8 rounded-lg bg-white p-8 shadow-xl">
                    <div class="text-center">
                        <div class="mb-6 rounded-lg bg-yellow-50 p-4 text-center">
                            <div class="flex justify-center">
                                <svg class="h-12 w-12 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">{{ __('Feature Not Available') }}</h3>
                            <p class="mt-2 text-sm text-gray-600">
                                {{ __("Password reset functionality is not available. Please contact your system administrator to reset your password.") }}
                            </p>
                        </div>
                        
                        <div>
                            <a href="{{ route('login') }}" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                {{ __('Back to Login') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>