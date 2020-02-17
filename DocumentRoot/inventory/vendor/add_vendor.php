<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    include_once ('../../include/session.php');
    validateUser();

    if (!empty($_POST['vendor_name']))
    {
        include_once ('../../sql/sql.php');
        $name = mysqli_real_escape_string($db, strip_tags($_POST['vendor_name']));
        
        if (existsInDB("SELECT * FROM vendors WHERE vendor_name LIKE '$name'"))
        {
            print "Vendor '$name' already exists.";
            exit();
        }

        mysqli_query($db, "INSERT INTO `vendors` (`vendor_id`, `vendor_name`) VALUES (NULL, '$name') ");
        if (mysqli_affected_rows($db) == 1)
            print 'success';
        else
            print 'failed';
    }
    else
    {
        print 'One or more of the required fields is empty';
    }
}
else
{
    define('PAGE', 'Vendors');
    define('SUB_PAGE', 'Add Vendor');
    include_once ('../../include/header.php');
    ?>
        <div class="body-wrapper">
            <div class="section">
                <h2 class="section-heading"><?php print SUB_PAGE; ?></h2>
                <form action="add_vendor.php" method="post">
                    <input type="text" id="vendor_name" name="vendor_name" placeholder="Vendor Name">
                    <span id="name-error" class="error"></span>
                    <p><input type="checkbox" name="enable_vendor" checked="checked"> Vendor is Enabled</p>
                    <input type="submit" name="submit" value="Create Vendor">
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
    include_once ('../../include/footer.php');
}
?>