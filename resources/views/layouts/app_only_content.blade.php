<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="h-100 d-flex justify-content-center align-items-center">
    <div class="app app-only-content">
        {{-- ロゴ画像 --}}
        <div class="d-flex justify-content-center">
            <a href="{{route('home')}}"><img src="/images/logo-1.png" /></a>
        </div>
        {{-- コンテンツ部分 --}}
        <div class="d-flex justify-content-center mt-3">
            <div class="col-auto">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
