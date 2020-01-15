<?php
session_start();

if (isset($_SESSION['username']))
{
    header ('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!empty($_POST['username']) && !empty($_POST['password']))
    {
        include_once ('sql/sql.php');

        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);

        $result = mysqli_query($db, "SELECT * FROM users WHERE username LIKE '$username'");
        if (mysqli_affected_rows($db) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $test_pass = hash('ripemd128', $row['salt'] . $password);
            if ($test_pass == $row['password'])
            {
                $_SESSION['username'] = $row['username'];
                $_SESSION['uid'] = $row['uid'];

                header ('Location: dashboard.php');
            }
            else
            {
                print 'Username and/or password is incorrect. Please try again.';
            }
        }
        else
        {
            print 'Username and/or password is incorrect. Please try again.';
        }
        
        mysqli_close($db);
    }
    else
    {
        print 'Error: no username and/or password entered.';
    }
}
else
{ ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login | Inventory Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/css/login.css">
    </head>
    <body>
        <form class="" action="login.php" method="post">
            <h2 class="heading">Login</h2>
            <label><input type="text" name="username" placeholder="Username"></label>
            <label><input type="password" name="password" placeholder="Password"></label>
            <label id="remember-me"><input type="checkbox" name="remember-me" value=""> Remember Me</label>
            <label><input type="submit" name="submit" value="Login"></label>
            <a href="#">Forgot Password?</a>
        </form>
    </body>
</html>

<?php } ?>