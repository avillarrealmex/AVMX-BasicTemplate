@extends('layouts.main')

@section('content')
    <div class="content-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4> Listado de usuarios </h4>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="newUser btn btn-primary ">Crear nuevo usuario</button>
            </div>
        </div>
        <table class="table data table-bordered table-responsive" id="datos">
            <thead>
                @isset($userTableDefinition)
                    <tr>
                        @for ($columIndex = 0; $columIndex < sizeof($userTableDefinition); $columIndex++)
                            <th class='tittleSection' scope="col"> {{ $userTableDefinition[$columIndex]->tittleColumn }} </th>
                        @endfor
                        <th class='tittleSection' scope="col"> Acciones </th>
                    </tr>
                    <tr>
                        @for ($columIndex = 0; $columIndex < sizeof($userTableDefinition); $columIndex++)
                            <th class='form findSection' scope="col"> <input class="search" type="text" tittleHeader = "{{ $userTableDefinition[$columIndex]->tittleHeader }}"></th>
                        @endfor
                        <th class='findSection'></th>
                    </tr>
                @endisset
            </thead>
            <tbody>
                @isset($users)
                    @foreach ($users as $user)
                    <tr userId = {{ isset($user->id) ? $user->id : 0 }}>
                        <td class = "data" tittleHeader = "{{ $userTableDefinition[0]->tittleHeader }}" dataType = "{{ $userTableDefinition[0]->typeData }}"> {{ isset($user->name) ? $user->name : '' }} </td>
                        <td class = "data" tittleHeader = "{{ $userTableDefinition[1]->tittleHeader }}" dataType = "{{ $userTableDefinition[1]->typeData }}"> {{ isset($user->email) ? $user->email : ''}} </td>
                        <td class = "data" tittleHeader = "{{ $userTableDefinition[2]->tittleHeader }}" dataType = "{{ $userTableDefinition[2]->typeData }}"> {{ isset($user->created_at) ? $user->created_at->format('d-m-Y H:m:s') : ''}} </td>
                        <td class = "data" tittleHeader = "{{ $userTableDefinition[3]->tittleHeader }}" dataType = "{{ $userTableDefinition[3]->typeData }}"> {{ isset($user->isActive) ? $user->isActive : ''}} </td>
                        <td class="text-right">
                            <button class="save"> <i class="fa-solid fa-floppy-disk fa-lg"></i> </button>
                            <button class="edit"> <i class="fa-solid fa-square-pen fa-lg"></i> </button>
                            <button class="delete"> <i class="fa-solid fa-trash fa-lg"></i> </button>
                        </td>
                    </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>




    <div class="modal fade mangementUser" data-modal-color="" id="mangementUser" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar usuario</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="{{ route('user.management')}}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id" value="{{old('id')}}">
                        <div class="form-group">
                            <label for="">Nombre de usuario</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            <span class="alert"> {{$errors->first('name')}} </span>
                        </div>
                        <div class="form-group">
                            <label for="">email</label>
                            <input type="type" class="form-control" id="email" name="email" value="{{old('email')}}">
                            <span class="alert"> {{$errors->first('email')}} </span>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
