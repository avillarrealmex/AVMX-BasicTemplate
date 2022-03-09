<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--NOTE CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'test') }}</title>
    <!--NOTE Importamos los Scripts JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/nikken.js') }}" defer></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <!--NOTE Importamos Styles CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nikken.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
</head>
<body>
    {{--NOTE Inicia sección del navbar --}}
    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 bg-light">
        @include('layouts.includes.navbar')
    </header>
    {{-- Finaliza sección del navbar --}}
    <div class="container-fluid">
        <div class="row">
            {{--NOTE Inicia sección sidebar --}}
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3 bg-sidebar">
                    @include('layouts.includes.sidebar')
                </div>
            </nav>
            {{-- Finaliza sección sidebar --}}
            {{--NOTE Inicia sección del content-body --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="content body-background">
                    @yield('content')
                </div>
            </main>
            {{-- Finaliza sección del content-body --}}
        </div>
    </div>
    {{--NOTE Inicia sección del footer --}}
    <div class="footer">
        @include('layouts.includes.footer')
    </div>
    {{-- finaliza sección del footer --}}
</body>
</html>
