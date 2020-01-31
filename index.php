<?php
session_start();
require ('include/session.php');
init();

if (isset($_SESSION['uid']) && isset($_SESSION['username']))
{
	header('Location: dashboard.php');
}
else
{
	header('Location: login.php');
}
?>