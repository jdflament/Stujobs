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

$(document).on('submit', 'form[name=newsletterRegister]', function(event) {
    event.preventDefault();

    var modal = $('#modalNewsletter');
    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,

        success: function(response) {
            alert("coucou");
        },
        error: function (response) {
            console.log(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de vérifier les champs.", "alert-danger", 4000);
            $('.error-message').remove();
            $.each(response.responseJSON.errors, function (i) {
                $.each(response.responseJSON.errors[i], function (key, val) {
                    $('#' + i).after('<div class="error-message">' + val + '</div>');
                });
            });
        },
        complete: function(response) {
        }
    });
});