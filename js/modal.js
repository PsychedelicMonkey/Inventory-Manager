$('#display-form').click(function() {
    displayProfileModal();
});

function clearModal() {
    $('.modal-wrapper').children().remove()
}

function closeModal() {
    clearModal();
    $('#modal').css('display', 'none');
}

function displayProfileModal() {
    clearModal();
    $('<h2>').attr('class', 'modal-heading').text('Sign Up').appendTo($('.modal-wrapper'));

    $('<form>').attr({
        id: 'form',
        class: 'form',
        action: 'action.php',
        method: 'post'
    }).appendTo($('.modal-wrapper'));

    $('<input>').attr({
        class: 'name',
        type: 'text',
        name: 'name',
        placeholder: 'Name'
    }).appendTo($('#form'));

    $('<span>').attr({
        class: 'error'
    }).css('display', 'none').appendTo($('#form'));

    $('<input>').attr({
        class: 'password',
        type: 'password',
        name: 'password',
        placeholder: 'Password',
    }).appendTo($('#form'));

    $('<span>').attr({
        class: 'error'
    }).css('display', 'none').appendTo($('#form'));

    $('<input>').attr({
        class: 'password_confirm',
        type: 'password',
        name: 'password_confirm',
        placeholder: 'Confirm Password'
    }).appendTo($('#form'));

    $('<span>').attr({
        class: 'error'
    }).css({
        display: 'none',
        marginBottom: '14px'
    }).appendTo($('#form'));

    $('<input>').attr({
        type: 'submit',
        name: 'submit',
        value: 'Sign Up'
    }).appendTo($('#form'));

    $('<button>').attr({
        class: 'cancel',
        type: 'button',
        name: 'cancel',
        onclick: 'closeModal()'
    }).text('Close').appendTo($('#form'));

    $('#modal').css('display', 'block');

    // Real-time validation
    $('.name').focusout(validateName);
    $('.password').focusout(validatePassword);
    $('.password_confirm').focusout(confirmPassword);

    $('#form').submit(function(){
        return validateName() && validatePassword() && confirmPassword();
    });
}

function validateName() {
    if ($('.name').val() == '') {
        $('.error:eq(0)').text('Please enter your name').css('display', 'block');
        return false;
    }
    else {
        $('.error:eq(0)').css('display', 'none');
        return true;
    }
}

function validatePassword() {
    if ($('.password').val() == '') {
        $('.error:eq(1)').text('Please enter a password').css('display', 'block');
        return false;
    }
    else if ($('.password') != '') {
        if ($('.password').val().length < 8) {
            $('.error:eq(1)').text('Password must be at least 8 characters long').css('display', 'block');
            return false;
        }
        else if (!/[a-z]/.test($('.password').val()) || !/[A-Z]/.test($('.password').val()) || !/[0-9]/.test($('.password').val())) {
            $('.error:eq(1)').text('Passwords must contain at least one uppercase letter, one lowercase letter, and one number').css('display', 'block');
            return false;
        }
        else {
            $('.error:eq(1)').css('display', 'none');
            return true;
        }
    }
}

function confirmPassword() {
    if ($('.error:eq(1)').is(':visible')) {
        // Check if password error is visible, then exit
        return false;
    }
    if ($('.password_confirm').val() == '') {
        $('.error:eq(2)').text('Please confirm your password').css('display', 'block');
        return false;
    }
    else if ($('.password_confirm').val() != $('.password').val()) {
        $('.error:eq(2)').text('Passwords do not match!').css({
            color: 'red',
            display: 'block'
        });
        return false;
    }
    else if ($('.password_confirm').val() == $('.password').val()) {
        $('.error:eq(2)').text('Passwords match!').css({
            display: 'block',
            color: 'green'
        });
        return true;
    }
    else {
        $('.error:eq(2)').css('display', 'none');
    }
}
