/**SECTION Inicia sección de funciones generales */
//NOTE Función Toogle Button
window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('.sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});

//NOTE Función genérica para peticiones ajax con JQuery
function ajaxRequest(method, url, data, dateType) {
    return $.ajax({
        method: method,
        url: url,
        data: data,
        dateType: dateType,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('.charge').show();
        },
        success: function () {
            $('.charge').hide();

        },
        fail: function (jqXHR, textStatus, errorThrown) {
            ajaxErrorRequest(jqXHR, textStatus, errorThrown);
        }
    });
}

//NOTE Función genérica para controlar errores en las peticiones ajax con JQuery
function ajaxErrorRequest(jqXHR, textStatus, errorThrown) {
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
    $('.error500').show();
    setTimeout(function () {
        $('.modal').modal('hide');
        $('.error500').hide();
    }, 3000);
}
/**!SECTION Finaliza sección de funciones generales */
