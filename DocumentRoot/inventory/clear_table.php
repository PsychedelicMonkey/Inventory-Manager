<?php
/*
 * NOTE: ONLY USERS WITH ELEVATED PERMS SHOULD BE ABLE TO CLEAR TABLES
 */

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['attr']))
    {
        include_once ('attribute.php');
        
        $attr = getAttribute($_GET['attr']);
        $attr->setSubPage('Clear ' . ucfirst($attr->type) . ' Table');

        define ('PAGE', $attr->getPage());
        define ('SUB_PAGE', $attr->getSubPage());

        include_once ('../include/includes.php');
        include_once ('../include/header.php');
        ?>
        
        <div class="body-wrapper">
            <div class="section">
                <h2 class="form-heading"><?php print SUB_PAGE; ?></h2>
                <form action="clear_table.php?attr=<?php print $attr->type; ?>" method="post">
                    <p class="confirmation-text">Are you sure you want to clear the <?php print $attr->type; ?> table?</p>
                    <p class="confirmation-text">You cannot undo this action!</p>
                    <input type="submit" name="submit" value="Clear <?php print $attr->type; ?> table">
                </form>
            </div>
        </div>

        <?php
    }
    else
    {
        print 'This page was accessed in error';    
    }
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_GET['attr']))
    {
        include_once ('../include/includes.php');
        validateUser();

        include_once ('attribute.php');
        $attr = getAttribute($_GET['attr']);

        $query = "TRUNCATE TABLE " . $attr->getMySQLTableName();
        
         // Make the query
         mysqli_query($db, $query);
         print ucfirst($attr->type) . ' table cleared.';
    }
    else
    {
        print 'Unknown error occurred.';
    }
}
else
{
    print 'This page was accessed in error';
}
?>