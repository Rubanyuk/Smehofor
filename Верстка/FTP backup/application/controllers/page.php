<?php

class page extends CI_Controller {

	function index()
	{
	   
       if(!isset($_GET['page']))
            return false;
            
       arraySlashes($_GET);
       
       $dbSelect="SELECT * FROM `pages` WHERE alias='".$_GET['page']."'";
       $page=rowQuery($dbSelect,null,MYSQL_ASSOC);
        $data = array(
            'title' => $page['pagetitle'],
            'content' => $page['content']
        );

        $this->load->view('pages/page', $data);       
       

	}
  
}

        

?>