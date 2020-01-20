<?php
$dbName = 'inventory';
$db = mysqli_connect('localhost', 'root', 'password');

if (!$db)
{
    die('Connection failed: ' . mysqli_connect_error());
}

mysqli_query($db, "CREATE DATABASE IF NOT EXISTS $dbName");
print "Database: '$dbName' created!";

mysqli_query($db, "CREATE TABLE IF NOT EXISTS `$dbName`.`users` ( 
                        `uid` INT NOT NULL AUTO_INCREMENT , 
                        `username` VARCHAR(100) NOT NULL , 
                        `password` VARCHAR(100) NOT NULL , 
                        `salt` VARCHAR(100) NOT NULL , 
                        `enabled` BOOLEAN NOT NULL , 
                        `login_info` JSON NULL , 
                        `last_login_time` TIMESTAMP NOT NULL ,  
                        `creation_info` JSON NULL , 
                        PRIMARY KEY (`uid`)) ENGINE = InnoDB;");
print '<p>Table: \'users\' created!</p>';

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
        $query = "INSERT INTO `$dbName`.`users` (`uid`, `username`, `password`, `salt`, `last_login_time`) 
                VALUES (NULL, 'admin', '$password', '$salt', current_timestamp())";
        mysqli_query($db, $query);
        if (mysqli_affected_rows($db) == 1)
        {
            print '<p>Username \'admin\', Password \'password\' created</p>';
        }
    }
    else
    {
        print 'admin user is already created';
    }
}

mysqli_close($db);
?>