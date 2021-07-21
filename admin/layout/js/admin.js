$(function() {
    "use strict";

    // If you're using a placeholder in your forms
    //$("[placeholder]").focus(function() {
    //    $(this).attr("data-text", $(this).attr("placeholder"));
    //    $(this).attr("placeholder", "");
    //})
    //    .blur(function() {
    //        $(this).attr("placeholder", $(this).attr("data-text"));
    //    });

    // Showing the password if clicking the Eye Icon
    $('.show-password').click(function() {
        if ($(this).hasClass('shown')) {
            $(this).siblings('input[type=text]').attr('type', 'password');
            $(this).removeClass('shown').addClass('hidden');
        } else {
            $(this).siblings('input[type=password]').attr('type', 'text');
            $(this).removeClass('hidden').addClass('shown');
        }
    });

    // Confirming the member's delete
    $('.members-inner-content .confirm').click(function() {
        return confirm('Do you want to delete this user?');
    });

    // Confirming the category's delete
    $('.categories-inner-content .confirm').click(function() {
        return confirm('Do you want to delete this category?');
    });

    // Confirming the item's delete
    $('.items-inner-content .confirm').click(function() {
        return confirm('Do you want to delete this item?');
    });

    // initializing the selectbox plugin
    $("select").selectBoxIt({
        autoWidth: false
    });
});