@extends('layouts.main')

@section('content')
    <div class="content-fluid">
        <table class="table data table-bordered table-responsive">
            <h4> Encabezado de la tabla </h4>
            <thead>
                <tr>
                    <th scope="col"> Usuario </th>
                    <th scope="col"> email </th>
                    <th scope="col"> Creado en </th>
                    <th scope="col"> Status </th>
                    <th scope="col"> acciones </th>
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
                        <td class="text-left">
                            <button class="save"> Save </button>
                            <button class="edit"> Edit </button>
                            <button class="delete"> Delete </button>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
