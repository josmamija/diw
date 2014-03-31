<meta charset="utf-8">
<?php
if (isset($_POST['accion'])) { 
	$desde="proveedor";
    $nif=$_POST['nif'];
	$desde="proveedor ".$nif;
	$fecha_actual = date("Y-m-d H:i:s");
	
	$asunto="Datos bancarios ";
	$TextBody = "DNI/NIF: " . $nif;
	$sDestino= "gestion@gesdesc.com";
	$asunto.= $desde ;
	$TextBody .= "<br> ". $_POST["emailb"];
	$TextBody .= "<br> Titular: ". $_POST["titular"];
	$TextBody .= "<br> Número de cuenta: ";
	$TextBody .=  $_POST["entidad"];
	$TextBody .= "-". $_POST["oficina"];
	$TextBody .= "-". $_POST["control"];
	$TextBody .= "-". $_POST["cuenta"];
	
	$TextBody .= "<br><br> Fecha". $fecha_actual;
	
	
	$remitente =$_POST["emailb"];
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Additional headers
	$headers .= 'From: '. $remitente . "\r\n";
	// Additional headers
	mail ($sDestino, $asunto, $TextBody, $headers);  
	//EnviarCorreo($sDestino,$TextBody,$remitente,$asunto);
	echo "<br>Proximamente recibirá un e-mail con los datos de acceso al sistema. Gracias<br>"; 
	if($desde=="profesional")echo "<a href='../clientes/menu_g_c2.php'>Login</a>";
	else echo "<a href='../proveedores/menu_g_p2.php'>Login</a>";
	exit();
}
?> 
