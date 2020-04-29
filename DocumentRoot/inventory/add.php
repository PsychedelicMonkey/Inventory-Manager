<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['attr']))
    {
        include_once ('attribute.php');
        
        $attr = new Attribute($_GET['attr']);
        define ('PAGE', $attr->getPage());
        define ('SUB_PAGE', $attr->getSubPage());

        include_once ('../include/includes.php');
        include_once ('../include/header.php');
        ?>
            <div class="body-wrapper">
                <div class="section">
                    <h2 class="form-heading"><?php print SUB_PAGE; ?></h2>
                    <form action="add.php?attr=<?php print $_GET['attr']; ?>" method="post">
                        <input type="text" id="<?php print $attr->getName(); ?>" name="<?php print $attr->getName(); ?>" placeholder="<?php print $attr->getPlaceholder(); ?>">
                        <span id="name-error" class="error"></span>
                        <input type="submit" name="submit" value="<?php print $attr->getSubmitValue(); ?>">
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#vendor_name').focusout(function() {
                          validateName(this, $('#name-error'), 'Enter a vendor name')
                    });
                });
            </script>
            <script src="<?php print DOMAIN; ?>/js/form.js" type="text/javascript"></script>

        <?php
        include_once ('../include/footer.php');
    }
    else
    {
        print 'This page was accessed in error';
        exit();
    }
}
// ====================================== POST ======================================
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_GET['attr']))
    {
        include_once ('../include/includes.php');
        validateUser();

        include_once ('attribute.php');
        $attr = new Attribute($_GET['attr']);

        if (!empty($_POST[$attr->getName()]))
        {
            $name = mysqli_real_escape_string($db, strip_tags($_POST[$attr->getName()]));

            if (existsInDB("SELECT * FROM {$attr->getMySQLTableName()} WHERE {$attr->getName()} LIKE '$name'"))
            {
                print "Vendor '$name' already exists.";
                exit();
            }
            
            $query = "INSERT INTO `{$attr->getMySQLTableName()}` (`{$attr->getId()}`, `{$attr->getName()}`) VALUES (NULL, '$name')";
        }
        else
        {
            print 'One or more of the required fields is empty';
        }

        // Make the query
        mysqli_query($db, $query);
        if (mysqli_affected_rows($db) == 1)
            print 'success';
        else
            print 'failed';
    }
}
else
{
    print 'This page was accessed in error';
}
?>