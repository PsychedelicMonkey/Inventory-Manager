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

    function existsInDB($query)
    {
        global $db;
        $result = mysqli_query($db, $query);
        if (mysqli_affected_rows($db) >= 1)
        {
            return TRUE;
        }
        return FALSE;
    }

    function closeMySQL()
    {
        mysqli_close($db);
    }
?>