function validateName(username) {
    if ($(username).val() == '') {
        $('#username-error').text('Enter a username').css('display', 'block');
        return false;
    }
    $('#username-error').css('display', 'none');
    return true;
}

function loginPassword(password) {
    if ($(password).val() == '') {
        $('#password-error').text('Please enter a password').css('display', 'block');
        return false;
    }
    $('#password-error').css('display', 'none');
    return true;
}

function validatePassword(password) {
    if ($(password).val() == '') {
        $('#password-error').text('Please enter a password').css('display', 'block');
        return false;
    }
    else if ($(password) != '') {
        if ($(password).val().length < 8) {
            $('#password-error').text('Password must be at least 8 characters long').css('display', 'block');
            return false;
        }
        else if (!/[a-z]/.test($(password).val()) || !/[A-Z]/.test($(password).val()) || !/[0-9]/.test($(password).val())) {
            $('#password-error').text('Passwords must contain at least one uppercase letter, one lowercase letter, and one number').css('display', 'block');
            return false;
        }
        else {
            $('#password-error').css('display', 'none');
            return true;
        }
    }
}

function confirmPassword(confirm) {
    if ($(confirm).val() == '') {
        $('#password-confirm-error').text('Please confirm your password').css('display', 'block');
    }
    else if ($(confirm).val() != $('#form-password').val()) {
        $('#password-confirm-error').text('Passwords do not match!').css({
            color: 'red',
            display: 'block'
        });
    }
    else if ($(confirm).val() == $('#form-password').val()) {
        $('#password-confirm-error').text('Passwords match!').css({
            display: 'block',
            color: 'green'
        });
    }
    else {
        $('#password-confirm-error').css('display', 'none');
    }
}

function adminPerms(check, divElm) {
    var section = $(divElm + ' input[type=checkbox]');
    if (check.prop('checked')) {
        section.each(function() {
            if ($(this).attr('name') == 'perm-admin') return;
            $(this).attr('disabled', true).prop('checked', true);
        });
    }
    else {
        section.each(function() {
            $(this).attr('disabled', false).prop('checked', false);
        });
    }
}