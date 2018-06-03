
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

// Check the "all" checkbox or specifics checkboxes, check "all" if nothing checked
function checkManager(checkboxesClass) {
    $(document).on('change', checkboxesClass, function (event) {
        if ($(this).val() == "all") {
            $(checkboxesClass + ':checked').filter(function () {
                return $(this).val() !== "all";
            }).prop('checked', false);
        }

        if ($(this).val() !== "all") {
            $(checkboxesClass + ':checked').filter(function () {
                return $(this).val() == "all";
            }).prop('checked', false);
        }

        var totalChecked = $(checkboxesClass + ':checkbox:checked').length;

        if (totalChecked === 0) {
            $(checkboxesClass + ":checkbox[value=all]").prop("checked","true");
        }

        if (checkboxesClass === ".checkboxContract" || checkboxesClass === ".checkboxSector") {
            $(this).closest('form').submit();
        }
    });
}

checkManager('.checkboxContract');
checkManager('.checkboxSector');

// Detect if an element is in the viewport (screen)
$.fn.isInViewport = function() {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();

    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
};

$(document).on('submit', 'form[name=filterOffer]', function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serialize();
    page = 1;

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(response) {
            $('.boxList').hide().html($(response).find('.boxList').html()).fadeIn();
            $('.loadScroll').html('<button class="buttonActionLg bgPrimary"><i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Chargement des offres...</button>').show();

            // If the load block is on the screen, then load more offers
            if ($('.loadScroll').isInViewport()) {
                page++;
                loadMoreData(page);
            }
        },
        error: function (response) {
            console.error(response);
            notification('danger', "Une erreur est survenue.");
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

        var url = $(this).attr('action');
        var search = $('#valsearch').val();

        if (search) {
            window.location.href = url + '/' + search;
        } else {
            window.location.href = '/';
        }
    })
});