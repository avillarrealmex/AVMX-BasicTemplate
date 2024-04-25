<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico')}}">
    <!--NOTE CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>{{ config('app.name', 'test') }}</title>
    <!--NOTE Importamos los Scripts JS -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/nikken.js') }}" ></script>
    <!--NOTE Importamos Styles CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nikken.css') }}" rel="stylesheet">
</head>
<body>
    {{--NOTE Inicia sección del navbar --}}
    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow" id="navbarMenu">
      @include('layouts.includes.navbar')
    </nav>
    {{-- Finaliza sección del navbar --}}
    <div class="container-fluid" id="body-background" style="height: 96vh !important; overflow-y:auto">
      <div class="row">
        {{--NOTE Inicia sección del sidebar --}}
        <nav class="col-md-2 d-none d-md-block sidebar sidebar-menu bg-sidebar" id="sidebarMenu">
          <div class="sidebar-sticky">
            @include('layouts.includes.sidebar')
          </div>
        </nav>
        {{--NOTE Finaliza sección del sidebar --}}
        {{--NOTE Inicia sección del content-body --}}
        <main role="main" class="col-sm-11 col-md-11 ml-sm-auto col-lg-11 col-xl-11 px-4 align-items-center justify-content-center w-100" id="mainContainer">
            @yield('content')
        </main>
        {{-- Finaliza sección del content-body --}}
      </div>
      <div class="row">
        {{--NOTE Inicia sección del footer --}}
        <div class="footer" style="height: 4vh !important;">
            @include('layouts.includes.footer')
        </div>
        {{-- finaliza sección del footer --}}
        {{--NOTE Inicia sección de los modales --}}
        @include('layouts.includes.modals')
        {{-- finaliza sección de los modales --}}
      </div>
    </div>
</body>
</html>
