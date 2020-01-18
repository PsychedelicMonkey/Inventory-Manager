<?php
define ('PAGE', 'Manage Users');
include_once ('../include/header.php');
include_once ('../include/tables.php');
include_once ('../sql/sql.php');
?>
        <div class="body-wrapper">
            <div class="section">
                <?php
                $users = query('SELECT uid, username FROM users');
                printFunctionTable('user-table', $users, 'Users', 
                        ['UID', 'Username']);
                ?>

                <a class="add-user" href="add_user.php">Add New User</a>
            </div>
        </div>

<?php
include_once ('../include/footer.php');
?>