$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

});

$(document).on('click', '.toggleSidebar', function(event) {
    $('.sidebar').toggleClass('showSidebar hideSidebar');
});