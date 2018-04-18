// Global widget alert close function
$(document).on('click', '#alertsBack', function(event) {
    event.preventDefault();

    $(this).find('.alert').fadeOut("normal", function() {
        $(this).remove();
    });
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// Socials network sharing popup
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
| Search offers of a company
|--------------------------------------------------------------------------
*/

$(document).on('keyup', '#searchOffersByCompany', function(event) {
    var value = $(this).val();

    if (value == "") {
        $('#companyFilter').val("");
        $('form[name=filterOffer]').submit();
    }
});

$( "#searchOffersByCompany").autocomplete({
    minLength: 1,
    search: function (event, ui) {
        console.log(event);
    },
    source: function (request, response) {
        $.ajax({
            url: '/offers/company/name',
            dataType: 'json',
            data: request,
            success: function (data) {
                response(data.map(function (value) {
                    return {
                        'label': value.name,
                        'id': value.id,
                        'name': value.name
                    };
                }));
            }
        });
    },
    select: function(event, ui) {
        $('#companyFilter').val(ui.item.name);
        $('form[name=filterOffer]').submit();
    }
});

/*
|--------------------------------------------------------------------------
| Filter offer checkboxes
|--------------------------------------------------------------------------
*/

$(document).on('change', '.checkboxContract', function(event) {
    if ($(this).val() == "all") {
        $('.checkboxContract:checked').filter(function() { return $(this).val() !== "all"; }).prop('checked', false);
    }

    if ($(this).val() !== "all") {
        $('.checkboxContract:checked').filter(function() { return $(this).val() == "all"; }).prop('checked', false);
    }

    $(this).closest('form').submit();
});

$(document).on('change', '.checkboxSector', function(event) {
    if ($(this).val() == "all") {
        $('.checkboxSector:checked').filter(function() { return $(this).val() !== "all"; }).prop('checked', false);
    }

    if ($(this).val() !== "all") {
        $('.checkboxSector:checked').filter(function() { return $(this).val() == "all"; }).prop('checked', false);
    }

    $(this).closest('form').submit();
});


$(document).on('submit', 'form[name=filterOffer]', function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(response) {
            $('.boxList').hide().html($(response).find('.boxList').html()).fadeIn();
        },
        error: function (response) {
            console.error(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de réessayer le filtre ultérieurement.", "alert-danger", 4000);
        },
    });
});

/*
|--------------------------------------------------------------------------
| Search URL
|--------------------------------------------------------------------------
*/
$(document).ready(function() {
    $("#search").on('submit', function(e) {
        e.preventDefault();
        window.location.href = '/offers/search/'+$('#valsearch').val();
    })
});