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

// Global widget alert close function
$(document).on('click', '#alertsBack', function(event) {
    event.preventDefault();

    $(this).find('.alert').fadeOut("normal", function() {
        $(this).remove();
    });
});


;(function($){
    $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {

        // Prevent default anchor event
        e.preventDefault();

        // Set values for window
        intWidth = intWidth || '500';
        intHeight = intHeight || '400';
        strResize = (blnResize ? 'yes' : 'no');

        // Set title and open popup with focus on it
        var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
            strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,
            objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
    };

    /* ================================================== */

    $(document).ready(function ($) {
        $('.btn-social').on("click", function(e) {
            $(this).customerPopup(e);
        });
    });

}(jQuery));


/*
|--------------------------------------------------------------------------
| Offer complete
|--------------------------------------------------------------------------
*/

// Set approve button href
$(document).on('click', '.btn-pre-complete-offer', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-complete-offer').attr('href', route);
});

// Reset approve button href
$(document).on('hidden.bs.modal', '#modalCompleteOffer', function() {
    $(this).find('#btn-complete-offer').attr('href', '#');
});

$(document).on('click', '#btn-complete-offer', function(event) {
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
            alertWidget("#alerts" ,"L'offre a été <strong>correctement</strong> terminée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
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
| Offer uncomplete
|--------------------------------------------------------------------------
*/

// Set disapprove button href
$(document).on('click', '.btn-pre-uncomplete-offer', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-uncomplete-offer').attr('href', route);
});

// Reset approve button href
$(document).on('hidden.bs.modal', '#modalUncompleteOffer', function() {
    $(this).find('#btn-uncomplete-offer').attr('href', '#');
});

$(document).on('click', '#btn-uncomplete-offer', function(event) {
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
            alertWidget("#alerts" ,"L'offre a été <strong>correctement</strong> ré-activée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
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