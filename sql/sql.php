<?php
    $db = mysqli_connect('localhost', 'root', 'password', 'inventory');

    if (!$db)
    {
        die('Connection failed: ' . mysqli_connect_error());
    }

    function query($query)
    {
        global $db;
        $arr = array();
        if ($result = mysqli_query($db, $query))
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }
        }
        else
        {
            print 'Error ' . mysqli_error();
        }

        return json_encode($arr);
    }

    function addUser()
    {
        $username = mysqli_real_escape_string($db, strip_tags($_POST['username']));
        $salt = mysqli_real_escape_string($db, hash('ripemd128', rand()));
        $password = mysqli_real_escape_string($db, hash('ripemd128', $salt . strip_tags($_POST['password'])));

        $query = "INSERT INTO users (username, password, salt) VALUES ('$username', '$password', '$salt')";
        mysqli_query($db, $query);
        if (mysqli_affected_rows($db) == 1)
        {
            print 'success';
        }
        else
        {
            print 'failed!';
        }
    }

    function closeMySQL()
    {
        mysqli_close($db);
    }
?>