<?php
class admin extends CI_Controller {

	function index()
	{  
	   
       $this->load->library('session');
       
       
       //$adminSets=1;
       arraySlashes($_POST);
       $username='';
       if(isset($_POST['username']))
            $username=trim($_POST['username']);

       $userpass='';
       if(isset($_POST['userpass']))
            $userpass=trim($_POST['userpass']);            
            
        
        $adminSets=0;
        
        if($username=='admin' && $userpass=='0F19')    
            $this->session->set_userdata('admin','1');
                 
       $adminSets=$this->session->userdata('admin');      
             
       if(!$adminSets){
	   $data=array(
        'username'=>$username,
        'userpass'=>$userpass           
       );
	 	$this->load->view('admin/loginpage.html',$data);
         return;        
       }

//        $dbSelect="SELECT * FROM jokeParams";
//        $typesList=arrayQuery($dbSelect,MYSQL_ASSOC);       
                       
       $data=array(
        'list'=>arrayQuery("SELECT * FROM jokeParams",MYSQL_ASSOC),
        'pages'=>arrayQuery("SELECT * FROM `pages`",MYSQL_ASSOC)           
       ); 
        
       $this->load->view('admin/startpage.html',$data);
        
	}    
}
?>