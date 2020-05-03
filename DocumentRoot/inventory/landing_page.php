<?php
if (isset($_GET['attr']))
{
    include_once ('attribute.php');

    $attr = getAttribute($_GET['attr']);

    define ('PAGE', $attr->getPage());

    include_once ('../include/includes.php');
    include_once ('../include/header.php');
    ?>

    <div class="body-wrapper">
        <a class="button add" href="add.php?attr=<?php print $_GET['attr']; ?>"><?php print $attr->add_button_title; ?></a>
        <div class="section">
        <?php $attr->printTable(); ?>
        </div>
    </div>
    <script type="text/javascript" src="<?php print DOMAIN; ?>/js/table.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            init(document.getElementById('<?php print $_GET['attr']; ?>-table'));
        });
    </script>

    <?php
    include_once ('../include/footer.php');
}
else
{
    print 'This page was accessed in error';
}
?>