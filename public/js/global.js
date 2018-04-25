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

// Prevent default disabled class on click
$(document).on('click', '.disabled', function(event) {
    event.preventDefault();
});