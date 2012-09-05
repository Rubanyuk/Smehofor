<?php

class adminPages extends CI_Controller {

	function index()
	{
   
        arraySlashes($_POST);
        $action='show';
        if(isset($_POST['action']))
            $action=$_POST['action'];
            
        switch($action)
        {
            case "save":   {
                $this->save($_POST);
                break;
            }             
                
        }

        $obj=$this->show($_POST['type']);                        
        echo  $obj;           

	}
  
  private function save($data) {
    $dbUpdate="
    UPDATE `pages` SET 
        content='".str_replace("\n","<br>",$data['content'])."',
        pagetitle='".$data['pagetitle']."'
    WHERE id=".$data['type'];

    query($dbUpdate);
  }
  
  private function show($type) {
   $dbSelect="SELECT * FROM `pages` WHERE id=$type";

   $contentObject=rowQuery($dbSelect,null,MYSQL_ASSOC);
    
   arraySlashes($contentObject,false);
   
  $contentObject['content']= str_replace("<br>","\n",$contentObject['content']); 
   
   $wrapChunk='
   <table class="moder" border="1">       
       <th align="center">
        <button type="button" class="pageSubmit" value="save" style="width:600px;height:20px" >Сохранить</button>
       </th>
   <tr>
       <td colspan="4" align="center">
           <input type="text" name="pagetitle" size="160" value="[+pagetitle+]">               
       </td>
   </tr>   
   <tr>
       <td colspan="4" align="center">
           <textarea name="content" rows="25" cols="120">[+content+]</textarea>
       </td>
   </tr>
   <tr>
       <th align="center">
        <button type="button" class="pageSubmit" value="save" style="width:600px;height:20px" >Сохранить</button>
       </th>
   </tr>
    </table>
    <input type="hidden" name="action" value="show" class="action">
   ';
   
   return parseChunk($wrapChunk, $contentObject );
  }

}

        

?>