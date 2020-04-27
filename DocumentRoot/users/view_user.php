<?php
if (isset($_GET['uid']) && is_numeric($_GET['uid']) && ($_GET['uid'] > 0) && !empty($_GET['username']))
{
    include_once ('users.php');
    $user = getUser($_GET['uid'], $_GET['username']);
    $create = json_decode($user['creation_info'], true);
    $login = json_decode($user['login_info'], true);
    
    define ('PAGE', 'Manage Users');
    define ('SUB_PAGE', 'Profile: ' . ucfirst($user['username']));
    include_once ('../include/includes.php');
    include_once ('../include/header.php');
?>
    <div class="body-wrapper">
        <div class="section">
            <div class="user-page-info">
                <?php getProfilePic(false, false, $_GET['uid']); ?>
                <h2 class="section-heading username"><?php print ucfirst($user['username']); ?></h2>
            </div>
            <table class="even">
                <tbody class="dual">
                    <tr><th>Creation Date</th><td><?php print $create['time']; ?></td></tr>
                    <tr><th>Created by</th><td><?php print $create['username'] . ' (' . $create['uid'] . ')'; ?></td></tr>
                    <tr><th>Last Login</th><td><?php print $user['last_login_time']; ?></td></tr>
                    <tr><th>IP of Last Login</th><td><?php print $login['ip']; ?></td></tr>
                    <tr><th>User Agent of Last Login</th><td><?php print $login['user_agent']; ?></td></tr>
                </tbody>
            </table>
            <div class="subsection">
                <h3 class="section-heading">DANGER ZONE!</h3>
                <a href="edit_user.php?uid=<?php print $user['uid']; ?>&username=<?php print $user['username']; ?>" class="edit button">Edit User</a>
                <a href="disable_user.php?uid=<?php print $user['uid']; ?>&username=<?php print $user['username']; ?>" class="disable button">Disable User</a>
                <a href="delete_user.php?uid=<?php print $user['uid']; ?>&username=<?php print $user['username'] ?>" class="delete button">Delete User</a>
            </div>
        </div>
    </div>
    <script src="<?php print DOMAIN; ?>/js/form.js" type="text/javascript"></script>
<?php
    include_once ('../include/footer.php');
}
else
{
    print 'This page was accessed in error';
}
?>