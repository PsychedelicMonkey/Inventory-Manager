<?php
$dbName = 'inventory';
$db = mysqli_connect('localhost', 'root', 'password');

if (!$db)
{
    die('Connection failed: ' . mysqli_connect_error());
}

mysqli_query($db, "CREATE DATABASE IF NOT EXISTS $dbName");

mysqli_query($db, "CREATE TABLE IF NOT EXISTS `$dbName`.`users` ( 
                        `uid` INT NOT NULL AUTO_INCREMENT , 
                        `username` VARCHAR(100) NOT NULL , 
                        `password` VARCHAR(100) NOT NULL , 
                        `salt` VARCHAR(100) NOT NULL , 
                        PRIMARY KEY (`uid`)) ENGINE = InnoDB;");

createAdmin();

function createAdmin()
{
    global $dbName;
    global $db;
    $salt = hash('ripemd128', rand());
    $password = hash('ripemd128', $salt . 'password');

    $result = mysqli_query($db, "SELECT count(*) as count FROM `$dbName`.`users`");
    $data = mysqli_fetch_assoc($result);
    if ($data['count'] <= 0)
    {
        $query = "INSERT INTO `$dbName`.`users` (`uid`, `username`, `password`, `salt`) VALUES (NULL, 'admin', '$password', '$salt')";
        mysqli_query($db, $query);
        if (mysqli_affected_rows($db) == 1)
        {
            print 'Username \'admin\', Password \'password\' created';
        }
    }
    else
    {
        print 'admin user is already created';
    }
}

mysqli_close($db);
?>