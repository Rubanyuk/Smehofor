<?php
class Menu extends CI_Model {
    function Main()
    {
        parent::Model();
    }
    
    function get()
    {
        $dbSelect='SELECT * FROM `siteContent` WHERE template=1 OR template=3';  
        $arr=arrayQuery($dbSelect,MYSQL_ASSOC);               
        return $arr;
    }
}
?>