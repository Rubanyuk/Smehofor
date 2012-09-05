<?php
include_once $_SERVER['DOCUMENT_ROOT']."/application/libraries/errors.php";
class regValid extends Validate
{

  function isOutValid($type,$value){  
	 $info=$this->getInfo($type); 
	 $info['value']=$value;
	 $this->isValid($info);
  }

  function isValid($inputData){  
	 global $error;
	 $errors='';	 
	 if($inputData['status']=='need' && !$inputData['value'])
			$errors.=$error['valid'][0];
			
	 if(strlen($inputData['value'])>50)
			$errors.=$error['valid'][1];
	 
	if($errors):
			if($inputData['label'])
				$errors=str_replace('label',$inputData['label'],$errors);				
			$this->errObj=$errors;
			return true;
	endif;

	 if(!$inputData['value'])
	 	return true;
	 
	 switch($inputData['type'])
	 {
	   case "number":
   	   {
	 	if(!is_numeric($inputData['value'])):
			$errors.=$error['valid'][4];
			break;
		endif;
	   }break;
	   case "email":
   	   {
	 	if(!$this->isEmail($inputData['value']))
		{
			$errors.=$error['email'][0];
			break;
		}
		if($this->isEmailInDb($inputData['value']))
			$errors.=$error['email'][1];
	   }break;
	   case "text":
   	   {
	 	if(!$this->isText($inputData['value']))
			$errors.=$error['valid'][3];
	   }break;
	   case "password":
   	   {
	 	if(!$this->isText($inputData['value'])):
			$errors.=$error['valid'][3];
			break;
		endif;
	 	if(strlen($inputData['value'])<6 || strlen($inputData['value'])>12):
			$errors.=$error['password'][0];
			break;
		endif;			
	   }break;
	   case "capcha":
   	   {
	 	if(!$_SESSION['veriword']):
			$errors.=$error['capcha'][2];
			break;
		endif;
	 	if(!$this->isCapcha($inputData['value']))
			$errors.=$error['capcha'][0];
	   }break;
	   case "login":
   	   {
	 	if(!$this->isText($inputData['value'])):
			$errors.=$error['valid'][3];
			break;	
		endif;
	 	if($this->isLoginInDb($inputData['value'])):
			$errors.=$error['login'][0];
			break;
		endif;
	 	if(strlen($inputData['value'])>30):
			$errors.=$error['login'][1];
			break;
		endif;
	 	if(strlen($inputData['value'])==1):
			$errors.=$error['login'][2];
			break;
		endif;
	 	if(is_numeric($inputData['value'])):
			$errors.=$error['login'][3];
			break;
		endif;
				
	   }break;
	   case "WMZ":
   	   {
	 	if(!$this->isPurseWMZ($inputData['value']))
			$errors.=$error['purseWMZ'][0];
	   }break;
	}

	if($inputData['label'])
		$errors=str_replace('label',$inputData['label'],$errors);
		
	if($errors):
		$this->errObj=$errors;	
		return true;
	endif;
	
	return false;
  }


  function isEmailInDb($email){
	  $tool=new Tools();
	  $email=addslashes(strtolower($email));
	  $dbAcc="SELECT COUNT(*) FROM `usersData` WHERE `email`='".$email."'";
	  $mailInDbPointer=$tool->query($dbAcc);
	  $mailCount=$tool->getRow($mailInDbPointer);
	  if($mailCount['COUNT(*)']>0)
	  	return true;
		
	  return false;	
  }  

  function isLoginInDb($username){
	  $tool=new Tools();
	  $username=addslashes($username);
	  $dbAcc="SELECT COUNT(*) FROM `users` WHERE `username`='".$username."'";
	  $usernameInDbPointer=$tool->query($dbAcc);
	  $usernameCount=$tool->getRow($usernameInDbPointer);
	  if($usernameCount['COUNT(*)']>0)
	  	return true;
		
	  return false;	
  }    

private function getInfo($rel){
	$info=array();
	$info['label']='';
	$info['status']='';
		
	if(!$rel):
		$info['type']='text';
		return $info;
	endif;
	
	$infoTmp=explode(':',$rel);
	$info['type']=$infoTmp[0];
	if(!$info['type'])
		$info['type']='text';
		
	if(isset($infoTmp[1]))
		$info['label']=$infoTmp[1];
		
	if(isset($infoTmp[2]))
		$info['status']=$infoTmp[2];
		
	return 	$info;		
 }

} 
?>