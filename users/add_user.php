<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    session_start();
    if (!isset($_SESSION['uid']) && !isset($_SESSION['username']))
    {
        print 'You do not have permission to access this page.';
        exit();
    }
    
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm-password']))
    {
        include_once ('users.php');

        $username = mysqli_real_escape_string($db, strip_tags($_POST['username']));
        $password = mysqli_real_escape_string($db, strip_tags($_POST['password']));
        $confirm_password = mysqli_real_escape_string($db, strip_tags($_POST['confirm-password']));

        if (existsInDB("SELECT * FROM users WHERE username LIKE '$username'"))
        {
            print 'Username: \'' . $username . '\' already exists.';
            exit();
        }

        if ($password != $confirm_password)
        {
            print 'Passwords do not match!';
            exit();
        }

        addUser($username, $password);
    }
    else
    {
        print 'One or more of the required fields is empty.';
    }
}
else
{

define ('PAGE', 'Manage Users');
define ('SUB_PAGE', 'Add New User');
include_once ('../include/header.php');
?>

<div class="body-wrapper">
    <div class="section">
        <h2 class="section-heading">Add User</h2>
        <form action="add_user.php" method="post">
            <input type="text" id="form-username" name="username" placeholder="Username">
            <span id="username-error" class="error"></span>
            <input type="password" id="form-password" name="password" placeholder="Password">
            <span id="password-error" class="error"></span>
            <input type="password" id="form-confirm-password" name="confirm-password" placeholder="Confirm Password">
            <span id="password-confirm-error" class="error"></span>
            <input type="submit" name="submit" value="Create User">
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#form-username').focusout(function() {
        validateName(this);
    });
    
    $('#form-password').focusout(function() {
        validatePassword(this);
    });

    $('#form-confirm-password').focusout(function() {
        confirmPassword(this);
    });

    $('form').submit(function(e) {
        return validateName($('#form-username')) && validatePassword($('#form-password')) && confirmPassword($('#form-confirm-password'));
    });
});
</script>
<script src="<?php print DOMAIN; ?>/js/form.js" type="text/javascript"></script>

<?php
include_once ('../include/footer.php');

}
?>