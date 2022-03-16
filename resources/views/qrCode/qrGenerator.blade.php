@php
    header('Content-type','image/png');
@endphp
@extends('layouts.login')
@section('content')
    <div class="visible-print text-center">
        <h1>Ejemplo de QrCode</h1>

        <img src="data:image/png;base64,
        {!!
            base64_encode(
                QrCode::format('png')
                    ->merge('images/logoBienestar.png', 0.3, true)
                    ->size(250)
                    ->color(120, 204, 109)
                    ->errorCorrection('H')
                    ->generate('https://intranet.nikken.com.mx:8049/rmank/Nzk0NDIwM3wy')
            );
        !!}" />

    </div>
@endsection()
