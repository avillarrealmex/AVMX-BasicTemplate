//Función ready
$(document).ready(function(){
    $('#error500').modal('hide');
    if ($('#errorSection').html() && $('#errorSection').is(':visible') && $('#errorSection').css("visibility") != "hidden" ) {
        setTimeout(function () {
            $('#errorSection').slideUp();
        }, 5000);
    }
    if ($('#successSection').html() && $('#successSection').is(':visible') && $('#successSection').css("visibility") != "hidden" ) {
        setTimeout(function () {
            $('#successSection').slideUp();
        }, 5000);
    }
});
