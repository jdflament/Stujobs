
/*
|--------------------------------------------------------------------------
| Change company password
|--------------------------------------------------------------------------
*/

$(document).on('submit', 'form[name=changePassword]', function(event) {
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
            notification('success', "Votre mot de passe a été modifié.");
            $submit.html('<i class="fa fa-check"></i>');
            $modal.load(location.href + " #modalChangePassword>*", "");

            $modal.modal('toggle');
        },
        error: function (response) {
            notification('danger', "Une erreur est survenue.");
            $('.error').remove();
            $.each(response.responseJSON.errors, function (i) {
                $.each(response.responseJSON.errors[i], function (key, val) {
                    $('#' + i).after('<div class="error">' + val + '</div>');
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
| Upload logo preview
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| Export company's data
|--------------------------------------------------------------------------
*/

$(document).on('submit', 'form[name=downloadData]', function(event) {
    event.preventDefault();
    var form = $(this);
    var $url = $(this).attr('action');
    var $button = $(this).find('button[type=submit]');
    var formData = new FormData(form[0]);
    var modal = $('#modalDownloadData');
    var url = $('#app').data('url');

    $.ajax({
        url: $url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(){
            $button.html('<i class="fa fa-spinner fa-spin fa-fw"></i> Téléchargement en cours...');
        },
        success: function(response, status, xhr) {
            console.log(response);
            $button.html('<i class="fa fa-check"></i>');
            // check for a filename
            var filename = "";
            var disposition = xhr.getResponseHeader('Content-Disposition');
            if (disposition && disposition.indexOf('attachment') !== -1) {
                var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                var matches = filenameRegex.exec(disposition);
                if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
            }

            var type = xhr.getResponseHeader('Content-Type');
            var blob = new Blob([response], { type: type });

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                window.navigator.msSaveBlob(blob, filename);
            } else {
                var URL = window.URL || window.webkitURL;
                var downloadUrl = URL.createObjectURL(blob);

                if (filename) {
                    // use HTML5 a[download] attribute to specify filename
                    var a = document.createElement("a");
                    // safari doesn't support this yet
                    if (typeof a.download === 'undefined') {
                        window.location = downloadUrl;
                    } else {
                        a.href = downloadUrl;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                    }
                } else {
                    window.location = downloadUrl;
                }

                setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
            }
            modal.modal('hide');
            notification('success', 'Téléchargement réussi');
            setTimeout(function(){  location.href = url; }, 2000);
        },
        error: function (response) {
            console.error(response);
            $button.html('Télécharger');
            notification('danger', 'Une erreur est survenue.');
        },
        complete: function() {
            // $button.html('Valider');
        }
    });
});


/*
|--------------------------------------------------------------------------
| Delete all company's data
|--------------------------------------------------------------------------
*/

$(document).on('submit', 'form[name=deleteData]', function(event) {
    event.preventDefault();

    var modal = $(this).closest('.modal');
    var $submit = $(this).find('button[type=submit]');
    var $submitValue = $submit.html();
    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();
    var url = $('#app').data('url');

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        beforeSend: function() {
            $submit.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            notification('success', "Vos données ont totalement été supprimées.");
            $submit.html('<i class="fa fa-check"></i>');
            modal.modal('hide');
            setTimeout(function(){  location.href = url; }, 1000);
        },
        error: function (response) {
            notification('danger', "Une erreur est survenue.");
            $('.error').remove();
            $.each(response.responseJSON.errors, function (i) {
                $.each(response.responseJSON.errors[i], function (key, val) {
                    $('#' + i).after('<div class="error">' + val + '</div>');
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
| Export guest's data
|--------------------------------------------------------------------------
*/

$(document).on('submit', 'form[name=checkCode]', function(event) {
    event.preventDefault();
    var form = $(this);
    var $url = $(this).attr('action');
    var $button = $(this).find('button[type=submit]');
    var formData = new FormData(form[0]);
    var url = $('#app').data('url');


    $.ajax({
        url: $url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(){
            $button.html('<i class="fa fa-spinner fa-spin fa-fw"></i> Téléchargement en cours...');
        },
        success: function(response, status, xhr) {
            console.log(response);
            $button.html('<i class="fa fa-check"></i>');
            // check for a filename
            var filename = "";
            var disposition = xhr.getResponseHeader('Content-Disposition');
            if (disposition && disposition.indexOf('attachment') !== -1) {
                var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                var matches = filenameRegex.exec(disposition);
                if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
            }

            var type = xhr.getResponseHeader('Content-Type');
            var blob = new Blob([response], { type: type });

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                window.navigator.msSaveBlob(blob, filename);
            } else {
                var URL = window.URL || window.webkitURL;
                var downloadUrl = URL.createObjectURL(blob);

                if (filename) {
                    // use HTML5 a[download] attribute to specify filename
                    var a = document.createElement("a");
                    // safari doesn't support this yet
                    if (typeof a.download === 'undefined') {
                        window.location = downloadUrl;
                    } else {
                        a.href = downloadUrl;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                    }
                } else {
                    window.location = downloadUrl;
                }

                setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
            }
            notification('success', 'Téléchargement réussi');
            setTimeout(function(){  location.href = url; }, 3000);
        },
        error: function (response) {
            console.error(response);
            $button.html('Valider');
            notification('danger', 'Une erreur est survenue.');
            $('.error').remove();
            $.each(response.responseJSON.errors, function (i) {
                $.each(response.responseJSON.errors[i], function (key, val) {
                    $('#' + i).after('<div class="error">' + val + '</div>');
                });
            });
        },
        complete: function() {
            $button.html('Valider');
        }
    });
});

/*
|--------------------------------------------------------------------------
| Delete guest's data
|--------------------------------------------------------------------------
*/

$(document).on('submit', 'form[name=checkCodeDelete]', function(event) {
    event.preventDefault();
    var form = $(this);
    var $url = $(this).attr('action');
    var $button = $(this).find('button[type=submit]');
    var formData = new FormData(form[0]);
    var url = $('#app').data('url');


    $.ajax({
        url: $url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(){
            $button.html('<i class="fa fa-spinner fa-spin fa-fw"></i> Suppression en cours...');
        },
        success: function(response, status, xhr) {
            notification('success', 'Suppresion réussie');
            setTimeout(function(){  location.href = url; }, 3000);
        },
        error: function (response) {
            notification('danger', 'Une erreur est survenue.');
        },
    });
});