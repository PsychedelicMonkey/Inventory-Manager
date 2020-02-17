<?php 
define ('PAGE', 'Dashboard');
include_once ('include/header.php');
include_once ('include/tables.php');
include_once ('sql/sql.php');
?>
            <div id="modal" class="modal">
                <div class="modal-wrapper">
                    <span class="close">&times;</span>
                    <span id="modal-icon"><i class="fa fa-fw fa-user-circle"></i></span>
                    <span id="picture-caption"><?php print ucfirst($_SESSION['username']); ?></span>
                </div>
            </div>
            <div class="body-wrapper">
                <div class="card-row">
                    <div class="card-column">
                        <div id="messages-card" class="card">
                            <div class="card-wrapper">
                                <h3 class="card-heading">8 New Messages</h3>
                                <a class="view-details" href="#">View details</a>
                                <i class="card-icon fa fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-column">
                        <div id="products-card" class="card">
                            <div class="card-wrapper">
                                <h3 class="card-heading">12 New Products</h3>
                                <a class="view-details" href="#">View details</a>
                                <i class="card-icon fa fa-tags"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-column">
                        <div id="orders-card" class="card">
                            <div class="card-wrapper">
                                <h3 class="card-heading">5 New Orders</h3>
                                <a class="view-details" href="#">View details</a>
                                <i class="card-icon fa fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-column">
                        <div id="sales-card" class="card">
                            <div class="card-wrapper">
                                <h3 class="card-heading">Weekly Sales</h3>
                                <a class="view-details" href="#">View details</a>
                                <i class="card-icon fa fa-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section">
                    <?php
                        $sales = file_get_contents('./demo-files/top-sales.json');
                        printTableFromJSON("sales-table", $sales, "Top Sales", 
                            ['Store Number', 'Store Name', 'City', 'Today\'s Sales', 'This Week\'s Sales']);
                    ?>
                </div>

                <div class="section">
                    <?php
                        $employees = file_get_contents('./demo-files/employees.json');
                        printTableFromJSON('employee-table', $employees, "Employees",
                            ['Employee Number', 'Name', 'Today\'s Sales', 'This Week\'s Sales']);
                    ?>
                </div><!-- End Section -->
                <button id="display-form" type="button" name="button">Sign Up Form</button>
            </div>
            <script type="text/javascript" src="<?php print DOMAIN; ?>/js/table.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    init(document.getElementById('sales-table'));
                    init(document.getElementById('employee-table'));
                });
            </script>
<?php
include_once ('include/footer.php');
?>