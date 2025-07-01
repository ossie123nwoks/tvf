<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TVF') }}</title>

    <!-- ✅ Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- ✅ Trix Editor Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.css" integrity="sha512-E+j0cb06DFwYzjz3vIzM7YhXGZTVb6BRJZLG0AfCn3nmU4j/zTRj1D7gzIlTHpdSTQ1FZ8rMI6lZxULSCrKEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ✅ AOS (Scroll Animations) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <!-- ✅ Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- ✅ Vite Assets (App Styles + Scripts) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('partials.navbar') <!-- Include Navigation Partial -->

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        @include('partials.footer') <!-- Include Footer Partial -->
    </div>

    <!-- ✅ Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.js" integrity="sha512-ABd2z6JbmLJdOENuDiNaZXhV3PzZc1PXBjeWqPSENc4ZwdlZdFs4K7Suhghh4WsYZG7bRbH3UafP1XMgeflTXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
</body>
</html>
