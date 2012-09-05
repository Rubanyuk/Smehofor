<?php
class addBayan extends CI_Controller {

	function index()
	{
	   
       if( !isset($_POST['jokeID']))
        return false;
        
        $data=array();
            $data['bayan']=(int)$_POST['bayan'];
            $data['boroda']=(int)$_POST['boroda'];
            $data['joke']=(int)$_POST['jokeID'];
        
        $data['type']=0;
        
        if($data['boroda'])
            $data['type']=1;
            
        $this->insert($data);
	}
  private function insert($data){
    
    $dbInsert="
    INSERT INTO `bayan` 
    SET 	
        bayan='".$data['bayan']."',
        boroda='".$data['boroda']."',
        `type`='".$data['type']."', 
        joke='".$data['joke']."',
        ip='".$_SERVER['REMOTE_ADDR']."'
        
    ON DUPLICATE KEY UPDATE 
        bayan='".$data['bayan']."',
        boroda='".$data['boroda']."',
        `type`='".$data['type']."'
    "; 
    if(!query($dbInsert))
        return false;
         
    $dbUpdate="
    UPDATE `jokes` SET 
        bayan=(SELECT SUM(bayan) FROM `bayan` WHERE joke='".$data['joke']."'),
        boroda=(SELECT SUM(boroda) FROM `bayan` WHERE joke='".$data['joke']."'),
         
    WHERE id='".$data['joke']."'" ;
    query($dbUpdate); 
    
  }  
             
}
?>