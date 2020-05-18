<?php
if (isset($_GET['attr']))
{
    include_once ('attribute.php');
        
    $attr = getAttribute($_GET['attr']);
    $attr->setSubPage($_GET[ $attr->getName() ]);

    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 /*&& isset($_GET[ $attr->getName() ])*/)
    {
        if ($_GET['attr'] == 'store')
        {
            $key = array_pop(array_keys($_GET));
            $value = end($_GET);
            $attr->setKeyValue($key, $value);
            $attr->setSubPage($value);
            $attr->setQuery("SELECT * FROM `stores` WHERE `{$key}` LIKE '{$value}'");
        }
        define ('PAGE', $attr->getPage());
        define ('SUB_PAGE', $attr->getSubPage());
    
        include_once ('../include/includes.php');
        include_once ('../include/header.php');

        $attr->printViewPage();

        include_once ('../include/footer.php');
    }
    else
    {
        print 'This page was accessed in error';
    }
}
else
{
    print 'This page was accessed in error';
}
?>