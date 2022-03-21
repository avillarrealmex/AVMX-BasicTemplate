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
            $(".error500").hide();
            $('.modal').modal('show');
        },
        success: function () {
            $('.modal').modal('hide');
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

/**SECTION Inicia sección de funciones para el datatable */
//Pintar actualización tabla
function pintaTabla(data) {
    $("#datos > tbody").empty();

    data.users.forEach(element => {
        row = "<tr>"+
            "<td>"+ element.name +"</td>"+
            "<td>"+ element.email +"</td>"+
            "<td>"+ new Date(element.created_at).toLocaleDateString("en-US") +"</td>"+
            "<td>"+ element.isActive +"</td>"+
            "<td class='text-right'></td>"+
        "</tr>";
        $("#datos > tbody").append(row);
    });
}

//NOTE Funciones para controlar el funcionamiento de las celdas
//NOTE Configuración Editar celdas
$(document).on('click', '.edit', function () {
    $(this).parent().siblings('td.data').each(function () {
        var content = $(this).html();
        $(this).html('<input value="' + content + '" />');
    });
    $(this).siblings('.save').show();
    $(this).siblings('.delete').hide();
    $(this).hide();
});

//NOTE Configuración Guardar regitros
$(document).on('click', '.save', function () {
    $('input').each(function () {
        var content = $(this).val();
        $(this).html(content);
        $(this).contents().unwrap();
    });
    $(this).siblings('.edit').show();
    $(this).siblings('.delete').show();
    $(this).hide();
});

//NOTE Configuración Eliminar regitros
$(document).on('click', '.delete', function () {
    $(this).parents('tr').remove();
});

//NOTE Configuración Agregar regitros
$('.add').click(function () {
    $(this).parents('table').append('<tr><td class="data"></td><td class="data"></td><td class="data"></td><td><button class="save">Save</button><button class="edit">Edit</button> <button class="delete">Delete</button></td></tr>');
});
/**!SECTION Finaliza sección de funciones para el datatable */
