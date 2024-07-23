/** Sección de variables o parámetros iniciales */
const globalPrefix = '/v0.1/test/';
let allowRefresh = false;
let countqueue = 0;

/**SECTION Inicia sección de funciones generales */
$(document).ready(function() {
    $('#sidebarMenu').attr("style", "display: block !important");
    $('#mainContainer').attr("style", "padding-left: 41vh !important");
    /* $('#mainContainer').removeClass('col-md-12 ml-sm-auto col-lg-12 px-4');
    $('#mainContainer').addClass('col-md-9 ml-sm-auto col-lg-10 px-4'); */
});

//NOTE Función botones genericos
$(document).on('click', '#setCountry', function () {
    $('.charge').show();
});

//NOTE mostrar/ ocultar sidebar
$(document).on('click', '#showHideSidebar', function () {
    if ($('#sidebarMenu').is(':visible') && $('#sidebarMenu').css("visibility") != "hidden" ) {
        $('#sidebarMenu').attr("style", "display: none !important");
        $('#mainContainer').attr("style", "padding-left: 0 px !important");
        /* $('#mainContainer').removeClass('col-md-9 ml-sm-auto col-lg-10 px-4');
        $('#mainContainer').addClass('col-md-12 ml-sm-auto col-lg-12 px-4'); */
    } else {
        $('#sidebarMenu').attr("style", "display: block !important");
        $('#mainContainer').attr("style", "padding-left: 41vh !important");
        /* $('#mainContainer').removeClass('col-md-12 ml-sm-auto col-lg-12 px-4');
        $('#mainContainer').addClass('col-md-9 ml-sm-auto col-lg-10 px-4'); */
    }
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

function asyncUploadImage(method, url, data, dateType) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: method,
            url: globalPrefix + url,
            data: data,
            dateType: dateType,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            beforeSend: function(  ) {
                //console.log("inicia carga ");
            },
            success: function(JSONResponse) {
                countqueue--;
                //console.log("termina carga ");
                resolve(JSONResponse)
            },
            error: function(err) {
                console.log("Error carga ");
                reject(err)
            },
        });
    });
}

//NOTE Función petición ajax sin animación de carga
function ajaxRequestWhitNotCharge(method, url, data, dateType, customBeforeSend) {
    return $.ajax({
        method: method,
        url: globalPrefix + url,
        data: data,
        dateType: dateType,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function () {
        },
        fail: function (jqXHR, textStatus, errorThrown) {
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
        if(jqXHR.responseText.message === 'CSRF token mismatch.') {
            window.location.href = window.location.host + globalPrefix + 'logout'
        } else {
            $('.msgErrorAjax').append('Error desconocido, por favor contate al área de TI');
        }
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

function strToCurrency(stringToConvert, minDigits, maxDigits) {
    return new Intl.NumberFormat('es-MX', {
        minimumFractionDigits: minDigits,
        maximumFractionDigits: maxDigits,
        /* style:'currency',
        currency:'MXN', */
    }).format(stringToConvert);
}

function currencyTostr(currencyToConvert) {
    return currencyToConvert.toLocaleString('es-MX').replace(/,/g,'');
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
                if ($(this).attr("currency")) {
                    objectFormData[this.name] = parseFloat(currencyTostr($(this).val()));
                } else {
                    objectFormData[this.name] = $(this).val();
                }
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

function createSelectObject (objectSelect, selectName) {
    let selectElement = "<option value=''>Seleccione una opción</option>";
    objectSelect.forEach(element => {
        selectElement+= "<option value='"+ element.id +"'>"+ element.description +"</option>";
    });
    $('#'+selectName).empty();
    $('#'+selectName).selectpicker('destroy');
    $('#'+selectName).html(selectElement);
    $('#'+selectName).selectpicker('refresh');
}

function errImg(imageId) {
    $('#'+imageId).attr('src','https://intranet.nikken.com.mx:8064/images/logotipo nikken-02.png')
}

function errImgSection(imageId, itemCode) {
    switch (itemCode) {
        case 13541:
            $('#'+imageId).attr('src','https://intranet.nikken.com.mx:8064/images/itemCode/'+itemCode+'.jpg')
            break;
        default:
            $('#'+imageId).attr('src','https://intranet.nikken.com.mx:8064/images/logotipo nikken-02.png');
            break;
    }
}

//Función para mostrar modalAlert
function showMsgAlert(msgAlert) {
    $('.msgAlert').empty();
    $('.msgAlert').append(msgAlert);

    $('#modalAlertMsg').modal('show');
    setTimeout(function () {
        $('#modalAlertMsg').modal('hide');
    }, 2000);
}

//Función cronometro
function chronometer(segundos, divContador) {
    var countSecond = (segundos/100)-1;
    setInterval(function() {
        if (countSecond > 0) {
            $('#'+divContador).html(countSecond);
        }
        countSecond--;
    }, segundos);
}

function generarKeyAletorio(longitud) {
    var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var charactersLength = characters.length;
    var randomString = '';
    for (var i = 0; i < Math.floor(Math.random() * (longitud + 1)); i++) {
        randomString += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return randomString;
}

$(document).on('click', '#startGuide', function () {
    localStorage.setItem("seen_tour", "false");
});

$(document).on('click', '#timeWarranties', function () {
    let ruta = 'https://intranet.nikken.com.mx:8064/images/warranty/TABLA_TIEMPOS_GARANTIAS.pdf';
    window.open(ruta, 'Tiempo garantías Nikken');
});
