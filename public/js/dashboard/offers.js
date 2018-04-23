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
| Offer approve
|--------------------------------------------------------------------------
*/

// Set approve button href
$(document).on('click', '.btn-pre-approve-offer', function(event) {
    event.preventDefault();
    var route = $(this).data('href');
    var offerid = $(this).data('offerid');

    $('#btn-approve-offer').attr('href', route);
    $('#btn-approve-offer').attr('data-offerid', offerid)
});

// Reset approve button href
$(document).on('hidden.bs.modal', '#modalApproveOffer', function() {
    $(this).find('#btn-approve-offer').attr('href', '#');
});

$(document).on('click', '#btn-approve-offer', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $button = $(this);
    var $buttonValue = $button.html();
    var url = $(this).attr('href');
    var offer_id = $(this).attr('data-offerid');

    $.ajax({
        type: 'GET',
        url: url,
        beforeSend: function() {
            $button.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            alertWidget("#alerts" ,"L'offre a été <strong>correctement</strong> approuvée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
            $("#offers-content").load(location.href + " #offers-content>*", "");

            // Update the offer icon on sidebar
            if (response > 0) {
                $(".totalOffersInvalid").html(response);
                $(".totalOffersInvalid").removeClass('hidden');
            } else {
                $(".totalOffersInvalid").addClass('hidden');
            }

            $('.offerActions').html('<button data-href="/dashboard/offers/' + offer_id + '/disapprove" data-offerid="' + offer_id + '" class="buttonActionLg bgDanger btn-pre-disapprove-offer" data-toggle="modal" data-target="#modalDisapproveOffer">\n' +
                '                       <i class="fa fa-times"></i> Désapprouver l\'offre\n' +
                '                    </button>');
            $('.validStatus').html('<span class="badge bgSuccess">Approuvée</span>');
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
| Offer disapprove
|--------------------------------------------------------------------------
*/

// Set disapprove button href
$(document).on('click', '.btn-pre-disapprove-offer', function(event) {
    event.preventDefault();
    var route = $(this).data('href');
    var offerid = $(this).data('offerid');

    $('#btn-disapprove-offer').attr('href', route);
    $('#btn-disapprove-offer').attr('data-offerid', offerid);
});

// Reset approve button href
$(document).on('hidden.bs.modal', '#modalDisapproveOffer', function() {
    $(this).find('#btn-disapprove-offer').attr('href', '#');
});

$(document).on('click', '#btn-disapprove-offer', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $button = $(this);
    var $buttonValue = $button.html();
    var url = $(this).attr('href');
    var offer_id = $(this).attr('data-offerid');

    $.ajax({
        type: 'GET',
        url: url,
        beforeSend: function() {
            $button.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            alertWidget("#alerts" ,"L'offre a été <strong>correctement</strong> désapprouvée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
            $("#offers-content").load(location.href + " #offers-content>*", "");

            // Update the offer icon on sidebar
            if (response > 0) {
                $(".totalOffersInvalid").html(response);
                $(".totalOffersInvalid").removeClass('hidden');
            } else {
                $(".totalOffersInvalid").addClass('hidden');
            }

            $('.offerActions').html('<button data-href="/dashboard/offers/' + offer_id + '/approve" data-offerid="' + offer_id + '" class="buttonActionLg bgSuccess btn-pre-approve-offer" data-toggle="modal" data-target="#modalApproveOffer">\n' +
                '                       <i class="fa fa-check"></i> Approuver l\'offre\n' +
                '                    </button>');
            $('.validStatus').html('<span class="badge bgDanger">Désapprouvée</span>');
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
| Offer deletion
|--------------------------------------------------------------------------
*/

// Set delete button href
$(document).on('click', '.btn-pre-delete-offer', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-delete-offer').attr('href', route);
});

// Reset delete button href
$(document).on('hidden.bs.modal', '#modalDeleteOffer', function() {
    $(this).find('#btn-delete-offer').attr('href', '#');
});

$(document).on('click', '#btn-delete-offer', function(event) {
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
            console.log(response);
            alertWidget("#alerts" ,"L'offre a été <strong>correctement</strong> supprimée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');

            // Update the offer icon on sidebar
            if (response[0] > 0) {
                $(".totalOffersInvalid").html(response[0]);
                $(".totalOffersInvalid").removeClass('hidden');
            } else {
                $(".totalOffersInvalid").addClass('hidden');
            }

            // Update the apply icon on sidebar
            if (response[1] > 0) {
                $(".totalAppliesInvalid").html(response[1]);
                $(".totalAppliesInvalid").removeClass('hidden');
            } else {
                $(".totalAppliesInvalid").addClass('hidden');
            }

            $("#offers-content").load(location.href + " #offers-content>*", "");
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
| Offers filter
|--------------------------------------------------------------------------
*/

$(document).on('change', '#filterOffers', function(event) {
    var value = $(this).val();

    $.ajax({
        type: 'GET',
        url: "/dashboard/offers/filter/" + value,
        beforeSend: function() {
            $("#offers-content").find('tbody').html('<tr><td colspan="6" align="center"><i class="fa fa-spinner fa-pulse fa-fw fa-3x"></i></td></tr>');
        },
        success: function (response) {
            $("#offers-content").html($(response).find('#offers-content').html());
        },
        error: function(response) {
            console.error(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue pendant le filtrage.</strong> Merci de réessayer ultérieurement.", "alert-danger", 4000);
        }
    });
});