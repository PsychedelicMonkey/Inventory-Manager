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

                <button id="add-user">Create New User</button>
            </div>
        </div>

<?php
include_once ('../include/footer.php');
?>