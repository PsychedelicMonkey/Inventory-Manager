<?php
session_start();

setcookie('uid', $_SESSION['uid'], (time() - 3600 * 24 * 30));
setcookie('username', $_SESSION['username'], (time() - 3600 * 24 * 30));

session_unset();
session_destroy();

header('Location: login.php');
?>