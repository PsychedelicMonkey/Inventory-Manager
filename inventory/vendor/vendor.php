<?php
define ('PAGE', 'Vendors');
include_once ('../../include/header.php');
include_once ('../../include/tables.php');
include_once ('../../sql/sql.php');
?>

        <div class="body-wrapper">
            <div class="section">
            <?php
            $result = query("SELECT vendor_name FROM vendors");
            printTableFromJSON('vendor-table', $result, 'Vendors', ['Vendor Name']);
            ?>
                <div class="subsection">
                    <a class="button add" href="add_vendor.php">Add New Vendor</a>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php print DOMAIN; ?>/js/table.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                init(document.getElementById('vendor-table'));
            });
        </script>

<?php
include_once ('../../include/footer.php');
?>