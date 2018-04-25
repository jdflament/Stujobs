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
| Apply accept
|--------------------------------------------------------------------------
*/

// Set approve button href
$(document).on('click', '.btn-pre-accept-apply', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-accept-apply').attr('href', route);
});

// Reset approve button href
$(document).on('hidden.bs.modal', '#modalAcceptApply', function() {
    $(this).find('#btn-accept-apply').attr('href', '#');
});

$(document).on('click', '#btn-accept-apply', function(event) {
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
            alertWidget("#alerts" ,"La candidature a été <strong>correctement</strong> acceptée et envoyée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');

            // Update the apply icon on sidebar
            if (response > 0) {
                $(".totalAppliesInvalid").html(response);
                $(".totalAppliesInvalid").removeClass('hidden');
            } else {
                $(".totalAppliesInvalid").addClass('hidden');
            }

            $('.showCv').html('<span class="smallText">CV : </span>Non');
            $('.applyActions').remove();
            $('.applyStatus').html('<span class="badge bgSuccess">Acceptée</span>');

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

/*
|--------------------------------------------------------------------------
| Apply refuse
|--------------------------------------------------------------------------
*/

// Set disapprove button href
$(document).on('click', '.btn-pre-refuse-apply', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-refuse-apply').attr('href', route);
});

// Reset refuse button href
$(document).on('hidden.bs.modal', '#modalRefuseApply', function() {
    $(this).find('#btn-refuse-apply').attr('href', '#');
});

$(document).on('click', '#btn-refuse-apply', function(event) {
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
            alertWidget("#alerts" ,"La candidature a été <strong>correctement</strong> refusée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');

            // Update the apply icon on sidebar
            if (response > 0) {
                $(".totalAppliesInvalid").html(response);
                $(".totalAppliesInvalid").removeClass('hidden');
            } else {
                $(".totalAppliesInvalid").addClass('hidden');
            }

            $('.showCv').html('<span class="smallText">CV : </span>Non');
            $('.applyActions').remove();
            $('.applyStatus').html('<span class="badge bgDanger">Refusée</span>');

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

            // Update the apply icon on sidebar
            console.log(response);
            if (response > 0) {
                $(".totalAppliesInvalid").html(response);
                $(".totalAppliesInvalid").removeClass('hidden');
            } else {
                $(".totalAppliesInvalid").addClass('hidden');
            }

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

/*
|--------------------------------------------------------------------------
| Applies filter
|--------------------------------------------------------------------------
*/

$(document).on('change', '#filterApplies', function(event) {
    var value = $(this).val();

    $.ajax({
        type: 'GET',
        url: "/dashboard/applies/filter/" + value,
        beforeSend: function() {
            $("#applies-content").find('tbody').html('<tr><td colspan="6" align="center"><i class="fa fa-spinner fa-pulse fa-fw fa-3x"></i></td></tr>');
        },
        success: function (response) {
            $("#applies-content").html($(response).find('#applies-content').html());
            $(".paginationBlock").html($(response).find('.paginationBlock').html());
        },
        error: function(response) {
            console.error(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue pendant le filtrage.</strong> Merci de réessayer ultérieurement.", "alert-danger", 4000);
        }
    });
});