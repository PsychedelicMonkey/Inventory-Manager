<?php
include_once ('attribute.php');
include_once ('../include/includes.php');

class Store extends Attribute
{
    private $key;
    private $value;
    private $query;

    public function __construct()
    {
        parent::__construct('store');
        $store_name = sanitize($_POST['store_name']);
        $store_address = sanitize($_POST['store_address']);
        $store_city  = sanitize($_POST['store_city']);
        $store_state = sanitize($_POST['store_state']);
        $postal_code = sanitize($_POST['postal_code']);
        $phone = sanitize($_POST['phone']);

        $this->insert_query = "INSERT INTO `stores` 
                (`store_id`, `store_name`, `store_address`, `store_city`, `store_state`, `postal_code`, `store_phone`) 
                VALUES (NULL, '$store_name', '$store_address', '$store_city', '$store_state', '$postal_code', '$phone');";
    }

    public function printTable()
    {
        $result = query($this->selectAllQuery());
        $json = json_decode($result, true);
        ?>
        <h2 class="table-heading">Stores</h2>
        <table id="store-table">
            <thead>
                <tr><th>Store Name<i class="sort fa fa-sort-up"></i></th><th>Address<i class="sort fa fa-sort"></i></th><th>City<i class="sort fa fa-sort"></i></th>
                <th>State<i class="sort fa fa-sort"></i></th><th>Postal Code<i class="sort fa fa-sort"></i></th><th>Phone Number<i class="sort fa fa-sort"></i></th></tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($json); $i++)
                {
                    print '<tr>';
                    foreach ($json[$i] as $key => $value)
                    {
                        if ($key == 'store_id')
                            continue;

                        if ($key != 'postal_code' && $key != 'store_address' && $key != 'store_phone')
                        {
                            print '<td><a class="table-link" href="view.php?attr=store&id=' . $json[$i]['store_id'] . '&' . $key . '=' . $value . '">' . $value . '</a></td>';
                        }
                        else
                            print '<td>' . $value . '</td>';
                    }
                    print '</tr>';
                }
                ?>
            </tbody>
        </table>
        <?php
        /*createLinkTable($this->type . '-table', 
            $result, 
            $this->page, 
            array($this->placeholder, 'Address', 'City', 'State', 'Postal Code'),
            'view.php?attr=store', 
            $this->id,
            $this->name
        );*/
    }

    public function printAddForm()
    {
        ?>
        <form action="add.php?attr=<?php print $this->type; ?>" method="post">
            <input type="text" id="<?php print $this->getName(); ?>" name="<?php print $this->getName(); ?>" placeholder="<?php print $this->getPlaceholder(); ?>">
            <span id="name-error" class="error"></span>
            <input type="text" id="store_address" name="store_address" placeholder="Address">
            <span id="address-error" class="error"></span>
            <input type="text" id="store_city" name="store_city" placeholder="City">
            <span id="city-error" class="error"></span>
            <input type="text" id="store_state" name="store_state" placeholder="State">
            <span id="state-error" class="error"></span>
            <input type="text" id="postal_code" name="postal_code" placeholder="Postal Code">
            <span id="postal-error" class="error"></span>
            <input type="text" id="phone" name="phone" placeholder="Phone Number">
            <span id="phone-error" class="error"></span>
            <input type="submit" name="submit" value="<?php print $this->getSubmitValue(); ?>">
        </form>
        <?php
    }

    public function printViewPage()
    {
        ?>
        <div class="body-wrapper">
            <div class="section">
                <h2 class="section-heading"><?php print $this->value; ?></h2>
                <?php
                $result = query($this->query);
                $json = json_decode($result, true);
                ?>
                <table id="store-table">
            <thead>
                <tr><th>Store Name<i class="sort fa fa-sort-up"></i></th><th>Address<i class="sort fa fa-sort"></i></th><th>City<i class="sort fa fa-sort"></i></th>
                <th>State<i class="sort fa fa-sort"></i></th><th>Postal Code<i class="sort fa fa-sort"></i></th><th>Phone Number<i class="sort fa fa-sort"></i></th></tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($json); $i++)
                {
                    print '<tr>';
                    foreach ($json[$i] as $key => $value)
                    {
                        if ($key == 'store_id')
                            continue;

                        print '<td>' . $value . '</td>';
                    }
                    print '</tr>';
                }
                ?>
            </tbody>
        </table>
            </div>
        </div>
        <?php
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setKeyValue($key, $value)
    {
        $this->setKey($key);
        $this->setValue($value);
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }
}
?>