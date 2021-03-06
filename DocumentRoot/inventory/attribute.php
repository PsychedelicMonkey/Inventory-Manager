<?php

include_once ('store.php');

class Attribute
{
    public $type;           // Defined by $_GET['attr']
    protected $id;          // store_id, vendor_id, etc...
    protected $name;        // store_name, vendor_name, etc...
    protected $placeholder;
    private $submit;

    protected $page;
    protected $sub_page;

    protected $mysql_table;
    protected $insert_query;

    public $landing_table = array();
    public $add_button_title;
    public $clear_button;

    public function __construct($type)
    {
        $this->type = $type;
        $this->init();
    }

    public function __destruct()
    {
    }

    private function init()
    {
        $this->id = $this->type . '_id';
        $this->name = $this->type . '_name';
        $this->placeholder = ucfirst($this->type) . ' Name';
        $this->submit = 'Create ' . ucfirst($this->type);

        switch ($this->type)
        {
            case 'vendor':
                $this->page = 'Vendors';
                $this->mysql_table = 'vendors';
            break;
            case 'category':
                $this->page = 'Categories';
                $this->mysql_table = 'categories';
            break;
            case 'store':
                $this->page = 'Stores';
                $this->mysql_table = 'stores';
            break;
            default:
                $this->page = ucfirst($this->type);
            break;
        }
            
        $this->sub_page = 'Add ' . ucfirst($this->type);
        $this->add_button_title = 'Add New ' . ucfirst($this->type);
        $this->clear_button = 'Clear ' . ucfirst($this->type) . ' table';

        $this->insert_query = "INSERT INTO `{$this->getMySQLTableName()}` (`{$this->getId()}`, `{$this->getName()}`) VALUES (NULL, '{$_POST[$this->name]}')";
    }

    public function printTable()
    {
        $result = query($this->selectAllQuery());
        
        createLinkTable($this->type . '-table', 
            $result, 
            $this->page, 
            array($this->placeholder),
            "view.php?attr=$this->type", 
            $this->id,
            $this->name
        );
    }

    public function printViewPage()
    {
        ?>
        <div class="body-wrapper">
            <div class="section">
                <h2 class="section-heading"><?php print $_GET[ $this->getName() ] ?></h2>
            </div>
        </div>
        <?php
    }

    public function printAddForm()
    {
        ?>
        <form action="add.php?attr=<?php print $this->type; ?>" method="post">
            <input type="text" id="<?php print $this->getName(); ?>" name="<?php print $this->getName(); ?>" placeholder="<?php print $this->getPlaceholder(); ?>">
            <span id="name-error" class="error"></span>
            <input type="submit" name="submit" value="<?php print $this->getSubmitValue(); ?>">
        </form>
        <?php
    }

    public function jsErrors()
    {
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#<?php print $this->type; ?>_name').focusout(function() {
                    validateName(this, $('#name-error'), 'Enter a <?php print $this->type; ?> name')
                });

                <?php if ($this instanceof Store)
                { ?>
                    $('#<?php print $this->type; ?>_address').focusout(function() {
                        validateName(this, $('#address-error'), 'Enter a <?php print $this->type; ?> address')
                    });
    
                    $('#<?php print $this->type; ?>_city').focusout(function() {
                        validateName(this, $('#city-error'), 'Enter a city name')
                    });
    
                    $('#<?php print $this->type; ?>_state').focusout(function() {
                        validateName(this, $('#state-error'), 'Enter a state name')
                    });

                    $('#postal_code').focusout(function() {
                        validateName(this, $('#postal-error'), 'Enter a valid postal code')
                    });

                    $('#phone').focusout(function() {
                        validateName(this, $('#phone-error'), 'Enter a valid phone number')
                    });
                <?php } ?>
            });
        </script>
        <?php
    }

    public function getType()
    {
        return $this->type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    public function getSubmitValue()
    {
        return $this->submit;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setSubPage($sub_page)
    {
        $this->sub_page = $sub_page;
    }

    public function getSubPage()
    {
        return $this->sub_page;
    }

    /*
     * Returns the string for a select all query
     */
    public function selectAllQuery()
    {
        return 'SELECT * FROM ' . $this->mysql_table;
    }

    public function getInsertQuery()
    {
        return $this->insert_query;
    }

    public function getMySQLTableName()
    {
        return $this->mysql_table;
    }
}

function getAttribute($type)
{
    if ($type == 'store')
        $attr = new Store();
    else
        $attr = new Attribute($type);

    return $attr;
}

function sanitize($str)
{
    global $db;
    return mysqli_real_escape_string($db, strip_tags($str));
}

?>