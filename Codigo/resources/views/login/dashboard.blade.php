@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 text-center">
                @if (Session::has('success'))
                    <div class="alert alert-success" id="successSection">
                        <i class="fa-solid fa-circle-check"></i> {{ Session::get('success') }}
                    </div>
                @endif
                <span class="text-center"><h4 class="mt-4">Sección de noticias y manuales de uso</h4></span>
            </div>
        </div>
    </div>
@endsection
