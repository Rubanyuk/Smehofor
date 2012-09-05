<?php
class Tools
{
var $dbCon;
function Tools()
{
	$this->dbCon=$this->modxConnect();
}

    function getLoginUserId() {
    return $_SESSION[userId];
    }
	
    function login() {
	if(!isset($_POST[login])){return;}
	if(strlen(trim($_POST[username]))>15 || strlen(trim($_POST[password]))>15){return;}
	$access=$this->query("SELECT * FROM `users` WHERE username='".trim($_POST[username])."' AND password='".md5(trim($_POST[password]))."' ");
	$persona=$this->getRow($access);
	if($persona[id]){$_SESSION[userId]=$persona[id];}
    }

    function query($sql) {
	if(!trim($sql)){return;}	
	//$connect=Tools::modxConnect();
	$result=mysql_query($sql);
    return $result;
    }
		
    function getRow($pointer) {
	if(!trim($pointer)){return;}
	$result=mysql_fetch_array($pointer);
    return $result;
    }	
	
	function s($str,$mod=0) {
	$result=trim($str);
	if(!trim($result)){return;}	
	if($mod){$result=str_replace(array('"',"'","`","%"),'',$result);}
	
    return $result;
    }	

	function mysqlShield($str,$mod=0) 
	{
	$result=trim($str);
	if(!trim($result)){return;}
	$result=mysql_real_escape_string(htmlspecialchars($result));
	if($mod){$result=str_replace(array('"',"'","`","%"),'',$result);}
	return $result;
	}
	
	function getInsertId() {
      return mysql_insert_id();
   }
         
	function getAffRows() {
        return mysql_affected_rows();
   }   


	static function modxConnect()
	{
	include($_SERVER['DOCUMENT_ROOT']."/manager/includes/config.inc.php");
	//global $dbase,$database_server,$database_user,$database_password,$table_prefix,$database_connection_method,$database_connection_charset;
	$db=array();
	$db[dbase] =str_replace('`','',$dbase);
	$db[tablePrefix] = $table_prefix;
	$dbCon=mysql_pconnect($database_server,$database_user,$database_password);
	mysql_select_db($db[dbase],$dbCon);
	$set_cod=$database_connection_method." ".$database_connection_charset;
	mysql_query($set_cod,$dbCon);
	$db[connect] = $dbCon;
	return $dbCon;
	}

    function parseChunk($chunk, $chunkArr, $prefix= "[+", $suffix= "+]") {
        if (!is_array($chunkArr)) {
            return false;
        }
        foreach ($chunkArr as $key => $value) {
            $chunk= str_replace($prefix . $key . $suffix, $value, $chunk);
        }
        return $chunk;
    }

    function arrayQuery($sql,$assoc=MYSQL_BOTH) 
	{
		//$connect=Tools::modxConnect();
		if(!$sql){return false;}
		$dbAcc=mysql_query($sql);
		if(!$dbAcc){return false;}
		while($row=mysql_fetch_array($dbAcc,$assoc)):
                    if($row)$dbRow[]=$row;
                endwhile;
		if(!$dbRow){return false;}
		return $dbRow;
	}

    function rowQuery($sql,$cell=null,$assoc=MYSQL_BOTH) 
	{            
            if(!$sql)  return false;
            $dbAcc=mysql_query($sql);
                
            if(!$dbAcc) return false;                
            $dbRow=mysql_fetch_array($dbAcc,$assoc);
            if($cell!=null)
                 return  $dbRow[$cell];  
            return $dbRow;
	}
        
    function arrayParse($chunk,$arr) 
	{	
	$dbRquest="SELECT * FROM `modx_site_htmlsnippets` WHERE name='".trim($chunk)."'";	
	$dbSelect=$this->query($dbRquest);
	$html=$this->getRow($dbSelect);	
	$html=$html[snippet];

	$answer='';
	for($i=0;$i<count($arr);$i++)
	{
		$answer.=$this->parseChunk($html,$arr[$i]);
	}
	
		return $answer;
    }

	function getChunk($chunkPath)
	{
	if(!is_file($chunkPath)){return false;}
	return file_get_contents($chunkPath);
	}   
   
	function saveLog($log)
	{   

 	}
   
}


// ����� ������������ �������
//������  morf('����','���','����');
function morf($f1,$f2,$f3,$n0)
{
    $n =abs($n0)%100;
    $n1= $n%10;
    if ($n>10 && $n<20) return $f3;
    if ($n1>1 && $n1<5)return $f2;
    if ($n1==1)return $f1;
    return $f3;
}
if(!function_exists('pre')) {
    function pre($arr){
	   echo "<pre>";
	   print_r($arr);
	   echo "</pre>";
    }
}
function toJSON($array){
$jSON="{";
foreach($array as $key=>$val):
    $jSON.='"'.$key.'":';
    if(is_array($val)){
        $jSON.=toJSON($val);
    }else{
        $jSON.='"'.$val.'",';
    }
endforeach;
$jSON=trim($jSON,',');
$jSON.='}';
return $jSON;
}

// start cms session
if(!function_exists('startCMSSession')) {
    function startCMSSession(){
        session_name('SN4eb3e67267a27');//$site_sessionname
        session_start();
    }
}
?>
