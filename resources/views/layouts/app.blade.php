<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $headTitle ?? 'Title not defined' }}</title>
    <link rel="manifest" href="/manifest.webmanifest">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light pb-5">
<x-navbar/>
<x-navbar.search/>
<div class="container-fluid bd-layout">
    <x-sidebar/>
    <main class="bd-main p-2">
        @if(count($errors) > 0)
            @foreach( $errors->all() as $message )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span>{{ $message }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <span>{{ session()->get('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                <span>{{ session()->get('warning') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <span>{{ session()->get('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{ $slot }}
    </main>
</div>
<footer class="fixed-bottom container-fluid bg-light d-flex justify-content-between align-items-center shadow-lg">
    <div class="d-flex justify-content-center align-content-center text-black-50">
        {{-- пустой блок --}}
    </div>

    <div class="text-black-50">
        <span class="navbar-text mr-auto"><small>&copy; PremierExpo System v2.1 2022-<?= date( 'Y', time() ); ?></small></span>
    </div>

    <a href="#" id="scroolToTop" class="p-1 align-items-center text-black-50">
        <i class="fal fa-2x fa-arrow-square-up"></i>
    </a>
</footer>
</body>
</html>
