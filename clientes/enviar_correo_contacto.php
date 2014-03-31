<?php
if (isset($_POST['accion'])) { 
    $dni=$_POST['dni'];
	$idCliente=$_POST['idCliente'];
	include ("../Conexiones/conexion_local.php");
	include ("../Funciones/funciones.php");
	$sDestino= "comercial@gesdesc.com";
	$enllac = mysql_connect($servidor,$usuari,$contrasenya);
 	mysql_select_db($baseDatos,$enllac);
  	$strSQL;		
 	 $strSQL = "SELECT * FROM CLIENTE " ;
 	 $strSQL = $strSQL . "where DNI = '" . $dni."'" ; 
  	$resultat = mysql_query($strSQL, $enllac);
	if (!$resultat)  die('Error: ' . mysql_error());
  	$count=mysql_num_rows($resultat);
  	if($count==0) header("Location:../clientes/menu_g_c2.php");
  	$fila=mysql_fetch_array($resultat);
	$fecha_actual = date("Y-m-d H:i:s");
	$radio=$_POST["radios"];
	if($radio==1) $asunto="Busqueda  proveedor";
	else if($radio==2) $asunto="Busqueda articulo";
	else if($radio==3) $asunto="Busqueda gremio";
	else $asunto="Incidencia";
	$asunto.= "  " .$fecha_actual ;
	$TextBody = $_POST["comentarios"];
	$remitente =$fila["EMAIL"];
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Additional headers
	$headers .= 'From: '. $remitente . "\r\n";
	// Additional headers
	mail ($sDestino, $asunto, $TextBody, $headers);  
	//EnviarCorreo($sDestino,$TextBody,$remitente,$asunto);
	echo "<br>Su sugerencia ha sido enviada con exito. Gracias<br>"; 
	echo "<a href='menu_c2.php?go=0&dni=$dni&idCliente=$idCliente'>Inicio</a>";
	
	mysql_close($enllac);
	exit();
}
?> 
