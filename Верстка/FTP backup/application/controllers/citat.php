<?php
class Citat extends CI_Controller {

	function index()
	{
	   
        $this->load->model('Page');
        $page=$this->Page->get();

        $this->load->model('Menu');
        
        $menu=$this->Menu->get();                

        $data = array(
               'title' => $page['pagetitle'],
               'id' => $page['id'],
               'menu' =>$menu 
          );
          
		$this->load->view('indexView',$data);
        $this->load->view('footer');
	}    
}
?>  