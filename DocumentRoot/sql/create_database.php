<?php
//require ('include/global.php');

$dbName = 'inventory';
$db = mysqli_connect('mysql', 'root', 'password');

if (!$db)
{
    die('Connection failed: ' . mysqli_connect_error());
}

mysqli_query($db, "CREATE DATABASE IF NOT EXISTS $dbName");
echo "Database: '$dbName' created!\n";

// ====================== USER TABLE ======================
mysqli_query($db, "CREATE TABLE IF NOT EXISTS `$dbName`.`users` ( 
    `uid` INT NOT NULL AUTO_INCREMENT , 
    `username` VARCHAR(100) NOT NULL , 
    `password` VARCHAR(100) NOT NULL , 
    `salt` VARCHAR(100) NOT NULL , 
    `enabled` BOOLEAN NOT NULL , 
    `login_info` JSON NULL , 
    `last_login_time` TIMESTAMP NOT NULL ,  
    `creation_info` JSON NULL , 
    `profile_pic` VARCHAR(500) NULL ,
    PRIMARY KEY (`uid`)) ENGINE = InnoDB;");
echo "Table: \'users\' created!\n";
createAdmin();

// ====================== VENDOR TABLE ======================
mysqli_query($db, "CREATE TABLE IF NOT EXISTS `$dbName`.`vendors` (
    `vendor_id` INT NOT NULL AUTO_INCREMENT , 
    `vendor_name` VARCHAR(50) NOT NULL , 
    PRIMARY KEY (`vendor_id`)) ENGINE = InnoDB;");
echo "Table: \'vendors\' created!\n";

// ====================== CATEGORY TABLE ======================
mysqli_query($db, "CREATE TABLE IF NOT EXISTS `$dbName`.`categories` ( 
    `category_id` INT NOT NULL AUTO_INCREMENT , 
    `category_name` VARCHAR(100) NOT NULL , 
    PRIMARY KEY (`category_id`)) ENGINE = InnoDB; ");
echo "Table: \'categories\' created!\n";

// ====================== STORE TABLE ======================
mysqli_query($db, "CREATE TABLE IF NOT EXISTS `$dbName`.`stores` ( 
    `store_id` INT NOT NULL AUTO_INCREMENT , 
    `store_name` VARCHAR(200) NOT NULL , 
    `store_address` VARCHAR(200) NOT NULL , 
    `store_city` VARCHAR(100) NOT NULL , 
    `store_state` VARCHAR(100) NOT NULL , 
    `postal_code` VARCHAR(7) NOT NULL , 
    `store_phone` VARCHAR(20) NOT NULL , 
    PRIMARY KEY (`store_id`)) ENGINE = InnoDB; ");
echo "Table: \'stores\' created!\n";

/*
 * Creates the default user
 * Username: "admin"
 * Password: "password"
 */
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
        $query = "INSERT INTO `$dbName`.`users` (`uid`, `username`, `password`, `salt`, `enabled`, `last_login_time`) 
                VALUES (NULL, 'admin', '$password', '$salt', 1, current_timestamp())";
        mysqli_query($db, $query);
        if (mysqli_affected_rows($db) == 1)
        {
            echo 'Username \'admin\', Password \'password\' created\n';
        }
    }
    else
    {
        echo "admin user is already created\n";
    }
}

mysqli_close($db);
?>
