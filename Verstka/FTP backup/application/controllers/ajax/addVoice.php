<?php
class addVoice extends CI_Controller {

	function index()
	{
	   
       if(!isset($_POST['voice']) ||  !isset($_POST['jokeID']))
        return false;
        
        $data=array();
            $data['voice']=(int)$_POST['voice'];
            $data['joke']=(int)$_POST['jokeID'];
        
        $this->insert($data);
	}
  private function insert($data){
    $dbInsert="
    INSERT INTO `voices` 
    SET 	
        voice='".$data['voice']."', 
        joke='".$data['joke']."',
        ip='".$_SERVER['REMOTE_ADDR']."'
        
    ON DUPLICATE KEY UPDATE 
        voice='".$data['voice']."'
    "; 
    if(!query($dbInsert))
        return false;
         
    $dbUpdate="UPDATE `jokes` SET rate=(SELECT SUM(voice) FROM `voices` WHERE joke='".$data['joke']."') 
            WHERE id='".$data['joke']."'" ;
    query($dbUpdate); 
    
  }  
             
}
?>