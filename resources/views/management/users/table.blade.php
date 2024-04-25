<table class="table data table-bordered table-responsive tables-Nikken" id="tableNikken">
    <thead>
        @isset($usersTableDefinition)
            <tr>
                <td class="data text-center" colspan="{{ sizeof($usersTableDefinition) + 1 }}">
                    <h4> Catálogo de Usuarios </h4>
                </td>
            </tr>
            <tr>
                @for ($columIndex = 0; $columIndex < sizeof($usersTableDefinition); $columIndex++)
                    @if ($usersTableDefinition[$columIndex]->canFilter)
                        @if ($usersTableDefinition[$columIndex]->typeData !== 'hidden')
                            <th class='tittleSection' scope="col"> {{ $usersTableDefinition[$columIndex]->tittleColumn }} </th>
                        @endif
                    @endif
                @endfor
                <th class='tittleSection' scope="col"> Acciones </th>
            </tr>
            <tr>
                @for ($columIndex = 0; $columIndex < sizeof($usersTableDefinition); $columIndex++)
                    @if ($usersTableDefinition[$columIndex]->canFilter)
                        @switch($usersTableDefinition[$columIndex]->typeData)
                            @case('select')
                                <th class='form findSection' scope="col">
                                    <select id="search" tittleHeader = "{{ $usersTableDefinition[$columIndex]->tittleHeader }}">
                                        @if ($findFilters[$usersTableDefinition[$columIndex]->tittleHeader] === null )
                                            <option value='' selected>Seleccione una opción</option>
                                            @foreach($usersTableDefinition[$columIndex]->options as $index=>$option)
                                                    <option value={{ isset($option->id) ? $option->id : $option['id'] }}>{{ isset($option->description) ? $option->description : $option['description'] }}</option>
                                            @endforeach
                                        @else
                                            <option value=''>Seleccione una opción</option>
                                            @foreach($usersTableDefinition[$columIndex]->options as $index=>$option)
                                                @if ($option->id == $findFilters[$usersTableDefinition[$columIndex]->tittleHeader] )
                                                    <option value={{ isset($option->id) ? $option->id : $option['id'] }} selected>{{ isset($option->description) ? $option->description : $option['description'] }}</option>
                                                @else
                                                    <option value={{ isset($option->id) ? $option->id : $option['id'] }}>{{ isset($option->description) ? $option->description : $option['description'] }}</option>
                                                @endif
                                            @endforeach
                                        @endif

                                    </select>
                                </th>
                            @break
                            @case('text')
                            @case('number')
                            @case('date')
                            @case('datetime-local')
                            @case('email')
                                @if ($findFilters[$usersTableDefinition[$columIndex]->tittleHeader])
                                <th class='form findSection' scope="col">
                                    <input id="search" type="{{$usersTableDefinition[$columIndex]->typeData}}" tittleHeader = "{{ $usersTableDefinition[$columIndex]->tittleHeader }}" value="{{ $findFilters[$usersTableDefinition[$columIndex]->tittleHeader] }}">
                                </th>
                                @else
                                    <th class='form findSection' scope="col">
                                        <input id="search" type="{{$usersTableDefinition[$columIndex]->typeData}}" tittleHeader = "{{ $usersTableDefinition[$columIndex]->tittleHeader }}">
                                    </th>
                                @endif

                            @break
                            @case('hidden')
                            @break;
                            @default
                                <th class='form bg-light' scope="col"></th>
                            @break
                        @endswitch
                    @else
                        @if ($usersTableDefinition[$columIndex]->canEdit)
                            @if ($usersTableDefinition[$columIndex]->typeData !== 'hidden')
                                <th class='form bg-light' scope="col"></th>
                            @endif
                        @endif
                    @endif
                @endfor
                <th class='form bg-light'></th>
            </tr>
        @endisset
    </thead>
    <tbody>
        @isset($users)
            @foreach ($users as $user)
                <tr userId = {{ isset($user->id) ? $user->id : 0 }}>
                    <td class = "data" tittleHeader = "{{ $usersTableDefinition[1]->tittleHeader }}" dataType = "{{ $usersTableDefinition[1]->typeData }}">{{ isset($user->userCode) ? $user->userCode : '' }}</td>
                    <td class = "data" tittleHeader = "{{ $usersTableDefinition[2]->tittleHeader }}" dataType = "{{ $usersTableDefinition[2]->typeData }}">{{ isset($user->userName) ? $user->userName : '' }}</td>
                    <td class = "data" tittleHeader = "{{ $usersTableDefinition[3]->tittleHeader }}" dataType = "{{ $usersTableDefinition[3]->typeData }}">{{ isset($user->userEmail) ? $user->userEmail : '' }}</td>
                    <td class = "data" tittleHeader = "{{ $usersTableDefinition[4]->tittleHeader }}" dataType = "{{ $usersTableDefinition[4]->typeData }}">
                        @foreach($usersTableDefinition[4]->options as $index=>$option)
                            @if ($option->id == $user->originCountryId)
                                {{ $option->description }}
                            @endif
                        @endforeach
                    </td>
                    <td class = "data" tittleHeader = "{{ $usersTableDefinition[5]->tittleHeader }}" dataType = "{{ $usersTableDefinition[5]->typeData }}">
                        @foreach($usersTableDefinition[5]->options as $index=>$option)
                            @if ($option->id == $user->areaId)
                                {{ $option->description }}
                            @endif
                        @endforeach
                    </td>
                    <td class = "data" tittleHeader = "{{ $usersTableDefinition[6]->tittleHeader }}" dataType = "{{ $usersTableDefinition[6]->typeData }}">
                        @foreach($usersTableDefinition[6]->options as $index=>$option)
                            @if ($option->id == $user->isManager)
                                {{ $option->description }}
                            @endif
                        @endforeach
                    </td>
                    <td class = "data" tittleHeader = "{{ $usersTableDefinition[7]->tittleHeader }}" dataType = "{{ $usersTableDefinition[7]->typeData }}">
                        @foreach($usersTableDefinition[7]->options as $index=>$option)
                            @if ($option->id == $user->isUserActive)
                                {{ $option->description }}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-right">
                        <button class="fontawesomeEdit" id="edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar registro"> <i class="fa-solid fa-pen-to-square"></i> </button>
                    </td>
                </tr>
            @endforeach
        @endisset
    </tbody>
    <tfoot>
        <tr>
            <td class="data" colspan="{{ sizeof($usersTableDefinition) + 1 }}">
                <div class="d-flex justify-content-center" id="paginate">
                    @if ($users->hasPages())
                        {!! $users->links() !!}
                    @else
                        No existe paginación
                    @endif
                </div>
            </td>
        </tr>
    </tfoot>
</table>
