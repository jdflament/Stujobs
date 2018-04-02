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
            alertWidget("#alerts" ,"Le mot de passe a été <strong>correctement</strong> modifié.", "alert-success", 4000);
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalChangePassword>*", "");

            $modal.modal('toggle');
        },
        error: function (response) {
            alertWidget("#alerts" ,"Une erreur est survenue. Merci de <strong>réessayer</strong> ultérieurement.", "alert-danger", 4000);
            $('.error-message').remove();
            $.each(response.responseJSON.errors, function (i) {
                $.each(response.responseJSON.errors[i], function (key, val) {
                    $('#' + i).after('<div class="error-message">' + val + '</div>');
                });
            });
        },
        complete: function(response) {
            $submit.html($submitValue);
        }
    });
});