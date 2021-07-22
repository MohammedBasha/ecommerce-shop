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
    $('a.confirm').click(function() {
        return confirm('Do you want to continue the deleteion process?');
    });

    // initializing the selectbox plugin
    $("select").selectBoxIt({
        autoWidth: false
    });
});