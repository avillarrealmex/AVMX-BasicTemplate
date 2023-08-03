/** Sección de variables o parámetros iniciales */
const globalPrefix = '/v0.1/test/';

/**SECTION Inicia sección de funciones generales */
//NOTE Función botones genericos
$(document).on('click', '#sendForm', function () {
    $('.charge').show();
});

//NOTE Función genérica para peticiones ajax con JQuery
function ajaxRequest(method, url, data, dateType) {
    return $.ajax({
        method: method,
        url: globalPrefix + url,
        data: data,
        dateType: dateType,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        beforeSend: function () {
            $('.charge').show();
        },
        success: function () {
            $('.charge').hide();
        },
        fail: function (jqXHR, textStatus, errorThrown) {
            $('.charge').hide();
            ajaxErrorRequest(jqXHR, textStatus, errorThrown);
        }
    });
}

//NOTE Función genérica para peticiones ajax con JQuery
function ajaxRequestWithFiles(method, url, data, dateType) {
    return $.ajax({
        method: method,
        url: globalPrefix + url,
        data: data,
        dateType: dateType,
        contentType: false,
        processData: false,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        beforeSend: function () {
            $('.charge').show();
        },
        success: function () {
            $('.charge').hide();
        },
        fail: function (jqXHR, textStatus, errorThrown) {
            $('.charge').hide();
            ajaxErrorRequest(jqXHR, textStatus, errorThrown);
        }
    });
}

//NOTE Función genérica para controlar errores en las peticiones ajax con JQuery
function ajaxErrorRequest(jqXHR, textStatus, errorThrown) {
    $('.msgErrorAjax').empty();
    if (jqXHR.status === 0) {
        $('.msgErrorAjax').append('La petición no se pudo realizar, por favor verifique su conexión a internet');
    } else if (jqXHR.status == 404) {
        $('.msgErrorAjax').append('Error 404, el recurso solicitado no existe, por favor contate al área de TI');
    } else if (jqXHR.status == 500) {
        console.log("Error 500 \nProceso no Completado contacte Sistemas\n" + JSON.stringify(jqXHR.responseText));
        $('.msgErrorAjax').append('Error interno del servidor, por favor contacte al área de TI');
    } else if (textStatus === 'parsererror') {
        $('.msgErrorAjax').append('El JSON no cuenta con los atributos correctos, por favor contate al área de TI');
    } else if (textStatus === 'timeout') {
        $('.msgErrorAjax').append('El tiempo de espera supero al servidor, por favor reintentelo en 5 min');
    } else if (textStatus === 'abort') {
        $('.msgErrorAjax').append('La petición Ajax fue abortada, por favor reintentelo en 5 min');
    } else {
        console.log('Uncaught Error: ' + jqXHR.responseText);
        $('.msgErrorAjax').append('Error desconocido, por favor contate al área de TI');
    }
    $('#error500').modal('show');
    setTimeout(function () {
        $('#error500').modal('hide');
    }, 5000);
}

//Función para convertir los datos de un Form Serialize a objeto
function convertSerializeToObject(serialize) {
    var data = serialize.split("&");
    var obj = new Object();
    for(var key in data) {
        obj[data[key].split("=")[0]] = data[key].split("=")[1];
    }
    return obj;
}
/**!SECTION Finaliza sección de funciones generales */

//NOTE Función transformar string to date format yyyymmdd hh:mm:ss.v
function strToDate(dateToConvert) {
    if (dateToConvert != null) {
        const year = +dateToConvert.substring(0, 4);
        const month = +dateToConvert.substring(4, 6);
        const day = +dateToConvert.substring(6, 8);
        //newDate = new Date(year, month - 1, day);
        monthToIntput = (month) < 9 ? '0' + (month) : month;
        dayToIntput = (day) < 9 ? '0' + (day) : day;
        return year+'-'+monthToIntput+'-'+dayToIntput;
    } else {
        return null;
    }
}

function strToCurrency(stringToConvert) {
    return new Intl.NumberFormat('es-MX').format(stringToConvert);
}

function currencyTostr(currencyToConvert) {
    return currencyToConvert.toLocaleString().replace(/\D/g,'');
}

//NOTE Función borrar formulario
function clearForm(formName) {
    $('#'+formName).find("select, textarea, input").each(function() {
        switch (this.type) {
            case('text'):
            case('textarea'):
            case('password'):
            case('number'):
            case('date'):
            case('datetime-local'):
            case('email'):
            case('file'):
                $('#'+this.id).val('');
            break;
            case('select-one'):
            case('radio'):
                $('#'+this.id).find('option[value=""').prop("selected", "selected");
            break;
            case('checkbox'):
                $(this).prop('checked', false);
            break;
            case('hidden'):
                if (this.getAttribute("name") !== '_token') {
                    $('#'+this.id).val('newRegister');
                }
            break;
            default:
                break;
        }
    });
}

//NOTE Función para obtener el objeto de datos que este dentro de un form
//solo funcionará si eestan dentro del form
function getObjectFormData(formName) {
    var objectFormData = {};

    $('#'+formName).find("select, textarea, input").each(function() {
        switch (this.type) {
            case('text'):
            case('textarea'):
            case('password'):
            case('number'):
            case('date'):
            case('datetime-local'):
            case('email'):
            case('file'):
            case('hidden'):
                objectFormData[this.name] = $(this).val();
            break;
            case('select-one'):
            case('radio'):
                var object = {};
                object['value'] = $(this).val();
                object['text'] = $(this).children("option:selected").text();
                objectFormData[this.name] = object;
            break;
            case('checkbox'):
            break;
            default:
                break;
        }
    });
    return objectFormData;
}

//NOTE Función que controla el cambio de tabla/formulario
function changeControlButton(action, tittleDiv, tittleActionButton, divFromClear) {
    $('.charge').show();
    $('.forms-Nikken').toggle("slow");
    $('.tables-Nikken').toggle("slow");
    setTimeout(function () {
        if ($('.forms-Nikken').is(':visible')) {
            $("#paginateSpan").hide();
            $("#tableOrForm").find('span').text("Tabla");
            $("#tableOrForm").find('i').removeClass('fa-solid fa-file-circle-plus').addClass('fa-solid fa-table');
            switch (action) {
                case 'create':
                    clearForm(divFromClear);
                    $('#formTittle').html('<h4 class="form formTittle">'+tittleDiv+'</h4>');
                    $("#sendForm").find('span').text(' '+tittleActionButton);
                    break;
                case 'createWithErrors':
                    $('#formTittle').html('<h4 class="form formTittle">'+tittleDiv+'</h4>');
                    $("#sendForm").find('span').text(' '+tittleActionButton);
                    break;
                case 'update':
                    $('#formTittle').html('<h4 class="form formTittle">'+tittleDiv+'</h4>');
                    $("#sendForm").find('span').text(' '+tittleActionButton);
                    break;
                default:
                    break;
            }
        } else {
            $("#paginateSpan").show();
            $("#tableOrForm").find('span').text("Crear");
            $("#tableOrForm").find('i').removeClass('fa-solid fa-table').addClass('fa-solid fa-file-circle-plus');
        }
        $('.charge').hide();
    }, 1500);
}

//NOTE Función pinta tabla generica Nikken
/**
 * En peticiones Ajax que construya una tablaNikken el JSON a construir siempre deberá llevar 2 parámetros dataForTable y tableDefinition
 * @param {*} tableName
 * @param {*} JSONRequest
 */
function pintaTablaNikken(tableName, tittleName, JSONRequest, styleForm) {
    //Construimos la sección del thead parámetro tableDefinition
    let thead, tbody = '';
    $("#tittleModal").html('<h4> '+ tittleName +' </h4>');
    $("#"+tableName+" > thead").empty();
    thead+='<tr>';
        for (let columIndex = 0; columIndex < Object.keys(JSONRequest.tableDefinition).length; columIndex++) {
            if (JSONRequest.tableDefinition[columIndex].typeData !== 'hidden') {
                thead+='<th class="tittleSection" scope="col"> '+ JSONRequest.tableDefinition[columIndex].tittleColumn +' </th>';
            }
        }
        thead+='<th class="tittleSection" scope="col"> Acciones </th>'+
    '</tr>'+
    '<tr>';
        for (let columIndex = 0; columIndex < Object.keys(JSONRequest.tableDefinition).length; columIndex++) {
            if (JSONRequest.tableDefinition[columIndex].canFilter) {
                switch(JSONRequest.tableDefinition[columIndex].typeData) {
                    case 'select':
                    thead+='<th class="form findSection" scope="col">'+
                            '<select class="'+ styleForm +'" id="searchNikken" tittleHeader = "'+ JSONRequest.tableDefinition[columIndex].tittleHeader +'">';
                                if (JSONRequest.findFilters[JSONRequest.tableDefinition[columIndex].tittleHeader] === null ) {
                                    thead+='<option value="" selected>Seleccione una opción</option>';
                                    JSONRequest.tableDefinition[columIndex].options.forEach(option => {
                                        thead+='<option value='+ option.id +'>'+ option.description +'</option>';
                                    });
                                } else {
                                    thead+='<option value="">Seleccione una opción</option>';
                                    JSONRequest.tableDefinition[columIndex].options.forEach(option => {
                                        if (option.id == JSONRequest.findFilters[JSONRequest.tableDefinition[columIndex].tittleHeader] ) {
                                            thead+='<option value='+ option.id +' selected>'+ option.description +'</option>';
                                        } else {
                                            thead+='<option value='+ option.id +'>'+ option.description +'</option>';
                                        }
                                    });
                                }
                            thead+='</select>'+
                        '</th>';
                    break;
                    case 'text':
                    case 'number':
                    case 'date':
                    case 'datetime-local':
                    case 'email':
                        if (JSONRequest.findFilters[JSONRequest.tableDefinition[columIndex].tittleHeader]) {
                            thead+='<th class="form findSection" scope="col">'+
                                '<input class="'+ styleForm +'"id="searchNikken" type="'+ JSONRequest.tableDefinition[columIndex].typeData +'" tittleHeader = "'+ JSONRequest.tableDefinition[columIndex].tittleHeader +'" value="'+ JSONRequest.findFilters[JSONRequest.tableDefinition[columIndex].tittleHeader] +'">'+
                            '</th>';
                        } else {
                            thead+='<th class="form findSection" scope="col">'+
                                '<input class="'+ styleForm +'"id="searchNikken" type="'+ JSONRequest.tableDefinition[columIndex].typeData +'" tittleHeader = "'+ JSONRequest.tableDefinition[columIndex].tittleHeader +'">'+
                            '</th>';
                        }
                    break;
                    case 'hidden':
                        thead+='<input class="'+ styleForm +'"id="'+ JSONRequest.tableDefinition[columIndex].tittleHeader +'" type="text" tittleHeader = "'+ JSONRequest.tableDefinition[columIndex].tittleHeader +'">';
                    break;
                    default:
                        thead+='<th class="form bg-light" scope="col"></th>';
                    break;
                }
            } else {
                if (JSONRequest.tableDefinition[columIndex].typeData !== 'hidden') {
                    thead+='<th class="form bg-light" scope="col"></th>';
                }
            }
        }
        thead+='<th class="form bg-light">'+
            '<button type="button" class="btn fontawesomeAddRegister" id="addRegister" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver valor de la divisa"> <i class="fa-solid fa-file-circle-plus"></i> </button>'+
        '</th>'+
    '</tr>';
    $("#"+tableName+" > thead").append(thead);

    //Construimos el cuerpo de la tabla parámetro dataForTable
    /* $("#"+tableName+" > tbody").empty(); */


            /* @foreach ($currencies as $currency)
                <tr currencyId = {{ isset($currency->id) ? $currency->id : 0 }}>
                    <td class = "data" tittleHeader = "{{ $currenciesTableDefinition[1]->tittleHeader }}" dataType = "{{ $currenciesTableDefinition[1]->typeData }}">{{ isset($currency->currencyKey) ? $currency->currencyKey : '' }}</td>
                    <td class = "data" tittleHeader = "{{ $currenciesTableDefinition[2]->tittleHeader }}" dataType = "{{ $currenciesTableDefinition[2]->typeData }}">{{ isset($currency->currencyName) ? $currency->currencyName : '' }}</td>
                    <td class = "data" tittleHeader = "{{ $currenciesTableDefinition[3]->tittleHeader }}" dataType = "{{ $currenciesTableDefinition[3]->typeData }}">
                        @foreach($currenciesTableDefinition[3]->options as $index=>$option)
                            @if ($option->id == $currency->isCurrencyActive)
                                {{ $option->description }}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-right">
                        <button type="button" class="btn fontawesomeEdit"  id="edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar registro"> <i class="fa-solid fa-pen-to-square"></i> </button>
                        <button type="button" class="btn fontawesomeCoins" id="valueCurrency" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver valor de la divisa"> <i class="fa-solid fa-coins"></i> </button>
                    </td>
                </tr>
            @endforeach */
}

//NOTE Fución ocupada para la opción de busqueda en la tabla
$(document).on('change', '#searchNikken', function () {

});
