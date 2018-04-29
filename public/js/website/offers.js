
/*
|--------------------------------------------------------------------------
| Socials network sharing popup
|--------------------------------------------------------------------------
*/

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
| Load offers on homepage
|--------------------------------------------------------------------------
*/

var page = 1;

$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page);
    }
});

function loadMoreData(page) {
    $.ajax({
        type: 'GET',
        url: '?page=' + page,
        beforeSend: function() {
            $('.loadScroll').show();
        },
        success: function(response) {
            if (response.html == "") {
                $('.loadScroll').html("<span class='colorPrimary'>Aucune autre offre d'emploi n'a été trouvée.</span>");
                return;
            }

            $('.loadScroll').hide();
            $("#loadOffersContent").append(response.html);
        },
        error: function (response) {
            console.error(response);
            notification('danger', "Une erreur est survenue.");
        }
    });
}

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
            notification('success', "L'offre a été terminée.");
            $button.html('<i class="fa fa-check"></i>');
            $("#offers-content").load(location.href + " #offers-content>*", "");
            $modal.modal('toggle');
        },
        error: function (response) {
            console.error(response);
            notification('danger', "Une erreur est survenue.");
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
            notification('success', "L'offre a été réactivée.");
            $button.html('<i class="fa fa-check"></i>');
            $("#offers-content").load(location.href + " #offers-content>*", "");

            $modal.modal('toggle');
        },
        error: function (response) {
            notification('danger', "Une erreur est survenue.");
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
            notification('success', "L'offre a été supprimée.");
            $button.html('<i class="fa fa-check"></i>');
            $("#offers-content").load(location.href + " #offers-content>*", "");
            $modal.modal('toggle');
        },
        error: function (response) {
            notification('danger', "Une erreur est survenue.");
        },
        complete: function() {
            $button.html($buttonValue);
        }
    });
});