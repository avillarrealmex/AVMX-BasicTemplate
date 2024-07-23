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

$(document).on('change', '#cardCode', function () {
    if ($(this).val() !== '') {
        let carCodeObject = new Object();
        carCodeObject['cardCode'] = $(this).val();
        promise = ajaxRequest('POST', 'getCountriesByCardCode', carCodeObject, 'json');
        promise.done(function (JSONResponse) {
            $('#countryId').empty();
            $('#countryId').append('<option value="">Seleccione una opción</option>');
            if (Object.entries(JSONResponse)) {
                $('#countryId').attr('disabled', false);
                Object.entries(JSONResponse).forEach(([countryKey, country]) => {
                    $('#countryId').append('<option value="'+ country.id +'" flag="'+ country.flagpath +'" >'+ country.CountryName +'</option>');
                });
            } else {
                $('#countryId').attr('disabled', true);
            }

        }).fail(function (jqXHR, textStatus, errorThrown) {
            $('.charge').hide();
            ajaxErrorRequest(jqXHR, textStatus, errorThrown);
            window.location.href = window.location.host + globalPrefix + 'logout'
        });
    }
});

$(document).on('change', '#countryId', function () {
    $('#flagCountry').attr('src', $(this).children("option:selected").attr('flag'));
});
