<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'test') }}</title>
        <!-- Importamos los Scripts JS -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/nikken.js') }}" defer></script>
        {{-- <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script> --}}
        <!-- Importamos Styles CSS -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/nikken.css') }}" rel="stylesheet">
        {{-- <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}
    </head>
    <body>
        <div class="container-fluid">
            <!--NOTE Inicia Sidebar -->
            <div class="sidebar-container">
                <div class="bg-sidebar">
                    @include('layouts.includes.sidebar')
                </div>
            </div>
            <!-- Finaliza Sidebar -->
            <!--NOTE Inicia navbar -->
            <div class="navbar-container">
                @include('layouts.includes.navbar')
            </div>
            <!-- Finaliza navbar -->
            <!--NOTE Inicia content -->
            <div class="body-container">
                @yield('content')
            </div>
            <!-- Finaliza content -->
            <!--NOTE Inicia footer -->
            <div class="footer-container">
                <div class="bg-footer">
                    @include('layouts.includes.footer')
                </div>
            </div>
        </div>
    </body>
</html>
