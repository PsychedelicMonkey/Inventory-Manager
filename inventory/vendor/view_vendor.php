<?php
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_GET['vendor_name']))
{
    define('PAGE', 'Vendors');
    define ('SUB_PAGE', 'View: ' . $_GET['vendor_name']);
    include_once ('../../include/header.php');
    ?>

    <div class="body-wrapper">
        <div class="section">
            <h2 class="section-heading"><?php print $_GET['vendor_name'] ?></h2>
        </div>
    </div>

    <?php
    include_once ('../../include/footer.php');
}
else
{
    print 'This page was accessed in error.';
}
?>