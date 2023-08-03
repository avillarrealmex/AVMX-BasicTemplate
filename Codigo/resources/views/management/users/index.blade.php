@extends('layouts.main')

@section('content')
<script src="{{ asset('js/managementSite/users.js') }}"></script>
    <div class="content-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                @if ($errors->any())
                    <div class="alert alert-danger" id="errorSection">
                        <span class="text-center">
                            <i class="fa-solid fa-circle-exclamation"></i> Upss.. los siguientes campos son obligtarios<br> o no cumplen con los requerimientos
                        </span>
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger"> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div><br/>
                @else
                    @if (Session::has('success'))
                        <div class="alert alert-success" id="successSection">
                            <i class="fa-solid fa-circle-check"></i> {{ Session::get('success') }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 float-left">
                <br>
                <span class="btn btn-success" id="paginateSpan">
                    <i class="fa-solid fa-list-ol"></i>
                    No. Registros
                    <select class="form input-select paginate" name='rowPaginate' id="search">
                        <option val=10 selected>10</option>
                        <option val=50>50 </option>
                        <option val=100>100</option>
                        <option val=200>200</option>
                    </select>
                </span>
            </div>
            <div class="col-md-4 text-center">
                <br>
                <button type="button" class="btn btn-success float-right" id="tableOrForm">
                    <i id="fontAwesomeIcon" class="fa-solid fa-file-circle-plus"></i>
                    <span>Crear</span>
                </button>
            </div>
        </div>
        <br>
        @include('managementSite.users.table')
    </div>
    @include('managementSite.users.form')
@endsection
