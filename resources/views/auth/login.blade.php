<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

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
                        {{ __('Welcome Back') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ __('Please sign in to your account') }}
                    </p>
                </div>

                <div class="mt-8 rounded-lg bg-white p-8 shadow-xl">
                    <form class="space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                {{ __('Email Address') }}
                            </label>
                            <div class="mt-1">
                                <input 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    autocomplete="email" 
                                    required 
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('email') border-red-300 @enderror"
                                    value="{{ old('email') }}"
                                >
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                {{ __('Password') }}
                            </label>
                            <div class="mt-1">
                                <input 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    autocomplete="current-password" 
                                    required 
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('password') border-red-300 @enderror"
                                >
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input 
                                    id="remember" 
                                    name="remember" 
                                    type="checkbox" 
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                >
                                <label for="remember" class="ml-2 block text-sm text-gray-900">
                                    {{ __('Remember me') }}
                                </label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    {{ __('Contact Admin') }}
                                </a>
                            </div>
                        </div>

                        <div>
                            <button 
                                type="submit" 
                                class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out"
                            >
                                {{ __('Sign in') }}
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="bg-white px-2 text-gray-500">
                                    {{ __('Need help?') }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-6 text-center text-sm text-gray-600">
                            <p>{{ __('Only accounts registered by the system administrator can log in.') }}</p>
                            <p class="mt-1">
                                {{ __('Forgot your password? ') }}
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    {{ __('Contact your system administrator') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>