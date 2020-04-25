<?php
include_once ('../sql/sql.php');

if (!empty($_GET['username']) && isset($_GET['uid']) && is_numeric($_GET['uid']) && ($_GET['uid'] > 0))
{
    include_once ('users.php');
    $user = getUser($_GET['uid'], $_GET['username']);

    session_start();
    $_SESSION['edit_uid'] = $user['uid'];
    $_SESSION['edit_username'] = $user['username'];

    // Prevent users from disabling their own accounts
    if ($_SESSION['edit_uid'] == $_SESSION['uid'])
    {
        print 'You cannot disable your own user account.';
        exit();
    }

    define ('PAGE', 'Manage Users');
    define ('SUB_PAGE', 'Enable ' . ucfirst($user['username']));
    include_once ('../include/header.php');

    ?>
        <div class="body-wrapper">
            <div class="section">
                <h2 class="form-heading">Enable <?php print ucfirst($user['username']); ?></h2>
                <form action="enable_user.php" method="post">
                    <p class="confirmation-text">Are you sure you want to enable user '<?php print $user['username']; ?>'?</p>
                    <input type="submit" name="submit" value="Enable this user">
                </form>
            </div>
        </div>
        <script src="<?php print DOMAIN; ?>/js/form.js" type="text/javascript"></script>
    <?php
    include_once ('../include/footer.php');
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    include_once ('../include/session.php');
    validateUser();

    if (isset($_SESSION['uid']))
    {
        mysqli_query($db, "UPDATE users SET enabled=1 WHERE uid={$_SESSION['edit_uid']} LIMIT 1");
        if (mysqli_affected_rows($db) == 1)
        {
            print 'User: \'' . $_SESSION['edit_username'] . '\' enabled.';
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
