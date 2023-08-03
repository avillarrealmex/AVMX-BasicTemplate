@if (Auth::guest())
    @extends('layouts.main')
@endif
@section('content')
<div class="row">
    <div class="col-md-12">
        <br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-12" style="max-width: 100%;">
            <div class="card-header">
                <span style="text-align: center; color: #671505; font-weight: bold;">
                    Descripción del error: {{ $message }}
                </span>
            </div>
            <div class="card-body imgResponsive text-center">
                <img src="{{ asset('images/errors/error500.png')}}" class="img-center" alt="Error 500"/>
            </div>
        </div>
    </div>
</div>
@endsection
