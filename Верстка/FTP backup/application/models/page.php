<?php
class Page extends CI_Model {
var $alias;    
    function Page()
    {        
        $this->load->helper('url');        
        $this->alias=trim(substr(current_url(),strlen(site_url())) ,"/");       
    }
    
    function get()
    {        
        $dbSelect="SELECT * FROM siteContent WHERE alias='$this->alias'";
        $result=rowQuery($dbSelect,'',MYSQL_ASSOC);
        return $result;
    }

}
?>