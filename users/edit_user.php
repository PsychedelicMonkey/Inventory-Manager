<?php
include_once ('../sql/sql.php');

if (isset($_GET['uid']) && is_numeric($_GET['uid']) && ($_GET['uid'] > 0) && !empty($_GET['username']))
{
    $result = mysqli_query($db, "SELECT * FROM users WHERE uid={$_GET['uid']} AND username='{$_GET['username']}' LIMIT 1");
    if (mysqli_affected_rows($db) != 1)
    {
        print 'Unexpected error occured. Please try again';
        exit();
    }
    $user = mysqli_fetch_assoc($result);
    
    define ('PAGE', 'Manage Users');
    define ('SUB_PAGE', 'Edit ' . ucfirst($user['username']));
    include_once ('../include/header.php');
    $_SESSION['edit_uid'] = $user['uid'];
    ?>
        <div class="body-wrapper">
            <div class="section">
                <h2 class="section-heading">Edit <?php print ucfirst($user['username']); ?></h2>
                <form action="edit_user.php" method="post">
                    <input type="text" name="username" placeholder="Username" value="<?php print $user['username']; ?>">
                    <input type="submit" name="submit" value="Submit Changes">
                </form>
            </div>
        </div>
        <script src="<?php print DOMAIN; ?>/js/form.js" type="text/javascript"></script>
    <?php
    include_once ('../include/footer.php');
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    session_start();
    if (!empty($_POST['username']) && isset($_SESSION['edit_uid']))
    {
        $username = mysqli_real_escape_string($db, strip_tags($_POST['username']));
        mysqli_query($db, "UPDATE users SET username='$username' WHERE uid={$_SESSION['edit_uid']} LIMIT 1");
        if (mysqli_affected_rows($db) >= 1)
        {
            print 'success';
        }
        else
        {
            print 'failed';
        }

        $_SESSION['edit_uid'] = NULL;
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