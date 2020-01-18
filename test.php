<?php
shell_exec ('touch file');
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form action="" method="post" enctype=mulipart/form-data>
            <input type="file" name="image">
            <input type="submit" value="Upload Image"/>
        </form>
    </body>
</html>