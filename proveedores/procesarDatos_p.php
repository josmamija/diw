<?php
if (isset($_POST['accion'])) { 
	include ("../Conexiones/conexion_local.php");
	include ("../Funciones/funciones.php");
	include("../PHPMailer-master/enviarCorreo.php");
	$strSQL;
	$enllac = mysql_connect($servidor,$usuari,$contrasenya)
	or die("No se logro conectar con el servidor de Base de datos ".mysql_error());
	mysql_select_db($baseDatos,$enllac)
	or die("No se ha seleccionado la base de datos ".mysql_error());
	mysql_set_charset('utf8');
	// Obtener un password de 8 caracteres 
	if ($_GET['modo'] == "ALTA") {
		$unif=$_POST["nif"];
		$email=$_POST["Email"];
		$nombre=$_POST["nombre"];
		$fecha_actual = date("Y-m-d H:i:s");
		$sPassword = generarPassword(8);
 		$_SESSION['UrlDestino']="menu_g_p2.php?go=2&nif=$unif&emailb=$email&nombre=$nombre";  
    	$strSQL = "insert into PROVEEDOR ";
		$strSQL = $strSQL . "(NOMBRE,NOMBRE_COMERCIAL,NIF,TELEFONO,MOVIL,EMAIL,USUARIO,PWD,DIRECCION,LOCALIDAD,PROVINCIA,PAIS,SECTOR,LINK,FECHA_ALTA)";
		$strSQL = $strSQL . " values (" ;
		$strSQL = $strSQL . "'" . $_POST["nombre"] ;	
		$strSQL = $strSQL . "','" . $_POST["nif"];
		$strSQL = $strSQL . "','" . $_POST["nombreComercial"];
		$strSQL = $strSQL . "','" . $_POST["tfno"] . "','" . $_POST['movil'] ;
		$strSQL = $strSQL . "','" . $_POST["Email"] . "','" . $_POST["usuario"] ;
		$strSQL = $strSQL . "','" . $sPassword . "','" . $_POST["direccion"];
		$strSQL = $strSQL . "','" . $_POST["poblacion"] ;
		$strSQL = $strSQL . "','" . $_POST["provincia"];
		$strSQL = $strSQL . "','" . $_POST["pais"] ;
		$strSQL = $strSQL . "','" . $_POST["sector"] ;
		$strSQL = $strSQL . "','" . $_POST["Link"] ;
		$strSQL .="','".$fecha_actual."')";
    	$resultat = mysql_query($strSQL, $enllac);
		if (!$resultat)  die('Error: ' . mysql_error());
    	mysql_close($enllac);
		$TextBody = "<img src='../images/logoGesdesc.GIF' width='134' height='41' /><br />";
		$TextBody .= "Ha sido dado de alta como proveedor en nuestro Portal: http://www.gesdesc.com<br>";
		/*
		$TextBody .= "Usuario: <font color='red'>" .  $_POST["usuario"]. "</font><br>";
		$TextBody .= "Clave: <font color='red'>" . $sPassword . "</font> <br>";
		$TextBody .= "Email : ".$_POST['Email']."<br>";
		$TextBody .= "NIF : ".$_POST['nif']."<br>";
		$TextBody .= " Pendiente de activar ";
		$sDestino = $_POST['Email'];
		$remitente ="framodala@gmail.com";
		*/
		$asunto ="Registro proveedor ".$_POST['nif'];  
		$TextBody .= "\r\nUsuario: ".  $_POST["usuario"]. "\r\n";
		$TextBody .= "Clave: ". $sPassword . "\r\n";
		$TextBody .= "Email : ".$_POST['Email']."\r\n";
		$TextBody .= "NIF : ".$_POST['nif']."\r\n";
		$TextBody .= " Pendiente de activar ";
		//$remitente ="gestion@gesdes.com";
		// Additional headers		
			
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   		$headers .= 'From: GESDESC <gestion@gesdesc.com>' . "\r\n";
		$asunto ="Registro proveedor ".$_POST['nif']; 
		mail ($sDestino, $asunto, $TextBody, $headers);  
		
		//EnviarCorreo($sDestino,$TextBody,$remitente,$asunto);
		echo "<br>Ha sido dado de ALTA en nuestra WEB<br>"; 
		echo "En breve recibirá un correo electrónico con su password<br>"; 
		echo "Gracias<br>" ;
		//echo "<a href='menu_g_p2.php?'>Inicio</a>";
		//header('Location:' . $_SESSION['UrlDestino']);
		echo "<script language='javascript'>window.location='../proveedores/menu_g_p3.php?go=2&nif=$unif&emailb=$email&nombre=$nombre'</script>;";
	}
	elseif ($_GET['modo'] == "MODIFICAR") { 
    	$unif=$_POST["nif"];
		$_SESSION['UrlDestino']="menu_g_p2.php";
		
    	$strSQL = "update PROVEEDOR set Nombre =" . "'" . $_POST["nombre"] . "',";  
		$strSQL = $strSQL . "NOMBRE_COMERCIAL = " . "'" . $_POST["nombreComercial"] . "',";
		$strSQL = $strSQL . "NIF = " . "'" . $_POST["nif"] . "',";
		$strSQL = $strSQL . "TELEFONO = " . "'" . $_POST["tfno"] . "',";
		$strSQL = $strSQL . "MOVIL = " . "'" . $_POST["movil"] . "',"; 
		$strSQL = $strSQL . "EMAIL = " . "'" . $_POST["Email"] . "',";
		$strSQL = $strSQL . "LINK = " . "'" . $_POST["Link"] . "',";
		$strSQL = $strSQL . "LINK_OFERTAS = " . "'" . $_POST["Link_ofertas"] . "',";
		$strSQL = $strSQL . "USUARIO = " . "'" . $_POST["usuario"] . "',";
		$strSQL = $strSQL . "PWD = " . "'" . $_POST["password"] . "',";
		$strSQL = $strSQL . "DIRECCION = " . "'" . $_POST["direccion"] . "',";
		$strSQL = $strSQL . "LOCALIDAD = " . "'" . $_POST["poblacion"] . "',";
		//$strSQL = $strSQL . "CP = " . "'" . $_POST["cp"] . "',";
		$strSQL = $strSQL . "PROVINCIA = " . "'" . $_POST["provincia"] . "',";
		$strSQL = $strSQL . "SECTOR = " . "'" . $_POST["sector"] . "',";
		$strSQL = $strSQL . "PAIS = " . "'" . $_POST["pais"] . "'";
		$strSQL = $strSQL . " where ID_PROVEEDOR = " .  $_POST["id"]; 
		$resultat = mysql_query($strSQL, $enllac);
		if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
			//header('Location:' . $_SESSION['UrlDestino']);
			echo "<br>Su perfil ha sido modificado en nuestra WEB<br>";
			echo "<a href='javascript:history.back()'>Volver</a>"; 
			//echo "<a href='menu_g_c.php?page=inicio'>Inicio</a>";
			exit();
	}
} elseif (isset($_POST['borrar'])|| isset($_GET['idProveedor']) ) {
			include ("../Conexiones/conexion_local.php");
			if (isset($_POST['borrar'])){
				$idProveedor=  $_POST["id"];
				//$unif=$_POST["nif"];
				$_SESSION['UrlDestino']="menu_g_p2.php";
			}else {
				$idProveedor=  $_GET['idProveedor'];
				$_SESSION['UrlDestino']="../proveedores/listado_prov.php";
			}
	   	
		
		$enllac = mysql_connect($servidor,$usuari,$contrasenya);
		mysql_select_db($baseDatos,$enllac);
		$strSQL = "delete from PROVEEDOR where ID_PROVEEDOR = ". $idProveedor;
		$resultat = mysql_query($strSQL, $enllac);
		if (!$resultat)  die('Error: ' . mysql_error());
    	mysql_close($enllac);
		header('Location:' . $_SESSION['UrlDestino']);
		exit();
}

?> 
