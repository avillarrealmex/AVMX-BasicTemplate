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
                    Oops!! La página no existe
                </span>
            </div>
            <div class="card-body imgResponsive text-center">
                <img src="{{ asset('images/errors/error404.png')}}" class="img-center" alt="Error404"/>
            </div>
        </div>
    </div>
</div>
@endsection
