<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    include_once ('../include/session.php');
    validateUser();
    
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

        createUser($username, $password);
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
include_once ('../sql/sql.php');
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
            <div class="subsection">
                <h3 class="section-heading">Permissions</h3>
                <input type="checkbox" id="perm-admin" name="perm-admin"> Make this user administrator <br />
                <input type="checkbox" id="perm-pic" name="perm-pic"> Allow this user to change their profile picture <br />
                <input type="checkbox" id="perm-profile" name="perm-profile"> Allow this user to manage their own profile <br />
                <input type="checkbox" id="perm-other" name="perm-other"> Allow this user to manage other users <br />
            </div>
            <input type="submit" name="submit" value="Create User">
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#perm-admin').click(function() {
            adminPerms($(this), '.subsection:eq(0)');
        });

        $('#form-username').focusout(function() {
            validateUsername(this);
        });

        $('#form-password').focusout(function() {
            validatePassword(this);
        });

        $('#form-confirm-password').focusout(function() {
            confirmPassword(this);
        });

        $('form').submit(function(e) {
            return validateUsername($('#form-username')) && validatePassword($('#form-password')) && confirmPassword($('#form-confirm-password'));
        });
    });
</script>
<script src="<?php print DOMAIN; ?>/js/form.js" type="text/javascript"></script>

<?php
include_once ('../include/footer.php');

}
?>