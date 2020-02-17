<?php
session_start();

function init()
{
    if (isset($_COOKIE['uid']) && isset($_COOKIE['username']))
    {
        $_SESSION['uid'] = $_COOKIE['uid'];
        $_SESSION['username'] = $_COOKIE['username'];
    }
}

function validateUser()
{
    if (!isset($_SESSION['uid']) && !isset($_SESSION['username']))
    {
        print 'You do not have permission to access this page.';
        exit();
    }
}
?>