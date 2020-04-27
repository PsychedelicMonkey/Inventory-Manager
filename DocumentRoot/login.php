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
        include_once ('include/sql.php');

        $username = mysqli_real_escape_string($db, strip_tags($_POST['username']));
        $password = mysqli_real_escape_string($db, strip_tags($_POST['password']));

        $result = mysqli_query($db, "SELECT * FROM users WHERE username LIKE '$username'");
        if (mysqli_affected_rows($db) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            if ($row['enabled'] == 0)
            {
                print 'This user account is disabled.';
                exit();
            }

            $test_pass = hash('ripemd128', $row['salt'] . $password);
            if ($test_pass == $row['password'])
            {
                $update_login = "UPDATE users SET login_info='{\"time\": \"" . date('Y-m-d H:i:s') . "\", \"ip\":\"{$_SERVER['REMOTE_ADDR']}\", \"user_agent\":\"{$_SERVER['HTTP_USER_AGENT']}\"}'";
                mysqli_query($db, $update_login);

                $_SESSION['username'] = $row['username'];
                $_SESSION['uid'] = $row['uid'];

                if ($_POST['remember_me'] == 'on')
                {
                    setcookie('uid', $_SESSION['uid'], (time() + 3600 * 24 * 30));
                    setcookie('username', $_SESSION['username'], (time() + 3600 * 24 * 30));
                }

                print 'login';
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <link rel="stylesheet" type="text/css" href="/css/login.css">
    </head>
    <body>
        <div id="modal" class="modal">
            <div class="modal-wrapper">
                <span class="close">&times;</span>
                <p class="modal-text"></p>
            </div>
        </div>
        <form id="login-form" action="login.php" method="post">
            <h2 class="heading">Login</h2>
            <label><input type="text" id="form-username" name="username" placeholder="Username"></label>
            <label><span id="username-error" class="error"></span></label>
            <label><input type="password" id="form-password" name="password" placeholder="Password"></label>
            <label><span id="password-error" class="error"></span></label>
            <label id="remember-me"><input type="checkbox" name="remember_me"> Remember Me</label>
            <label><input type="submit" name="submit" value="Login"></label>
            <a href="#">Forgot Password?</a>
        </form>
        <script type="text/javascript">
            $(document).ready(function() {
                $('form').submit(function(e) {
                    return validateUsername($('#form-username')) && loginPassword($('#form-password'));
                });
            });
        </script>
        <script src="js/form.js" type="text/javascript"></script>
        <script type="text/javascript">
            $('#login-form').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data == 'login') {
                            window.location.href = 'dashboard.php';
                        }
                        else {
                            console.log(data);
                            $('#modal').css('display', 'block');
                            $('.modal-text:eq(0)').text(data);
                        }
                    },
                    error: function(data) {
                        alert('Unknown error occured.');
                    }
                });
            });

            $('.close:eq(0)').click(function() {
                $('#modal').css('display', 'none');
            });
        </script>
    </body>
</html>

<?php } ?>