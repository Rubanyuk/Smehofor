<?php

    function query($sql) {
	if(!trim($sql)){return;}	
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

    function parseChunk($chunk, $chunkArr, $prefix= "[+", $suffix= "+]") {
        if (!is_array($chunkArr)) {
            return false;
        }
        foreach ($chunkArr as $key => $value) {
            $chunk= str_replace($prefix . $key . $suffix, $value, $chunk);
        }
        return $chunk;
    }

    function parseTpl($tplPath, $chunkArr, $prefix= "[+", $suffix= "+]") {
        if (!is_array($chunkArr))
            return false;

	    if(!is_file($_SERVER['DOCUMENT_ROOT'].'/'.$tplPath))
            return false;
                
	    $chunk= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$tplPath);
                   
        foreach ($chunkArr as $key => $value) {
            $chunk= str_replace($prefix . $key . $suffix, $value, $chunk);
        }
        return $chunk;
    }

    function arrayQuery($sql,$assoc=MYSQL_BOTH) 
	{
		if(!$sql){return false;}        
		$dbAcc=mysql_query($sql);        
		if(!$dbAcc){return false;}
        $dbRow=array();
		while($row=mysql_fetch_array($dbAcc,$assoc)):

            if($row)
                $dbRow[]=$row;
                
        endwhile;
		if(!$dbRow){return false;}
		return $dbRow;
	}
        
    function arrayParse($html,$arr, $prefix= "[+", $suffix= "+]") 
	{	
	$answer='';
	for($i=0;$i<count($arr);$i++)
	    $answer.=parseChunk($html,$arr[$i], $prefix, $suffix);
	
		return $answer;
    }

   function arraySlashes(&$arr,$slash=true){
       if(!is_array($arr))
           return false;
              
     if($slash){  
       foreach($arr as $key=>$val):
            if(is_array($arr[$key])){
             arraySlashes($arr[$key],$slash); 
            }else{
               $arr[$key]=addslashes($val);     
            }           
       endforeach;
     }else{
       foreach($arr as $key=>$val):
            if(is_array($arr[$key])){
               arraySlashes($arr[$key],$slash); 
            }else{
               $arr[$key]=stripslashes($val); 

            }            
       endforeach;
     }
     return true;
   }

	function getChunk($chunkPath)
	{
	if(!is_file($_SERVER['DOCUMENT_ROOT'].'/'.$chunkPath)){return false;}
	return file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$chunkPath);
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

// start cms session
if(!function_exists('startCMSSession')) {
    function startCMSSession(){
        session_name('SN4eb3e67267a27');//$site_sessionname
        session_start();
    }
}
?>
