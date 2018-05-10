
/*
|--------------------------------------------------------------------------
| Change company password
|--------------------------------------------------------------------------
*/

$(document).on('submit', 'form[name=changePassword]', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $submit = $(this).find('button[type=submit]');
    var $submitValue = $submit.html();
    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        beforeSend: function() {
            $submit.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            notification('success', "Votre mot de passe a été modifié.");
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalChangePassword>*", "");

            $modal.modal('toggle');
        },
        error: function (response) {
            notification('danger', "Une erreur est survenue.");
            $('.error').remove();
            $.each(response.responseJSON.errors, function (i) {
                $.each(response.responseJSON.errors[i], function (key, val) {
                    $('#' + i).after('<div class="error">' + val + '</div>');
                });
            });
        },
        complete: function(response) {
            $submit.html($submitValue);
        }
    });
});