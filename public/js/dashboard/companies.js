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

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

/*
|--------------------------------------------------------------------------
| Company creation
|--------------------------------------------------------------------------
*/

// Set inputs values and form action to current admin
$(document).on('click', '.btn-pre-create-company', function(event) {
    event.preventDefault();

    var $destination = $(this).data('destination');
    var $modal = $('#modalCreateCompany');

    $modal.find('form').attr('data-destination', $destination);
});

// Ajax company creation
$(document).on('submit', 'form[name=createCompany]', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $submit = $(this).find('button[type=submit]');
    var $submitValue = $submit.html();
    var form = $(this);
    var destination = form.data('destination');
    var url = form.attr('action');
    var data = form.serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        beforeSend: function() {
            $submit.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            alertWidget("#alerts" ,"L'entreprise a été <strong>correctement</strong> crée. Un email de vérification lui a été envoyé.", "alert-success", 4000);
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalCreateCompany>*", "");
            console.log(response);
            if (destination == "companies-content") {
                $("#" + destination).load(location.href + " #" + destination + ">*", "");
            } else {
                $("#" + destination).find('select option:first').after('<option value="' + response.id + '">' + response.email + ' (' + response.company_name + ') </option>');
                $("#" + destination).find('select').val("" + response.id + "").change();
            }

            $modal.modal('toggle');
        },
        error: function (response) {
            console.log(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de vérifier les champs.", "alert-danger", 4000);
            $.each(response.responseJSON.errors, function (i) {
                $.each(response.responseJSON.errors[i], function (key, val) {
                    $('#' + i).after('<div class="error-message">' + val + '</div>');
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
| Company edition
|--------------------------------------------------------------------------
*/

// Set inputs values and form action to current address
$(document).on('click', '.btn-pre-edit-company', function(event) {
    event.preventDefault();

    var $company = $(this).data('company');
    var $modal = $('#modalEditCompany');
    $modal.find('form').attr('action', '/dashboard/companies/' + $company.id + '/edit');

    for (var key in $company) {
        var value = $company[key];
        $modal.find('input[name=edit_' + key + ']').val(value);
        $modal.find('select[name=edit_' + key + ']').val(value);
    }
});

// Ajax company edition
$(document).on('submit', 'form[name=editCompany]', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $submit = $(this).find('button[type=submit]');
    var $submitValue = $submit.html();
    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        beforeSend: function() {
            $submit.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            alertWidget("#alerts" ,"L'entreprise a été <strong>correctement</strong> modifée.", "alert-success", 4000);
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalEditCompany>*", "");
            $("#companies-content").load(location.href + " #companies-content>*", "");
            $modal.modal('toggle');
        },
        error: function (response) {
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de vérifier les champs.", "alert-danger", 4000);
            $('.error-message').remove();
            $.each(response.responseJSON.errors, function (i) {
                $.each(response.responseJSON.errors[i], function (key, val) {
                    $('#' + i).after('<div class="error-message">' + val + '</div>');
                });
            });
        },
        complete: function() {
            $submit.html($submitValue);
        }
    });
});

/*
|--------------------------------------------------------------------------
| Company deletion
|--------------------------------------------------------------------------
*/

// Set delete button href
$(document).on('click', '.btn-pre-delete-company', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-delete-company').attr('href', route);
});

// Reset delete button href
$(document).on('hidden.bs.modal', '#modalDeleteCompany', function() {
    $(this).find('#btn-delete-company').attr('href', '#');
});

$(document).on('click', '#btn-delete-company', function(event) {
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
            alertWidget("#alerts" ,"L'entreprise a été <strong>correctement</strong> supprimée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
            $("#companies-content").load(location.href + " #companies-content>*", "");
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