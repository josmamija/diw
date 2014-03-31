<?php
if (isset($_POST['accion'])) { 
	include ("../Conexiones/conexion_local.php");
	include ("../Funciones/funciones.php");
	//include ("../Correo/correo.php");
	include("../PHPMailer-master/enviarCorreo.php");
	$sDestino= "gestion@gesdesc.com";
	
	//response.write sDestino
	$EsValido = verificarEmail($sDestino);
	if (!$EsValido) {
  		//echo "Aqui"
  		exit();

	}else{
		//echo $_POST['poblacion'];
		//echo $_POST['provincia'];
        //echo $_POST['Email'];
		//exit();
		
  		$strSQL;
 		$enllac = mysql_connect($servidor,$usuari,$contrasenya);
 		mysql_select_db($baseDatos,$enllac);
		// Obtener un password de 8 caracteres 
  		
		if ($_GET['modo'] == "ALTA") {
			$fecha_actual = date("Y-m-d H:i:s");
 			$_SESSION['UrlDestino']="alta.php"; 
			$sPassword = generarPassword(8);  
    		$strSQL = "insert into CLIENTE ";
			$strSQL .= "(NOMBRE,APELLIDO1,APELLIDO2,DNI,TELEFONO,MOVIL,EMAIL,USUARIO,PWD,DIRECCION,LOCALIDAD,PROVINCIA,PAIS,FECHA_ALTA)";
			$strSQL = $strSQL . " values (" ;
			$strSQL = $strSQL . "'" . $_POST["nombre"] . "','" . $_POST["apellido1"] . "','" . $_POST["apellido2"];	
			$strSQL = $strSQL . "','" . $_POST["dni"];
			$strSQL = $strSQL . "','" . $_POST["tfno"] . "','" . $_POST['movil'] ;
			$strSQL = $strSQL . "','" . $_POST["Email"] . "','" . $_POST["usuario"] ;
			$strSQL = $strSQL . "','" . $sPassword . "','" . $_POST["direccion"];
			$strSQL = $strSQL . "','" . $_POST["poblacion"] . "','" . $_POST["provincia"];
			$strSQL = $strSQL . "','" . $_POST["pais"];
			$strSQL .="','".$fecha_actual."')";
    		
			$resultat = mysql_query($strSQL, $enllac);
			if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
			/*
			$TextBody = "Ha sido dado de alta en nuestro Portal: http://www.gesdesc.com";
			$TextBody .= "<br>Usuario: <font color='red'>" .  $_POST["usuario"]. "</font><br>";
			$TextBody .= "Clave: <font color='red'>" . $sPassword . "</font> <br>";
			$TextBody .= "Email : ".$_POST['Email']."<br>";
			$TextBody .= "DNI : ".$_POST['dni']."<br>";
			*/
			$TextBody = "Ha sido dado de alta en nuestro Portal: http://www.gesdesc.com";
			$TextBody .= "\r\nUsuario: ".  $_POST["usuario"]. "\r\n";
			$TextBody .= "Clave: ". $sPassword . "\r\n";
			$TextBody .= "Email : ".$_POST['Email']."\r\n";
			$TextBody .= "DNI : ".$_POST['dni']."\r\n";
			
			$TextBody .= " Pendiente de activar ";
			$remitente ="gestion@gesdes.com";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Additional headers
			$headers .= 'From: GESDESC <gestion@gesdesc.com>' . "\r\n";
			$asunto ="Registro profesional ".$_POST['dni']; 
			mail ($sDestino, $asunto, $TextBody, $headers);  
			//EnviarCorreo($sDestino,$TextBody,$remitente,$asunto);
			echo "<br>Ha sido dado de ALTA en nuestra WEB<br>"; 
			echo "En breve recibirá un correo electrónico con su password<br>"; 
			echo "Gracias<br>" ;
			echo "<a href='menu_g_c3.php?page=inicio'>Inicio</a>";
			exit();
			
		}
		elseif ($_GET['modo'] == "MODIFICAR") { 
    		$_SESSION['UrlDestino']="modificar.php";
    		$strSQL = "update CLIENTE set Nombre =" . "'" . $_POST["nombre"] . "',";  
			$strSQL = $strSQL . "Apellido1 = " . "'" . $_POST["apellido1"] . "',";
			$strSQL = $strSQL . "Apellido2 = " . "'" . $_POST["apellido2"] . "',";
			$strSQL = $strSQL . "DNI = " . "'" . $_POST["dni"] . "',";
			$strSQL = $strSQL . "TELEFONO = " . "'" . $_POST["tfno"] . "',";
			$strSQL = $strSQL . "movil = " . "'" . $_POST["movil"] . "',"; 
			$strSQL = $strSQL . "Email = " . "'" . $_POST["Email"] . "',";
			$strSQL = $strSQL . "Usuario = " . "'" . $_POST["usuario"] . "',";
			$strSQL = $strSQL . "PWD = " . "'" . $_POST["password"] . "',";
			$strSQL = $strSQL . "Direccion = " . "'" . $_POST["direccion"] . "',";
			$strSQL = $strSQL . "Localidad = " . "'" . $_POST["poblacion"] . "',";
			$strSQL = $strSQL . "Provincia = " . "'" . $_POST["provincia"] . "',";
			$strSQL = $strSQL . "Pais = " . "'" . $_POST["pais"] . "'";
			$strSQL = $strSQL . " where ID_CLIENTE = " .  $_POST["id"]; 
			$resultat = mysql_query($strSQL, $enllac);
			if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
			//header('Location:' . $_SESSION['UrlDestino']);
			echo "<br>Su perfil ha sido modificado en nuestra WEB<br>";
			//echo "<a href='javascript:history.back()'>Volver</a>"; 
			echo "<a href='menu_g_c3.php?page=inicio'>Inicio</a>";
			exit();
		}
	}
 }
 elseif (isset($_POST['borrar'])) {
			include ("../Conexiones/conexion_local.php");
	      	$_SESSION['UrlDestino']="modificar.php";
			$enllac = mysql_connect($servidor,$usuari,$contrasenya);
			mysql_select_db($baseDatos,$enllac);
			$strSQL = "delete from CLIENTE where ID_CLIENTE = ". $_POST["id"];
			$resultat = mysql_query($strSQL, $enllac);
			if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
			header('Location:' . $_SESSION['UrlDestino']);
}

?> 
