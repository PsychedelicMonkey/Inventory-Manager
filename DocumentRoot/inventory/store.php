<?php
include_once ('attribute.php');
include_once ('../include/includes.php');

class Store extends Attribute
{
    public function __construct()
    {
        parent::__construct('store');
        $store_name = sanitize($_POST['store_name']);
        $store_address = sanitize($_POST['store_address']);
        $store_city  = sanitize($_POST['store_city']);
        $store_state = sanitize($_POST['store_state']);
        $postal_code = sanitize($_POST['postal_code']);

        $this->insert_query = "INSERT INTO `stores` 
                (`store_id`, `store_name`, `store_address`, `store_city`, `store_state`, `postal_code`) 
                VALUES (NULL, '$store_name', '$store_address', '$store_city', '$store_state', '$postal_code');";
    }

    public function printTable()
    {
        $result = query($this->selectAllQuery());

        createLinkTable($this->type . '-table', 
            $result, 
            $this->page, 
            array($this->placeholder, 'Address', 'City', 'State', 'Postal Code'),
            'view_store.php', 
            $this->id,
            $this->name
        );
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
            <input type="submit" name="submit" value="<?php print $this->getSubmitValue(); ?>">
        </form>
        <?php
    }
}
?>