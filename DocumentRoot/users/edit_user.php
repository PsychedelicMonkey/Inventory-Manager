<?php
include_once ('../include/includes.php');

if (isset($_GET['uid']) && is_numeric($_GET['uid']) && ($_GET['uid'] > 0) && !empty($_GET['username']))
{
    include_once ('users.php');
    $user = getUser($_GET['uid'], $_GET['username']);
    
    define ('PAGE', 'Manage Users');
    define ('SUB_PAGE', 'Edit ' . ucfirst($user['username']));
    include_once ('../include/header.php');
    
    $_SESSION['edit_uid'] = $user['uid'];
    $_SESSION['edit_username'] = $user['username'];
    
    ?>
        <div class="body-wrapper">
            <div class="section">
                <h2 class="form-heading">Edit <?php print ucfirst($user['username']); ?></h2>
                <form action="edit_user.php" method="post">
                    <input type="text" name="username" placeholder="Username" value="<?php print $user['username']; ?>">
                    <p><input type="checkbox" name="enabled" <?php if ($user['enabled'] == 1) print 'checked'; ?>> User is enabled</p>
                    <div class="subsection">
                        <h3 class="section-heading">Permissions</h3>
                        <input type="checkbox" id="perm-admin" name="perm-admin"> Make this user administrator <br />
                        <input type="checkbox" id="perm-pic" name="perm-pic"> Allow this user to change their profile picture <br />
                        <input type="checkbox" id="perm-profile" name="perm-profile"> Allow this user to manage their own profile <br />
                        <input type="checkbox" id="perm-other" name="perm-other"> Allow this user to manage other users <br />
                    </div>
                    <input type="submit" name="submit" value="Submit Changes">
                </form>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#perm-admin').click(function() {
                    adminPerms($(this), '.subsection:eq(0)');
                });
            });
        </script>
        <script src="<?php print DOMAIN; ?>/js/form.js" type="text/javascript"></script>
    <?php
    include_once ('../include/footer.php');
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    include_once ('../include/session.php');
    validateUser();
    
    if (!empty($_POST['username']) && isset($_SESSION['edit_uid']))
    {
        $username = mysqli_real_escape_string($db, strip_tags($_POST['username']));
        mysqli_query($db, "UPDATE users SET username='$username' WHERE uid={$_SESSION['edit_uid']} LIMIT 1");
        if (mysqli_affected_rows($db) >= 1)
        {
            print "User '{$_SESSION['edit_username']}' changed to '{$_POST['username']}'";
        }
        else
        {
            print 'failed';
        }

        $_SESSION['edit_uid'] = NULL;
        $_SESSION['edit_username'] = NULL;
    }
    else
    {
        print 'One or more of the required fields is empty!';
    }
}
else
{
    print 'This page was accessed in error';
}
?>