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

// Global widget alert close function
$(document).on('click', '#alertsBack', function(event) {
   event.preventDefault();

    $(this).find('.alert').fadeOut("normal", function() {
        $(this).remove();
    });
});

/*
|--------------------------------------------------------------------------
| Admin creation
|--------------------------------------------------------------------------
*/

// Set inputs values and form action to current admin
$(document).on('click', '.btn-pre-create-admin', function(event) {
    event.preventDefault();

    var $destination = $(this).data('destination');
    var $modal = $('#modalCreateAdmin');

    $modal.find('form').attr('data-destination', $destination);
});

// Ajax admin creation
$(document).on('submit', 'form[name=createAdmin]', function(event) {
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
            alertWidget("#alerts" ,"L'administrateur a été <strong>correctement</strong> créé.", "alert-success", 4000);
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalCreateAdmin>*", "");

            $("#" + destination).load(location.href + " #" + destination + ">*", "");

            $modal.modal('toggle');
        },
        error: function (response) {
            console.log(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de vérifier les champs.", "alert-danger", 4000);
        },
        complete: function(response) {
            $submit.html($submitValue);
        }
    });
});

/*
|--------------------------------------------------------------------------
| Admin edition
|--------------------------------------------------------------------------
*/

// Set inputs values and form action to current address
$(document).on('click', '.btn-pre-edit-admin', function(event) {
    event.preventDefault();

    var $admin = $(this).data('admin');
    var $modal = $('#modalEditAdmin');
    $modal.find('form').attr('action', '/dashboard/admins/' + $admin.id + '/edit');

    for (var key in $admin) {
        var value = $admin[key];
        $modal.find('input[name=edit_' + key + ']').val(value);
        $modal.find('select[name=edit_' + key + ']').val(value);
    }
});

// Ajax admin edition
$(document).on('submit', 'form[name=editAdmin]', function(event) {
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
            alertWidget("#alerts" ,"L'administrateur a été <strong>correctement</strong> modifé.", "alert-success", 4000);
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalEditAdmin>*", "");
            $("#admins-content").load(location.href + " #admins-content>*", "");
            $modal.modal('toggle');
        },
        error: function (response) {
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de vérifier les champs.", "alert-danger", 4000);
        },
        complete: function() {
            $submit.html($submitValue);
        }
    });
});

/*
|--------------------------------------------------------------------------
| Admin deletion
|--------------------------------------------------------------------------
*/

// Set delete button href
$(document).on('click', '.btn-pre-delete-admin', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-delete-admin').attr('href', route);
});

// Reset delete button href
$(document).on('hidden.bs.modal', '#modalDeleteAdmin', function() {
    $(this).find('#btn-delete-admin').attr('href', '#');
});

$(document).on('click', '#btn-delete-admin', function(event) {
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
            alertWidget("#alerts" ,"L'administrateur a été <strong>correctement</strong> supprimé.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
            $("#admins-content").load(location.href + " #admins-content>*", "");
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