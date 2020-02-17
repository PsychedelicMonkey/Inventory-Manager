<?php
include_once ('../sql/sql.php');
include_once ('../include/session.php');
include_once ('../include/global.php');

function createUser($uname, $pword)
{
    global $db;
    $username = mysqli_real_escape_string($db, strip_tags($uname));
    $salt = mysqli_real_escape_string($db, hash('ripemd128', rand()));
    $password = mysqli_real_escape_string($db, hash('ripemd128', $salt . strip_tags($pword)));

    $arr = ['uid'=>$_SESSION['uid'], 'username'=>$_SESSION['username'], 'time'=>date('Y-M-d H:i:s'), 
            'ip'=>$_SERVER['REMOTE_ADDR'], 'ua'=>$_SERVER['HTTP_USER_AGENT']];
    $json = json_encode($arr);

    mysqli_query($db, "INSERT INTO `users` (`username`, `password`, `salt`, `enabled`, `creation_info`) VALUES ('$username', '$password', '$salt', 1, '$json')");
    if (mysqli_affected_rows($db) == 1)
        print 'success';
    else
        print 'failed';
}

function getUser($uid, $username)
{
    global $db;
    $result = mysqli_query($db, "SELECT * FROM users WHERE uid={$uid} AND username='{$username}' LIMIT 1");
    if (mysqli_affected_rows($db) != 1)
    {
        print 'Unexpected error occured. Please try again';
        exit();
    }

    return mysqli_fetch_assoc($result);
}

?>