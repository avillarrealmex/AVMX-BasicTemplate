
<div class="container-fluid forms-Nikken" id="formUsers">
    <div class="tittle text-center" id="formTittle"></div>

    <div class="row">
        <div class="col-sm-12 text-left border border-success border-2 rounded formWhiteGround">
            <br>
            <form role="form" action="{{ route('users.management')}}" method="post">
                @csrf
                <div class="container-fluid">
                <input id="userId" type="hidden" class="form-control" name="userId" value="newRegister">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-center">
                                <h4> Información del usuario </h4>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary mb-3">
                                <label for="">Código del usuario</label>
                                <input id="userCode" type="text" class="form-control" name="userCode" value="{{ old('userCode') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary mb-3">
                                <label for="">Nombre del usuario</label>
                                <input id="userName" type="text" class="form-control" name="userName" value="{{ old('userName') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary mb-3">
                                <label for="">Email de empleado</label>
                                <input id="userEmail" type="email" class="form-control" name="userEmail" value="{{ old('userEmail') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="passwordDiv">
                        <div class="col-md-6">
                            <div class="card text-white bg-secondary mb-3">
                                <label for="">Contraseña</label>
                                <input id="userPassword" type="password" class="form-control" name="userPassword" value="{{ old('userPassword') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-white bg-secondary mb-3">
                                <label for="">Confirmación de contraseña</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-center">
                                <h4> Asignación de roles </h4>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 card text-white bg-secondary mb-3" id="has_roles">
                            <div class="container-fluid">
                                <label for="">Seleccione rol a asignar</label>
                                <div class="row">
                                    @foreach($usersTableDefinition[9]->options as $index=>$option)
                                        @if ($index % 3 == 0)
                                            </div>
                                            <div class="row"></div>
                                            <div class="row">
                                        @endif
                                            <div class="col-md-4 form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="roleUsers" name="roleUsers[]" value={{ isset($option->id) ? $option->id : $option['id'] }} {{ (is_array(old('roleUsers')) and in_array(isset($option->id) ? $option->id : $option['id'], old('roleUsers'))) ? ' checked' : '' }}>
                                                <label class="form-check-label" for="">{{ isset($option->description) ? $option->description : $option['description'] }}</label>
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-center">
                                <h4> Información de pais y áreas </h4>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12 card text-white bg-secondary mb-3">
                                <label for="">Área</label>
                                <select id="areaId" class="form-select" name="areaId">
                                    <option value=''>Seleccione una opción</option>
                                    @foreach($usersTableDefinition[5]->options as $index=>$option)
                                        @if ((isset($option->id) ? $option->id : $option['id']) == old($usersTableDefinition[5]->tittleHeader))
                                            <option value={{ isset($option->id) ? $option->id : $option['id'] }} selected>{{ isset($option->description) ? $option->description : $option['description'] }}</option>
                                        @else
                                            <option value={{ isset($option->id) ? $option->id : $option['id'] }}>{{ isset($option->description) ? $option->description : $option['description'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 card text-white bg-secondary mb-3">
                                <label for="">País de origen</label>
                                <select id="originCountryId" class="form-select" name="originCountryId">
                                    <option value=''>Seleccione una opción</option>
                                    @foreach($usersTableDefinition[4]->options as $index=>$option)
                                        @if ((isset($option->id) ? $option->id : $option['id']) == old($usersTableDefinition[4]->tittleHeader))
                                            <option value={{ isset($option->id) ? $option->id : $option['id'] }} selected>{{ isset($option->description) ? $option->description : $option['description'] }}</option>
                                        @else
                                            <option value={{ isset($option->id) ? $option->id : $option['id'] }}>{{ isset($option->description) ? $option->description : $option['description'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 card text-white bg-secondary mb-3" id='country_users'>
                            <div class="container-fluid">
                                <label for="">Puede editar en:</label>
                                <div class="row">
                                    @foreach($usersTableDefinition[8]->options as $index=>$option)
                                        @if ($index % 3 == 0)
                                            </div>
                                            <div class="row"></div>
                                            <div class="row">
                                        @endif
                                            <div class="col-md-4 form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="countryUsers" name="countryUsers[]" value={{ isset($option->id) ? $option->id : $option['id'] }} {{ (is_array(old('countryUsers')) and in_array(isset($option->id) ? $option->id : $option['id'], old('countryUsers'))) ? ' checked' : '' }}>
                                                <label class="form-check-label" for="">{{ isset($option->description) ? $option->description : $option['description'] }}</label>
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-center">
                                <h4> Información complementaria </h4>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary mb-3">
                                <label for=""></label>
                                @if ((isset($usersTableDefinition[6]->isManager) ? $usersTableDefinition[6]->isManager : $option['id']) == old('isManager'))
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="isManager" name="isManager" checked>
                                        <label class="form-check-label" for="isManager">Es directivo</label>
                                    </div>
                                @else
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="isManager" name="isManager">
                                        <label class="form-check-label" for="isManager">Es directivo</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary mb-3">
                                <label for="">Fecha de entrada</label>
                                <input id="userStartDate" type="date" class="form-control" name="userStartDate" value="{{ old('userStartDate') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary mb-3">
                                <label for="">Fecha de salida</label>
                                <input id="userEndDate" type="date" class="form-control" name="userEndDate" value="{{ old('userEndDate') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center card-header">
                            <button type="submit" class="btn btn-primary" id="sendForm">Crear</button>
                        </div>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
</div>
