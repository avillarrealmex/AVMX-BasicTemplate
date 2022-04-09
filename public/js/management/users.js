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
//NOTE Configuración Editar celdas
$(document).on('click', '.edit', function () {
    $(this).parent().siblings('td.data').each(function () {
        var content = $(this).html();
        switch ($(this).attr('dataType')) {
            case 'text':
                $(this).html('<input type="text" value="' + content + '" />');
                break;
            case 'number':
                $(this).html('<input type="number" value="' + content + '" />');
                break;
            case 'email':
                $(this).html('<input type="email" value="' + content + '" />');
                break;
            case 'date':
                $(this).html('<input type="date" value="' + content + '" />');
                break;
            case 'select':
                $(this).html('<select> </select>');
                break;
            case 'radio':
                $(this).html('<input type="radio" value="' + content + '" />');
                break;
            case 'checkbox':
                $(this).html('<input type="checkbox" value="' + content + '" />');
                break;
            default:
                $(this).html(content);
                break;
        }
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
    $('select').each(function () {
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

$(".save").click(function () {
    /* let UserObject = [
        'id' = 0,
        'name' = '',
        'email' = ''
    ];

    tr = $(this).parent().parents('tr');
    UserObject.id = tr.attr('userid');

    $(this).parent().parent().each(function() {
        $(this).find("td").find('input').each(function($tabla){
            if ($tabla.id() === 'name') {
                UserObject.name = $tabla.val()
            }
            if ($tabla.id() === 'email') {
                UserObject.email = $tabla.val()
            }
        });
    });
    console.log(UserObject); */
    /* promise = ajaxRequest('POST', 'delete', UserObject, 'json');

    promise.done(function (data) {
        pintaTabla(data);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        ajaxErrorRequest(jqXHR, textStatus, errorThrown);
    }); */
});


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
