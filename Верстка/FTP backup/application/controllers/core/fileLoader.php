<?php 

class fileLoader extends CI_Controller{
var $errObj;
var $messObj;
var $clientID;
var $pageID;
var $upDir;

function index(){

//$cid=$_SESSION['user_id'];


    $this->upDir=$_SERVER['DOCUMENT_ROOT'].'/upload/';
	
    $this->load('Filedata');
	echo $this->errObj."<br>";
	echo $this->messObj;	


    
/*
    $this->clientID=(int)$cid;
    $this->pageID=(int)$pid;    
    $this->upDir=null;
    if(!$this->clientID){
         $this->errObj="Войдите как пользователь";
        return false;       
    }
  */  


       
}

function load($loadname)
 {
    
    $filename = $_FILES[$loadname]['name']; //имя файла
    $filetmpname = $_FILES[$loadname]['tmp_name']; //адрес tmp
    $fileType = $_FILES[$loadname]["type"]; //тип файла
    $fileSizeMB = round(($_FILES[$loadname]["size"] / 1024 / 1000),2); //размер файла
	
    if(!$filename)return false;
        
    $ext=explode(".",$_FILES[$loadname]['name']);
    $fname=time();
    $ext=strtolower($ext[count($ext)-1]);
    
    $filename=$fname.'.'.$ext;
    
    $type=0;
       
    if($ext=='avi'||$ext=='flv') {
        $uploadFileDir=$this->upDir.'video';
        $type=7;
    }
    
    if($ext=='jpg'||$ext=='jpeg'||$ext=='png'||$ext=='gif') {
        $type=6;
        $uploadFileDir=$this->upDir.'img';
    }       
    if(!$type):
        $this->errObj="Недопустимое расширение";
        return false;
    endif;        

    if($fileSizeMB>10 && $type==7):
        $this->errObj="Размер видео не должен превышать 10 МБ";
        return false;        
    endif;

    if($fileSizeMB>1 && $type==6):
        $this->errObj="Размер фото не должен превышать 1 МБ";
        return false;        
    endif;    
    
    
    if(move_uploaded_file($_FILES[$loadname]['tmp_name'],$uploadFileDir."/".$filename))
    {
	if(!is_file($uploadFileDir."/".$filename)):
           $this->errObj="Ошибка копирования файла.";
           return false;		
	endif;
      
      query("INSERT INTO `jokes` SET type=$type, data='".time()."', `on`=1");
      $jokeID=getInsertId();
      query("INSERT INTO `files` SET name='".$filename."', joke=$jokeID");
                   
      return true;
    }
    $this->errObj="Неизвестная ошибка";
    return false;
 }

}



?>
