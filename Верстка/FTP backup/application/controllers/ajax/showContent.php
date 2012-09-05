<?php
class showContent extends CI_Controller {
var $step=5;
var $type=0;
var $order='ORDER BY `data`';
var $between=''; 
var $borodan='';
	function index()
	{

        arraySlashes($_POST);
        
        $borodan=0;
        
        if(isset($_POST['borodan']))
            $borodan=(int)$_POST['borodan'];
        

        if(isset($_POST['type']))
            $this->type=(int) $_POST['type'];

        $page=1;    
        if(isset($_POST['page']))
            $page=(int) $_POST['page'];

        if($_POST['data']){
            $between=explode("|",$_POST['data']);
           $this->between="
           AND `timedata` BETWEEN 
               STR_TO_DATE('".$between[0]."', '%Y-%m-%d %H:%i:%s')
           AND 
               STR_TO_DATE('".$between[1]."', '%Y-%m-%d %H:%i:%s')";
        }
            
        
        
        if($_POST['order']=='rnd')
            $this->order='ORDER BY RAND()';

        if($_POST['order']=='best')
            $this->order='ORDER BY rate';
            


        if($this->borodan==1){
            $this->borodan=" AND bayan>1";
            $this->order='ORDER BY bayan';
        }

        if($this->borodan==2){
            $this->borodan=" AND boroda>1";
            $this->order='ORDER BY boroda';
        }
                    
            
        $jokes=$this->show($page);
        
        $count=$this->getCount();
        
        if(!$count){
        echo json_encode(array(
            'type'=>'error',
            'count'=>$this->getCount(),
            'jokes'=>$jokes
        ));            
        return false;
        }
        
        echo json_encode(array(
            'type'=>'message',
            'count'=>$this->getCount(),
            'jokes'=>$jokes
        ));        
        

	}
  private function show($page=1) {
    
    $start=($page-1)*$this->step;
    
    $dbSelect="SELECT * FROM `jokes` WHERE `type`=".$this->type." AND `on`=1 AND `deleted`=0 ".$this->between.$this->borodan.$this->order." DESC LIMIT $start,".$this->step;
        
    if(!$this->type)
        $dbSelect="SELECT * FROM `jokes` WHERE `type`<6 AND `on`=1 AND `deleted`=0 ".$this->between.$this->borodan.$this->order." DESC LIMIT $start,".$this->step;

    if($this->type==6)
    $dbSelect="
        SELECT j.*, f.name FROM `files` AS f
            JOIN
        (SELECT * FROM `jokes` WHERE type=".$this->type."  ".$this->between.$this->borodan.$this->order." DESC LIMIT $start,".$this->step.") AS j
        WHERE j.id=f.joke";
        
    $jokes=arrayQuery($dbSelect,MYSQL_ASSOC);
 
     arraySlashes($jokes,false);

    return  $jokes;    
  }  

 function getCount(){
         
    $dbCount="SELECT COUNT(*) FROM `jokes` WHERE `type`=".$this->type." AND `on`=1 AND  `deleted`=0 ".$this->between.$this->borodan;
    
   if(!$this->type) 
    $dbCount="SELECT COUNT(*) FROM `jokes` WHERE `on`=1 AND  `deleted`=0 ".$this->between.$this->borodan; 
        
    return round(rowQuery($dbCount,'COUNT(*)')/$this->step);    
 }    
  
  
         
}
?>