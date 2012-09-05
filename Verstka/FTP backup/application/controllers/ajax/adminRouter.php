<?php
include_once $_SERVER['DOCUMENT_ROOT']."/application/libraries/errors.php";
class adminRouter extends CI_Controller {

	function index()
	{
//     pre($_POST);
        arraySlashes($_POST);
        $action='show';
        if(isset($_POST['action']))
            $action=$_POST['action'];
            
        switch($action)
        {
            case "add":   {
                $this->add($_POST);
                break;
            }             
            case "kill":   {
                $this->kill($_POST['kill']);                
                break;
            }

            case "mercy":   {
                $this->mercy($_POST);                
                break;
            }
            
            case "delFile":   {
                $this->deleteFile($_POST['mercy']);                
                break;
            }            
              
        }
        if($_POST['type']==6 || $_POST['type']==7){
            $obj=$this->showFiles($_POST['type']);
        }else{
            $obj=$this->show($_POST['type']);    
        }
                    
        echo  $obj;           

	}
  private function add($data){
    if(strlen($data['content'])<10)
        return  false;
        

    $dbInsert="INSERT INTO `jokes` SET 	
        type='".$data['type']."', content='".str_replace("\n","<br>",$data['content'])."',
        `data`='".time()."',
        `on`=1    
    "; 
    
    query($dbInsert);
 
    return true;
  }  
  
    private function kill($data){
     foreach($data as $key=>$val){
        $dbUpd="UPDATE `jokes` SET `deleted`=1 WHERE id=$key";
        
        query($dbUpd); 
     }
        
    return true;
  }

    private function mercy($data){
        $dbSelect="SELECT * FROM `jokes` WHERE `type`=".$data['type']." AND `deleted`=0  ORDER BY `id` DESC LIMIT 0,50";
        $ids=arrayQuery($dbSelect);
        $id=$ids[count($ids)-1]['id'];
        
        $dbUpd="UPDATE `jokes` SET `on`=0 WHERE id>$id AND `type`=".$data['type']." AND `deleted`=0";
        
        query($dbUpd); 
        
        
     $mercy=$data['mercy'];    
     foreach($mercy as $key=>$val){
        $dbUpd="UPDATE `jokes` SET `on`=1 WHERE id=$key";
        query($dbUpd); 
     }
         
    return true;
  }
    
  private function show($type) {
   $dbSelect="SELECT * FROM `jokes` WHERE `type`=$type AND `deleted`=0  ORDER BY `id` DESC LIMIT 0,50";

   $jokes=arrayQuery($dbSelect,MYSQL_ASSOC);
       
   arraySlashes($jokes,false);
    
   $chunk='
   <tr>
    <td align="center"><input type="checkbox" name="mercy[{id}]" {on}> </td>
     <td>{content}</td>
     <td align="center">{rate}</td>
     <td align="center"><input type="checkbox" name="kill[{id}]" > </td>
   </tr>';
   

   for($i=0;$i<count($jokes);$i++){
    if($jokes[$i]['on']){
        $jokes[$i]['on']='checked';
    }else{
        $jokes[$i]['on']='';
    }
   }
   
   $contentObject=arrayParse($chunk,$jokes,'{','}');
   
   $wrapChunk='
   <table class="moder" border="1">
   <tr>
       <th><button type="button" class="submit" value="mercy">Одобрить</button></th><th>Шутка </th>  <th>Рейтинг</th><th><button type="button" class="submit" value="kill">Удалить</button></th>
   </tr>
    [+content+]
   <tr>
       <th><button type="button" class="submit" value="mercy">Одобрить</button></th><th>Шутка </th>  <th>Рейтинг</th><th><button type="button" class="submit" value="kill">Удалить</button></th>
   </tr>
   
   <tr>
       <td colspan="4" align="center"><textarea name="content" rows="12" cols="120"></textarea></td>
   </tr>
      <tr>
       <th colspan="4" align="center"><button type="button" class="submit" value="add" style="width:500px;height:40px" >Добавить</button></th>
   </tr>
    </table>
    <input type="hidden" name="action" value="add" class="action">
   ';
   
   return parseChunk($wrapChunk, array('content'=>$contentObject) );
  }
  
function showFiles($type)
{
$answer=arrayQuery("SELECT * FROM `files` WHERE joke IN (SELECT id FROM `jokes` WHERE type=$type) ORDER BY id DESC");

$obj='';
for($i=0;$i<count($answer);$i++):
    $obj.=parseChunk( ($i+1).'. [+name+]<a href="javascript:;" class="fileDelete" rel="[+joke+]"> удалить</a><br>',$answer[$i]);
endfor;

return $obj;
}


function deleteFile($jokeID)
{
    
    $upDir=$_SERVER['DOCUMENT_ROOT'].'/upload/';
    
    $jokeID=(int)$jokeID;
    if(!$jokeID) return false;
    
    $type=rowQuery("SELECT * FROM `jokes` WHERE id=$jokeID",array('cell'=>'type'));    
    $name=rowQuery("SELECT * FROM `files` WHERE joke=$jokeID",array('cell'=>'name'));
    
    
    if($type==6)   
        $filePath=$upDir.'img/'.$name;           

    if($type==7)   
        $filePath=$upDir.'video/'.$name;

	if(file_exists($filePath)):
            unlink($filePath);
    endif;
    query("DELETE FROM `files` WHERE joke=$jokeID");    
    query("DELETE FROM `jokes` WHERE id=$jokeID");
}


}

        

?>