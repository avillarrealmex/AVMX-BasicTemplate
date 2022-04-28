@section('managementUser')
<div class="modal fade mangementUser" data-modal-color="" id="mangementUser" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar usuario</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('user.create')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nombre de usuario</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        <span class="alert"> {{$errors->first('name')}} </span>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                        <span class="alert"> {{$errors->first('password')}} </span>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="{{old('password_confirm')}}">
                        <span class="alert"> {{$errors->first('password_confirm')}} </span>
                    </div>
                    <div class="form-group">
                        <label for="">email</label>
                        <input type="type" class="form-control" id="email" name="email" value="{{old('email')}}">
                        <span class="alert"> {{$errors->first('email')}} </span>
                    </div>
                    <div class="form-group">
                        <label for="">tipoUsuario</label>
                        <input type="text" class="form-control" id="tipoUsuario" name="tipoUsuario" value="{{old('tipoUsuario')}}">
                        <span class="alert"> {{$errors->first('tipoUsuario')}} </span>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
