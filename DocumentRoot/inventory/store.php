<?php
include_once ('attribute.php');
include_once ('../include/includes.php');

class Store extends Attribute
{
    public function __construct()
    {
        parent::__construct('store');
    }

    public function printTable()
    {
        $result = query($this->selectAllQuery());

        createLinkTable($this->type . '-table', 
            $result, 
            $this->page, 
            array($this->placeholder, 'Address'),
            'view_store.php', 
            $this->id,
            $this->name,
            $this->address
        );
    }
}
?>