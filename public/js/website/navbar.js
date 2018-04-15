$(document).on('click', '.mobileMenuAction', function(event) {
    event.preventDefault();
    $('.popupMenu').toggleClass('hideMenu showMenu');
});

$(document).on('click', '.navbarDropdownAction', function(event){
    event.preventDefault();
    $('.navbarDropdownMenu').toggleClass('hideDropdown showDropdown');
    $(this).find('.caret').toggleClass('noRotate rotate');
});