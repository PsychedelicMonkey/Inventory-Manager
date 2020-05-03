<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['attr']))
    {
        include_once ('attribute.php');
        
        $attr = getAttribute($_GET['attr']);
        define ('PAGE', $attr->getPage());
        define ('SUB_PAGE', $attr->getSubPage());

        include_once ('../include/includes.php');
        include_once ('../include/header.php');
        ?>
            <div class="body-wrapper">
                <div class="section">
                    <h2 class="form-heading"><?php print SUB_PAGE; ?></h2>
                    <?php $attr->printAddForm(); ?>
                </div>
            </div>
            <?php $attr->jsErrors(); ?>
            <script src="../js/form.js" type="text/javascript"></script>
            <script type="text/javascript">
                $('form:eq(0)').submit(function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(data) {
                            if (data == 'success') {
                                var str = $('#<?php print $attr->getName(); ?>').val();
                                alert('<?php print ucfirst($attr->type); ?> \'' + str + '\' successfully created');
                                window.location.href = 'landing_page.php?attr=<?php print $attr->type; ?>';
                            }
                            else if (data == 'failed') {
                                alert('Query failed');
                            }
                            else {
                                alert(data);
                            }
                        },
                        error: function(data) {
                            alert('Unknown error occurred.');
                        }
                    });
                });
            </script>
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
        $attr = getAttribute($_GET['attr']);

        if (!empty( $_POST[ $attr->getName() ] ))
        {
            $name = sanitize($_POST[ $attr->getName() ]);

            if (existsInDB("SELECT * FROM {$attr->getMySQLTableName()} WHERE {$attr->getName()} LIKE '$name'"))
            {
                print ucfirst($attr->type) . ": '$name' already exists.";
                exit();
            }

            $query = $attr->getInsertQuery();
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