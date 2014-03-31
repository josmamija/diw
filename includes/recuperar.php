<meta charset="utf-8">
<?php
if (isset($_POST['accion'])) { 
	$desde=$_POST['desde'];
    $dni=$_POST['dni'];
	$fecha_actual = date("Y-m-d H:i:s");
	$radio=$_POST["radios"];
	if($radio==1) {
		$asunto="Recuperar password ";
		$TextBody = "Usuario: " . $_POST["usuarior"];
	}else if($radio==2){
		 $asunto="Recuperar usuario ";
		 $TextBody = "Password: " . $_POST["pwdr"];
	}else  {
		$asunto="Recuperar usuario y password ";
		$TextBody = "DNI/NIF: " . $_POST["dnir"];
	}
	$sDestino= "gestion@gesdesc.com";
	$asunto.= $desde ."  " .$fecha_actual ;
	$TextBody .= "<br> ". $_POST["emailr"];
	$remitente =$_POST["emailr"];
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Additional headers
	$headers .= 'From: '. $remitente . "\r\n";
	// Additional headers
	mail ($sDestino, $asunto, $TextBody, $headers);  
	//EnviarCorreo($sDestino,$TextBody,$remitente,$asunto);
	echo "<br>Proximamente recibirá un correo con los datos de su cuenta. Gracias<br>"; 
	if($desde=="profesional")echo "<a href='../clientes/menu_g_c2.php'>Login</a>";
	else echo "<a href='../proveedores/menu_g_p2.php'>Login</a>";
	exit();
}
?> 
