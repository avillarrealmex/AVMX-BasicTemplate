@extends('layouts.main')

@section('content')
    <div class="content-fluid">
        <table class="table data table-bordered table-responsive" id="datos">
            <h4> Encabezado de la tabla </h4>
            <thead>
                @isset($tittleColumn)
                    <tr>
                        @for ($columIndex = 0; $columIndex < sizeof($tittleColumn); $columIndex++)
                            <th class='tittleSection' scope="col"> {{ $tittleColumn[$columIndex] }} </th>
                        @endfor
                        <th class='tittleSection' scope="col"> Acciones </th>
                    </tr>
                @endisset
                <tr>
                    @for ($columIndex = 0; $columIndex < sizeof($tittleColumn); $columIndex++)
                        <th class='form findSection' scope="col"> <input class="search" type="text" tittleHeader = "{{ $tittleHeaders[$columIndex] }}"></th>
                    @endfor
                    <th class='findSection'></th>
                </tr>
            </thead>
            <tbody>
                @isset($users)
                    @foreach ($users as $user)
                    <tr userId = {{ isset($user->id) ? $user->id : 0 }}>
                        <td class="data"> {{ isset($user->name) ? $user->name : '' }} </td>
                        <td class="data"> {{ isset($user->email) ? $user->email : ''}} </td>
                        <td class="data"> {{ isset($user->created_at) ? $user->created_at->format('d-m-Y H:m:s') : ''}} </td>
                        <td class="data"> {{ isset($user->isActive) ? $user->isActive : ''}} </td>
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
@endsection
