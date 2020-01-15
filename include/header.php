<?php
session_start();
if (!isset($_SESSION['uid']) && !isset($_SESSION['username']))
{
    print 'You do not have permission to access this page.';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php (defined('PAGE')) ? print PAGE : print 'Unknown Page'; ?> | Inventory Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="topbar">
            <button id="open-nav"><i class="fa fa-bars"></i></button>
            <input id="dark-mode" type="checkbox" name="darkmode"> <i style="color: white; font-style: none;">Dark Mode</i style="color: white; font-style: normal;">
        </div>
        <div class="navbar">
            <div class="profile-info">
                <span id="user-icon"><i class="fa fa-fw fa-user-circle"></i></span>
                <span id="username"><?php print ucfirst($_SESSION['username']); ?></span>
            </div>
            <ul>
            <?php
                $items = array(
                    array('Dashboard', 'tachometer', 'dashboard.php'),
                    array('Notifications', 'bell'),
                    array('Messages', 'envelope'),
                    array('My Profile', 'user'),
                    array('Manage Users', 'users'),
                    array('Vendors', 'diamond'),
                    array('Products', 'tags'),
                    array('Stores', 'shopping-bag'),
                    array('Orders', 'truck'),
                    array('Stats', 'bar-chart'),
                    array('Settings', 'cog'),
                    array('Log Out', 'sign-out', 'logout.php')
                );

                for ($i = 0; $i < sizeof($items); $i++)
                {
                    $active = "";
                    (defined('PAGE') && PAGE == $items[$i][0]) ? $active = "active" : $active = "";
                    echo "<li><a class=\"menu-item $active\" href=\"{$items[$i][2]}\"><i class=\"menu-icon fa fa-fw fa-{$items[$i][1]}\"></i> {$items[$i][0]}</a></li>";
                }
            ?>
            </ul>
        </div>
     