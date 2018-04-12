/*
|--------------------------------------------------------------------------
| Alerts
|--------------------------------------------------------------------------
*/

// Global widget alert function
function alertWidget(div, message, type, duration) {
    $(div).fadeIn();
    $(div).html('<div class="alert '+ type +'" style="cursor:pointer;" onclick="closeAlert(this)">' + message + '</div>');
    setTimeout(function(){
        $(div).fadeOut();
    }, duration);
}

// Global widget alert close function
function closeAlert(div) {
    $(div).fadeOut();
}

/*
|--------------------------------------------------------------------------
| Apply deletion
|--------------------------------------------------------------------------
*/

// Set delete button href
$(document).on('click', '.btn-pre-delete-apply', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-delete-apply').attr('href', route);
});

// Reset delete button href
$(document).on('hidden.bs.modal', '#modalDeleteApply', function() {
    $(this).find('#btn-delete-apply').attr('href', '#');
});

$(document).on('click', '#btn-delete-apply', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $button = $(this);
    var $buttonValue = $button.html();
    var url = $(this).attr('href');

    $.ajax({
        type: 'GET',
        url: url,
        beforeSend: function() {
            $button.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            alertWidget("#alerts" ,"La candidature a été <strong>correctement</strong> supprimée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
            $("#applies-content").load(location.href + " #applies-content>*", "");
            $modal.modal('toggle');
        },
        error: function (response) {
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de réessayer ultérieurement.", "alert-danger", 4000);
        },
        complete: function() {
            $button.html($buttonValue);
        }
    });
});