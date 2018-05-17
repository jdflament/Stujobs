
/*
|--------------------------------------------------------------------------
| Apply for an offer
|--------------------------------------------------------------------------
*/

$(document).on('submit', 'form[name=applyOffer]', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $submit = $(this).find('button[type=submit]');
    var $submitValue = $submit.html();
    var form = $(this);
    var url = form.attr('action');
    var headers = $(this).find('input[name=_token]').val();
    var formData = new FormData(form[0]);

    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': headers
        },
        beforeSend: function() {
            $submit.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            notification('success', "Votre candidature a été prise en compte et va être traitée.");
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalApply>*", "");

            $modal.modal('toggle');
        },
        error: function (response) {
            console.error(response);
            notification('danger', "Une erreur est survenue. Merci de vérifier les champs.");
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

/*
|--------------------------------------------------------------------------
| Applies filter
|--------------------------------------------------------------------------
*/

$(document).on('change', '#filterApplies', function(event) {
    var value = $(this).val();

    $.ajax({
        type: 'GET',
        url: "/profile/applies/filter/" + value,
        beforeSend: function() {
            $("#applies-content").find('tbody').html('<tr><td colspan="6" align="center"><i class="fa fa-spinner fa-pulse fa-fw fa-3x"></i></td></tr>');
        },
        success: function (response) {
            $("#applies-content").html($(response).find('#applies-content').html());
            $(".paginationBlock").html($(response).find('.paginationBlock').html());
        },
        error: function(response) {
            console.error(response);
            notification('danger', "Une erreur est survenue lors du filtre.");
        }
    });
});