<?php
 
function SQLFecha($fecha) {  // Ordena una fecha como #MES/dia/año# para hacer sentencias SQL
	$salida;	
	$salida = "#" . CStr( month($fecha)."/".day($fecha)."/" .year($fecha) )."#";
	return $salida;
}
// Función para generar passwords aleatorios 
 function generarPassword($largo) { 
    
	$psswd = substr( md5(microtime()), 1, $largo);
	return $psswd;
 }

/* 
function verificarEmail($email){  
  if(!ereg("^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})$",$email))
  {  
     return FALSE;  
  } else {  
      return TRUE;  
  } 
  
 */
function verificarEmail($email_address)
{
   if( !preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email_address))
    {
       return false;
    }
    return true;
}

if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
  		if (PHP_VERSION < 6) {
   			 $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  		}

  		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  		switch ($theType) {
    		case "text":
      			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      			break;    
    		case "long":
    		case "int":
      			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
      			break;
    		case "double":
      			$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      			break;
    		case "date":
      			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
     			break;
    		case "defined":
     			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      			break;
  		}
  		return $theValue;
	}
}

?>