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
