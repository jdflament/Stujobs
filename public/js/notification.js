function notification(type, message){

    var numItems = $('.notificationAlert').length;

    var div = '<div id="notification-'+numItems+'" class="notificationAlert '+type+'Alert" style="top:'+(90+70*numItems)+'px">'+message+'<span aria-hidden="true">&times;</span></div>';

    $(div).prependTo('body');
    $("#notification-" + numItems).animate({
        right: "15px",
    }, 140);

    setTimeout(function(){
        $('#notification-'+numItems).hide('slow');
        $('#notification-'+numItems).remove();
        $('.notificationAlert').css('top', function() {
            var num = parseInt($(this).css('top')) - 70;
            return num.toString() + 'px';
        });
    },8000);

}

$(document).on('click', '.notificationAlert', function () {
    $(this).animate({
        right: "-315px",
    }, 140, function() {
        $(this).remove();
    });
});