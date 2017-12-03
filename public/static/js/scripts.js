$(document).ready(function () {

    $('.message').each(function () {
        $(this).wrapInner('<p class="text"></p>');
        $(this).append('<i class="close"></i>');
    })

    $('.message .close').on('click', function () {
        $(this).closest('.message').remove();
    })

    $('.datetime').mask('0000/00/00 00:00');

})