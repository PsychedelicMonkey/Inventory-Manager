<?php
if (isset($_GET['uid']) && is_numeric($_GET['uid']) && ($_GET['uid'] > 0) && !empty($_GET['username']))
{
    include_once ('users.php');
    $user = getUser($_GET['uid'], $_GET['username']);

    
    define ('PAGE', 'Manage Users');
    define ('SUB_PAGE', 'Profile: ' . ucfirst($user['username']));
    include_once ('../include/header.php');
?>
    <div class="body-wrapper">
        <div class="section">
            <h2 class="section-heading"><?php print ucfirst($user['username']); ?></h2>
            <p>Last Login: <?php print $user['last_login_time']; ?></p>
            <p>IP of Last Login: <?php print $user['last_login_ip']; ?></p>
            <p>User Agent of Last Login: <?php print $user['last_login_ua']; ?></p>
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