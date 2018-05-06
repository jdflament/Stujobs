/*
|--------------------------------------------------------------------------
| Newsletter register
|--------------------------------------------------------------------------
*/




$( "#newsletterButton" ).on( "click", function(e) {
    e.preventDefault();
    var modal = $('#modalNewsletter');
    modal.modal('toggle');
});

$(document).on('submit', 'form[name=newsletterRegister]', function(event) {
    event.preventDefault();

    var modal = $('#modalNewsletter');
    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,

        success: function(response) {
            modal.modal('toggle');
        },
        error: function (response) {
            console.error(response);
            notification('danger', "Une erreur est survenue. Merci de vérifier les champs.");
            $('.error-message').remove();
            $.each(response.responseJSON.errors, function (i) {
                $.each(response.responseJSON.errors[i], function (key, val) {
                    $('#' + i).after('<div class="error-message">' + val + '</div>');
                });
            });
        },
        complete: function(response) {
        }
    });
});