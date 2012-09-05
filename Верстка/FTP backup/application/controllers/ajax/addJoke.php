<?php
include_once $_SERVER['DOCUMENT_ROOT']."/application/libraries/errors.php";
class addJoke extends CI_Controller {

	function index()
	{
	   global $error;
       global $message;
       if(!isset($_POST['addJokeSubmit']) )
        return false;
        
        $data=array();
        if(isset($_POST['Section']))
            $data['type']=(int)$_POST['Section'][0];            
         
        if(isset($_POST['shot']))
            $data['content']=addslashes(trim($_POST['shot']));

        if(isset($_POST['email']))
            $data['email']=addslashes(trim($_POST['email']));
        
        if(isset($_POST['capcha']))      
            $data['capcha']=trim($_POST['capcha']);
            
        
        $this->load->library('session'); 

       if(strlen($data['content'])<5){
            echo '{"answer":"'.$error['add'][0].'","type":"error"}';
            return false; 
       }

       if(strlen($data['content'])<20){
            echo '{"answer":"'.$error['add'][1].'","type":"error"}';
            return false; 
       }       
       
       if($data['email'] && !$this->isEmail($data['email'])){
            echo '{"answer":"'.$error['email'][0].'","type":"error"}';
            return false; 
       }
              
       if(!$data['capcha']){
            echo '{"answer":"'.$error['capcha'][1].'","type":"error"}';
            return false;        
       }
              
       if(!$this->isCapcha($data['capcha'])){
            echo '{"answer":"'.$error['capcha'][0].'","type":"error"}';
            return false; 
       }
       
        if($this->insert($data)){
            echo '{"answer":"'.$message['joke'][0].'","type":"message"}';
            return true;
        }
        
        

	}
  private function insert($data){
    $dbInsert="INSERT INTO `jokes` SET 	
        type='".$data['type']."', content='".$data['content']."',
        `data`='".time()."',
        `on`=0    
    "; 
    
    query($dbInsert); 
    return true;
  }  
    
  private function isCapcha($capcha) {
	$sesCap=strtolower($this->session->userdata('veriword'));
	if ($sesCap==strtolower($capcha) )
    	return true;
		
    return false;
  }
  
  private function isEmail($email) {
    //email is not case sensitive make it lower case
    $email =  strtolower($email); 
//    if (preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i",$email))
	  if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email))
    	return true;
		
    return false;
  }
  
  private function isText($text) {
    if (preg_match("/^[_0-9A-Za-zÀ-ßà-ÿ¨¸.!() ]+$/u",$text))
    	return true;
		
    return false;
  }          
}
?>