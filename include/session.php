<?php
session_start();

function validateUser()
{
    if (!isset($_SESSION['uid']) && !isset($_SESSION['username']))
    {
        print 'You do not have permission to access this page.';
        exit();
    }
}
?>