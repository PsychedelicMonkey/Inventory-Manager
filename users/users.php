<?php
include_once ('../sql/sql.php');

function addUser($uname, $pword)
{
    global $db;
    $username = mysqli_real_escape_string($db, strip_tags($uname));
    $salt = mysqli_real_escape_string($db, hash('ripemd128', rand()));
    $password = mysqli_real_escape_string($db, hash('ripemd128', $salt . strip_tags($pword)));

    mysqli_query($db, "INSERT INTO `users` (`username`, `password`, `salt`) VALUES ('$username', '$password', '$salt')");
    if (mysqli_affected_rows($db) == 1)
    {
        print 'success';
    }
    else
    {
        print 'failed';
    }
}

?>