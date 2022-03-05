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


$(".search").keyup(function(){
    rastreator($(this));
});
$(".search").keydown(function(){
    rastreator($(this));
});
function rastreator(elem){
    var rastrear="#datos tbody tr ."+elem.attr("busqueda");
    var contenido=elem.val();
    $(rastrear).each(function(){
        var texto=$(this).text();
        if(texto.startsWith(contenido)){
            $(this).parents("tr").show();
        }else{
            $(this).parents("tr").hide();
        }
    });
}

//NOTE Función genérica para peticiones ajax con JQuery
function ajaxRequest(method, url, data, dateType) {
    var ajaxResponse;

    $.ajax({
        method: method,
        url: url,
        data: data,
        dateType: dateType
    }).done(function(data) {
        ajaxResponse = data;
    }).fail( function( jqXHR, textStatus, errorThrown ) {

        if (jqXHR.status === 0) {
            ajaxResponse = {
                error: 'No concetado: verifique su conexión'
            }
        } else if (jqXHR.status == 404) {
          ajaxResponse = {
                error: '[404]: el servicio no existe'
            }
        } else if (jqXHR.status == 500) {
          ajaxResponse = {
                error: '[500]: Error interno del servidor'
            }
        } else if (textStatus === 'parsererror') {
          ajaxResponse = {
                error: 'JSON enviado erroneo'
            }
        } else if (textStatus === 'timeout') {
          ajaxResponse = {
                error: 'Se agoto el tiempo de espera de la petición'
            }
        } else if (textStatus === 'abort') {
          ajaxResponse = {
                error: 'La petición fue abortada por el servidor'
            }
        } else {
          ajaxResponse = {
                error: 'Error desconocido: ' + jqXHR.responseText
            }
        }
    }).always(function() {
        ajaxResponse = {
            error: 'El proceso se ha ciclado'
        }
    });

    return ajaxResponse;
}
