<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Career Tailor') }}</title>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-surface text-on-surface selection:bg-primary/10">
        <div class="min-h-screen">
            <!-- Sidebar Navigation -->
            @include('layouts.sidebar')

            <!-- Top Application Bar -->
            @include('layouts.topnav')

            <!-- Main Content Canvas -->
            <main class="pl-64 pt-16 min-h-screen">
                <div class="p-8 max-w-7xl mx-auto">
                    <!-- Heading Section (Optional) -->
                    @if (isset($header))
                        <div class="mb-8">
                            {{ $header }}
                        </div>
                    @endif

                    <!-- Page Content -->
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Optional: Floating Action Button (Global or per-page) -->
        @stack('fab')
    </body>
</html>
