$(document).ready(function() {
    $('#form-username').focusout(function() {
        if ($(this).val() == '') {
            $('#username-error').text('Enter a username').css('display', 'block');
        }
        else {
            $('#username-error').css('display', 'none');
        }
    });

    $('form').submit(function(e) {
        //e.preventDefault();
    });
});
