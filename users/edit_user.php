<?php
if (isset($_GET['uid']) && is_numeric($_GET['uid']) && ($_GET['uid'] > 0))
{
    include_once ('../sql/sql.php');
    $result = mysqli_query($db, "SELECT * FROM users WHERE uid={$_GET['uid']} LIMIT 1");
    $user = mysqli_fetch_assoc($result);

    define ('PAGE', 'Manage Users');
    define ('SUB_PAGE', 'Edit ' . ucfirst($user['username']));
    include_once ('../include/header.php');
    ?>
        <div class="body-wrapper">
            <div class="section">
                <h2 class="section-heading">Edit <?php print ucfirst($user['username']); ?></h2>
                <form action="edit_user.php" method="post">
                    <input type="text" name="username" placeholder="Username" value="<?php print $user['username']; ?>">
                    <input type="submit" name="submit" value="Submit Changes">
                </form>
            </div>
        </div>
    <?php
    include_once ('../include/footer.php');
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    print $_POST['username'];
}
else
{
    print 'This page was accessed in error';
}
?>