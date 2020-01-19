<?php
if (isset($_GET['uid']) && is_numeric($_GET['uid']) && ($_GET['uid'] > 0) && !empty($_GET['username']))
{
    include_once ('users.php');
    $user = getUser($_GET['uid'], $_GET['username']);
    $create = json_decode($user['creation_info'], true);
    $login = json_decode($user['login_info'], true);
    
    define ('PAGE', 'Manage Users');
    define ('SUB_PAGE', 'Profile: ' . ucfirst($user['username']));
    include_once ('../include/header.php');
?>
    <div class="body-wrapper">
        <div class="section">
            <h2 class="section-heading"><?php print ucfirst($user['username']); ?></h2>
            <p>Last Login: <?php print $user['last_login_time']; ?></p>
            <p>IP of Last Login: <?php print $login['ip']; ?></p>
            <p>User Agent of Last Login: <?php print $login['user_agent']; ?></p>
            <p>Created by: <?php print $create['username'] . ' (' . $create['uid'] . ')'; ?></p>
            <p>Creation Date: <?php print $create['time']; ?></p>
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