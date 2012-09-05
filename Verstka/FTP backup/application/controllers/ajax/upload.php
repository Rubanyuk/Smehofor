<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/class/bioTools.php';
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

class FileLoader
{
var $errObj;
var $messObj;
var $clientID;
var $pageID;
var $upDir;
var $upDirX100;
var $upDirX150;
var $db;
function FileLoader($cid,$pid){
    
    $this->clientID=(int)$cid;
    $this->pageID=(int)$pid;    
    $this->upDir=null;
    if(!$this->clientID){
         $this->errObj="Войдите как пользователь";
        return false;       
    }
    
    if(!$this->pageID){
         $this->errObj="Не указан уникальный номер продукта. Попробуйте перезагрузить страницу.";
        return false;       
    }    
    $this->upDir=$_SERVER['DOCUMENT_ROOT'].'/upload/'.$this->pageID;
    $this->upDirX100=$this->upDir."/100x100/";
    $this->upDirX150=$this->upDir."/150x150/";
    
    $this->db=new bioTools();
    $this->db->dbConnect();    
    
}

private function isUserPage(){
    $dbSelect="SELECT * FROM `products` WHERE id=$this->pageID AND user=$this->clientID";
    $answer=$this->db->rowQuery($dbSelect,array('cell'=>'id') );
    if(!$answer) return false;
}

function load($loadname)
 {
    if($this->upDir==null) return false;
    
    $filename = $_FILES[$loadname]['name']; //имя файла
    $filetmpname = $_FILES[$loadname]['tmp_name']; //адрес tmp
    $fileType = $_FILES[$loadname]["type"]; //тип файла
    $fileSizeMB = round(($_FILES[$loadname]["size"] / 1024 / 1000),2); //размер файла
	
    if(!$filename)return false;
        
    $ext=explode(".",$_FILES[$loadname]['name']);
    $fname=$ext;
    unset($fname[count($fname)-1]);
    $fname=implode('.',$fname);
    $ext=strtolower($ext[count($ext)-1]);
    $type=0;
       
    if($ext=='txt'||$ext=='doc'||$ext=='pdf'||$ext=='xls') $type=1;
    
    if($ext=='jpg'||$ext=='jpeg'||$ext=='png'||$ext=='gif'||$ext=='bmp') $type=2;
           
    if(!$type):
        $this->errObj="Недопустимое расширение";
        return false;
    endif;        

    if($fileSizeMB>10 && $type==1):
        $this->errObj="Размер файла не должен превышать 10 МБ";
        return false;        
    endif;

    if($fileSizeMB>1.4 && $type==2):
        $this->errObj="Размер фото не должен превышать 1 МБ";
        return false;        
    endif;    
    
    
    if(!$this->pageID):
        $this->errObj="Отсутствует уникальный номер страницы. Возможно вы в режиме создания. Сохраните страницу и откройте редактирование";
        return false;
    endif;
    $uploadFileDir=$this->upDir;

    
    if($this->isUserPage() ):
        $this->errObj="Мы не можем найти эту страницу в базе. Возможно она принадлежит другому пользователю";
        return false;
    endif;
    
    if(!is_dir($uploadFileDir)){ mkdir($uploadFileDir); chmod($uploadFileDir,0777);}
    if(move_uploaded_file($_FILES[$loadname]['tmp_name'],$uploadFileDir."/".$filename))
    {
	if(!is_file($uploadFileDir."/".$filename)):
           $this->errObj="Ошибка копирования файла.";
           return false;		
	endif;
      
        $this->db->query("INSERT INTO `files` SET name='".$filename."', product=$this->pageID, type=$type");
        if($type==2):            
            mkdir($this->upDirX100);
            chmod($this->upDirX100,0777);
            img_resize($uploadFileDir."/".$filename, $this->upDirX100.$fname.".jpg", 100, 100);

            mkdir($this->upDirX150);
            chmod($this->upDirX150,0777);
            img_resize($uploadFileDir."/".$filename, $this->upDirX150.$fname.".jpg", 150, 150);            
        endif;
            
        
        return true;
    }
    $this->errObj="Неизвестная ошибка";
    return false;
 }
function getFiles()
{
$answer=$this->db->arrayQuery("SELECT * FROM `files` WHERE product=$this->pageID ORDER BY id DESC");
$obj='';
for($i=0;$i<count($answer);$i++):
    $obj.=$this->db->parseChunk( ($i+1).'. [+name+]<a href="javascript:;" class="fileDelete" rel="[+id+]"> удалить</a><br>',$answer[$i]);
endfor;

return $obj;
}

function deleteFile($id)
{
    if($this->isUserPage() ):
        $this->errObj="Мы не можем найти эту страницу в базе. Возможно она принадлежит другому пользователю";
        return false;
    endif;    
    
    if($this->upDir==null) return false;
    $id=(int)$id;
    if(!$id) return false;
    
    $name=$this->db->rowQuery("SELECT * FROM `files` WHERE id=$id",array('cell'=>'name'));
            
    $filePath=$this->upDir.'/'.$name;           
    $fname=explode(".",$name);
    unset($fname[count($fname)-1]);
    $fname=implode('.',$fname);
	if(file_exists($filePath)):
            unlink($filePath);
        
            unlink($this->upDirX100.'/'.$fname.".jpg");
            unlink($this->upDirX150.'/'.$fname.".jpg");
        endif;
    $this->db->query("DELETE FROM `files` WHERE name='".$name."' AND product=$this->pageID");    
}


}

if(!$_GET['id']) return;
$id=explode('|',$_GET['id']);

session_id($id[1]);
session_start();

$fload=new FileLoader($_SESSION['user_id'],$id[0]);
if($_GET['del']){
	$fload->deleteFile($_GET['del']);  	
}else{
	$fload->load('Filedata');
	echo $fload->errObj."<br>";
	echo $fload->messObj;	
}
echo $fload->getFiles();

?>
