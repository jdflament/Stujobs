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
            notification('success', "L'entreprise a été créée. Un email de vérification a été envoyé.");
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalCreateCompany>*", "");

            if (destination == "companies-content") {
                $("#" + destination).load(location.href + " #" + destination + ">*", "");
            } else {
                $("#" + destination).find('select option:first').after('<option value="' + response.id + '">' + response.email + ' (' + response.company_name + ') </option>');
                $("#" + destination).find('select').val("" + response.id + "").change();
            }

            $modal.modal('toggle');
        },
        error: function (response) {
            notification('danger', "Une erreur est survenue. Merci de vérifier les champs.");
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

// Upload preview logo
$(document).on('click', '.logoHover', function(event) {
    $(this).parent().next().click();
});

function fasterPreview(uploader) {
    if (uploader.files && uploader.files[0]){
        $('.logoBox').css("background-image", "url(" + window.URL.createObjectURL(uploader.files[0]) + ")");
    }
}

$("#edit_logo").change(function(){
    fasterPreview(this);
});

// Set inputs values and form action to current address
$(document).on('click', '.btn-pre-edit-company', function(event) {
    event.preventDefault();

    var $company = $(this).data('company');
    var $storage = $(this).data('storage');
    var $modal = $('#modalEditCompany');
    $modal.find('form').attr('action', '/dashboard/companies/' + $company.id + '/edit');

    for (var key in $company) {
        var value = $company[key];
        if (key == 'logo_filename' && value !== null) {
            $('.logoBox').css('background-image', "url(" + $storage + '/' + value + ")");
        } else if (key == 'logo_filename' && value == null) {
            $('.logoBox').css('background-image', "url(" + $storage + "/default-image.png)");
        }
        $modal.find('input[name=edit_' + key + ']').val(value);
        $modal.find('textarea[name=edit_' + key + ']').val(value);
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
    var headers = $(this).find('input[name=_token]').val();
    var formData = new FormData(form[0]);

    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': headers
        },
        beforeSend: function() {
            $submit.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            notification('success', "L'entreprise a été modifiée.");
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalEditCompany>*", "");
            $("#companies-content").load(location.href + " #companies-content>*", "");
            $modal.modal('toggle');
        },
        error: function (response) {
            notification('danger', "Une erreur est survenue. Merci de vérifier les champs.");
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
            notification('success', "L'entreprise a été supprimée.");
            $button.html('<i class="fa fa-check"></i>');
            $("#companies-content").load(location.href + " #companies-content>*", "");
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