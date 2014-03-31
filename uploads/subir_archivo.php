<?php
if (isset($_FILES['archivo'])) {
   $archivo = $_FILES['archivo'];
   $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
   $time = time();
   if($extension!="pdf") {
	   echo 2;
	   exit();
   }
   
   //$nombre = "{$_POST['nombre_archivo']}_$time.$extension";
   $nombre = "{$_POST['nombre_archivo']}";
   $datos=explode("_",$nombre);
   $nif=$datos[0];
   $idfabrica=$datos[1];
   $adjunto =1;
   $nombre .= ".$extension";
   include ("../Funciones/funciones.php"); 
   include ("../Conexiones/conexion_local.php");
	$strSQL;
 	$enllac = mysql_connect($servidor,$usuari,$contrasenya);
 	mysql_select_db($baseDatos,$enllac);
	mysql_set_charset('utf8');
   
   $strSQL = "update PRODUCTO set ADJUNTO =" . "'" . $adjunto . "'";
   $strSQL = $strSQL . " where NIF = '" .  $nif . "' and ID_FABRICA = '" . $idfabrica . "'" ; 
	
   
   if (move_uploaded_file($archivo['tmp_name'], "archivos_subidos/$nombre")) {
	  $resultat = mysql_query($strSQL, $enllac);
	if (!$resultat)  die('Error: ' . mysql_error());
   	mysql_close($enllac); 
      echo 1;
   } else {
      echo 0;
   }
}
?>