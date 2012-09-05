<?php
class Validate {

var $errObj;
var $messObj;
var $err;
var $mess;

  function Validate(){
	$this->errObj='';
	$this->messObj='';	
  }

  function isEmail($email) {
    //email is not case sensitive make it lower case
    $email =  strtolower($email); 
//    if (preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i",$email))
	  if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email))
    	return true;
		
    return false;
  }
 
  function isText($text) {
    if (preg_match("/^[_0-9A-Za-zА-Яа-яЁё.!() ]+$/u",$text))
    	return true;
		
    return false;
  }

  function isNumber($number) {
    if (preg_match("/[0-9- +()_]/i",$number))
    	return true;
		
    return false;
  }
  
  function isCapcha($capcha) {
	$sesCap=strtolower($_SESSION['veriword']);
	if ($sesCap==strtolower($capcha) )
    //if (!abs(strcasecmp($_SESSION['veriword'],$capcha)))
    	return true;
		
    return false;
  }

  function isPurseWMZ($purseWMZ){
	  $purseWMZ=addslashes($purseWMZ);
	  if(strlen($purseWMZ)!=13)
	  	return false;	
	  if(strtoupper(substr($purseWMZ,0,1))!='Z')
	  	return false;
	  if(!is_numeric( (substr($purseWMZ,1)) ))
	  	return false;
		
	  return true;	
  } 
    
}

?>