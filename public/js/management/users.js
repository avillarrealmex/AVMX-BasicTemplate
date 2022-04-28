$(".search").change(function () {
    let findJSON = new Object();
    $(this).parent().parent().each(function() {
        $(this).find("th").find('input').each(function(){
            if ($(this).val() !== '') {
                findJSON[$(this).attr('tittleHeader')] = $(this).val();
            }
        });
    })

    promise = ajaxRequest('POST', 'index', findJSON, 'json');

    promise.done(function (data) {
        pintaTabla(data);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        ajaxErrorRequest(jqXHR, textStatus, errorThrown);
    });
});

$(document).ready(function(){
    $('body').on('click', '#btn-color-targets > .btn', function(){
        var color = $(this).data('target-color');
        $('#modalColor').attr('data-modal-color', color);
        $('.modal').modal('show');
    });
});

//NOTE Funciones para controlar el funcionamiento de las celdas
//NOTE Crear nuevo usuario
$(document).on('click', '.newUser', function () {
    //Limpiamos el formulario
    $('#name').empty();
    $('#email').empty();
    $('#mangementUser').modal('show'); //Muestrame el modal
});
//NOTE Configuración Editar celdas
$(document).on('click', '.edit', function () {
    $('#mangementUser').modal('show'); //Muestrame el modal

    userId = $(this).parent().parent().attr('userid');
    $('#id').val(userId);
    //Recorre la fila de donde se clickeo el botón edit
    $(this).parent().siblings('td.data').each(function () {
        //por cada td.data guarda en content el valor de esa celda
        var tittleheader = $(this).attr('tittleheader'); //Obtenemos el nombre del campo para instanciarlo en el formulario
        var content = $(this).html().trim(); //Obtenemos el valor de la celda
        $('#'+tittleheader).val(content);//Asignamos el valor al input del formulario
    });
});

//NOTE Configuración Eliminar regitros
$(document).on('click', '.delete', function () {
    let UserObject = {
        'id': $(this).parent().parent().attr('userid') //Obtenemos el Id del registro a eliminar
    }
    $(this).parents('tr').remove();//Si la respuesta es satisfactoria, eliminamos la fila
    promise = ajaxRequest('POST', 'delete', UserObject, 'json'); //Instanciamos función ajaxRequest de NikkenJS
    promise.done(function (data) {

    }).fail(function (jqXHR, textStatus, errorThrown) {
        ajaxErrorRequest(jqXHR, textStatus, errorThrown);
    });

});

/* //NOTE Configuración Guardar regitros
$(document).on('click', '.save', function () {
    $('input').each(function () {
        var content = $(this).val();
        $(this).html(content);
        $(this).contents().unwrap();
    });
    $('select').each(function () {
        var content = $(this).val();
        $(this).html(content);
        $(this).contents().unwrap();
    });
    $(this).siblings('.edit').show();
    $(this).siblings('.delete').show();
    $(this).hide();
}); */

/* //NOTE Configuración Agregar regitros
$('.add').click(function () {
    $(this).parents('table').append('<tr><td class="data"></td><td class="data"></td><td class="data"></td><td><button class="save">Save</button><button class="edit">Edit</button> <button class="delete">Delete</button></td></tr>');
}); */

/**SECTION  Inician funciones especiales*/
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
/**!SECTION  */
