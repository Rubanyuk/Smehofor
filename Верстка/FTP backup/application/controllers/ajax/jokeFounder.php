<?php
class jokeFounder extends CI_Controller {
var $step=5;
var $type=0;
var $order='ORDER BY `data`';

	function index()
	{

        arraySlashes($_POST);

        if(isset($_POST['find']))
            $LIKE=$_POST['find'];

        $page=1;
        if(isset($_POST['page']))
            $page=(int) $_POST['page'];
        
        
        if($_POST['order']=='rnd')
            $this->order='ORDER BY RAND()';

        if($_POST['order']=='best')
            $this->order='ORDER BY rate';
            
            
        $jokes=$this->showFind($LIKE);
        if($jokes){
            echo json_encode(array(
                'type'=>'message',
               // 'count'=>$this->getCount(),
                'count'=>1,
                'jokes'=>$jokes
            ));
            return;
        }
                

            echo json_encode(array(
                'type'=>'error',
                 'answer'=>'0'   
            ));
        

	}
  private function show($page=1) {
    
    $start=($page-1)*$this->step;
    
    $dbSelect="SELECT * FROM `jokes` WHERE `type`=".$this->type." AND `on`=1 AND  `deleted`=0 ".$this->order." DESC LIMIT $start,".$this->step;
        
    if(!$this->type)
        $dbSelect="SELECT * FROM `jokes` WHERE `on`=1 AND `deleted`=0 ".$this->order." DESC LIMIT $start,".$this->step;


    $jokes=arrayQuery($dbSelect,MYSQL_ASSOC);
 
     arraySlashes($jokes,false);

    return  $jokes;    
  }  

 function getCount(){
         
    $dbCount="SELECT COUNT(*) FROM `jokes` WHERE `type`=".$this->type." AND `on`=1 AND  `deleted`=0 ";
    
   if(!$this->type) 
    $dbCount="SELECT COUNT(*) FROM `jokes` WHERE `on`=1 AND  `deleted`=0 "; 
    
    return round(rowQuery($dbCount,'COUNT(*)')/$this->step);    
 }    
  
  
  private function showFind($LIKE) {
    
    $dbSelect="SELECT * FROM `jokes` WHERE `content` LIKE '%".$LIKE."%' AND `on`=1 AND  `deleted`=0 ".$this->order." DESC LIMIT 0, 10";
                
    
    $LIKE=(int)$LIKE;        
    if($LIKE)
        $dbSelect="SELECT * FROM `jokes` WHERE id=".trim($LIKE)." AND `on`=1 AND `deleted`=0 ";    



    $jokes=arrayQuery($dbSelect,MYSQL_ASSOC);
 
     arraySlashes($jokes,false);

    return  $jokes;    
  }          
}
?>