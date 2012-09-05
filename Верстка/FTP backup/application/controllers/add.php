<?php
class Add extends CI_Controller {

	function index()
	{
     //  if($_POST['addJokeSubmit']){}
            
        $this->load->model('Page');
        $page=$this->Page->get();

        $this->load->model('Menu');
        
        $menu=$this->Menu->get();                

        $data = array(
               'title' => $page['pagetitle'],
               'id' => $page['id'],
               'menu' =>$menu 
          );
          
		$this->load->view('pages/addJoke',$data);
       // $this->load->view('footer');
	}    
}