<?php

class Attribute
{
    public $type;
    private $id;
    private $name;
    private $placeholder;
    private $submit;

    private $page;
    private $sub_page;

    private $mysql_table;

    public $landing_table = array();
    public $add_button_title;

    public function __construct($type)
    {
        $this->type = $type;
        $this->setValues();
    }

    public function __destruct()
    {
    }

    private function setValues()
    {
        $this->id = $this->type . '_id';
        $this->name = $this->type . '_name';
        $this->placeholder = ucfirst($this->type) . ' Name';
        $this->submit = 'Create ' . ucfirst($this->type);

        if ($this->type == 'vendor')
        {
            $this->page = ucfirst('Vendors');
            $this->mysql_table = 'vendors';
        }
        else if ($this->type == 'category')
        {
            $this->page = ucfirst('Categories');
            $this->mysql_table = 'categories';
        }
        else
            $this->page = ucfirst($this->type);
            
        $this->sub_page = 'Add ' . ucfirst($this->type);

        $this->landing_table = array(
            "title" => $this->page,
            "headings" => array($this->placeholder),
            "tags" => array("id" => $this->id, "name" => $this->name)
        );

        $this->add_button_title = 'Add New ' . ucfirst($this->type);
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

    public function getMySQLTableName()
    {
        return $this->mysql_table;
    }
}

?>