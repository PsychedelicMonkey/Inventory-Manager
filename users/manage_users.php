<?php
define ('PAGE', 'Manage Users');
include_once ('../include/header.php');
include_once ('../include/tables.php');
include_once ('../sql/sql.php');
?>
<div class="body">
        <div class="body-wrapper">
            <!--<h2 style="margin-left: -200px;">Settings</h2>-->
            <div class="section">
                <?php
                $users = query('SELECT * FROM users');
                printTableFromJSON('user-table', $users, 'Users', 
                        ['UID', 'Username', 'Password', 'Salt']);
                ?>
            </div>
        </div>

<?php
include_once ('../include/footer.php');
?>
</div>