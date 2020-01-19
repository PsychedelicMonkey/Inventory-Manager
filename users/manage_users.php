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

                <a class="button add" href="add_user.php">Add New User</a>
            </div>
        </div>
        <script type="text/javascript" src="<?php print DOMAIN; ?>/js/table.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                init(document.getElementById('user-table'));
            });
        </script>
<?php
include_once ('../include/footer.php');
?>