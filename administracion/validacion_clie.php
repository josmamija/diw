<?php
session_start();
//echo $_SESSION['usuario'];
//echo $_SESSION['autenticado'];
//exit();
if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {

	
	if (isset($_POST['Submit']) || isset($_GET['dni'])) { 
	
		include ("../Conexiones/conexion_local.php");
		include ("../Funciones/funciones.php");
		//include ("../Correo/correo.php");
		//include("../PHPMailer-master/enviarCorreo.php");
		
		$strSQL;
 		$enllac = mysql_connect($servidor,$usuari,$contrasenya);
 		mysql_select_db($baseDatos,$enllac);
		$_SESSION['UrlDestino']="menu_a.php";
		$sql ="SELECT * FROM CLIENTE WHERE DNI = '". $_GET['dni']."'";
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);
		$fila=mysql_fetch_array($result); 
		if($count==1) {
			//echo "hola";s
			//exit();
			$email = $fila['EMAIL'];
			if($_GET['accion']=="Activar") $activo =1;
			else $activo=0;   
    		$strSQL = "update CLIENTE set ACTIVO = " .$activo . " where DNI = '". $_GET['dni']."'";
			$resultat = mysql_query($strSQL, $enllac);
			if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
			$sDestino= $fila['EMAIL'];
			$sPassword =$fila['PWD'];
			//$sPassword = generarPassword(8);
			$remitente ="gestion@gesdes.com";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          
			$TextBody = "<img src='http:/www.gesdesc.com/images/logoGesdesc.GIF' width='134' height='41' /><br />";
    		
			$TextBody .= "Ha sido dado de alta y activado en nuestro Portal: http://www.gesdesc.com<br>";
			$TextBody .= "Usuario: <font color='red'>" .  $fila["USUARIO"]. "</font><br>";
			$TextBody .= "Clave: <font color='red'>" . $fila['PWD']. "</font> <br>";
			$TextBody .= "Email : ".$fila['EMAIL']."<br>";
			$TextBody .= "DNI : ".$_GET['dni']."<br>";
			/*
			
			$TextBody .= "Ha sido dado de alta y activado en nuestro Portal: http://www.gesdesc.com\r\n";
			$TextBody .= "Usuario: <font color='red'>" .  $fila["USUARIO"]. "</font>\r\n";
			$TextBody .= "Clave: <font color='red'>" . $fila['PWD']. "</font> \r\n";
			$TextBody .= "Email : ".$fila['EMAIL']."\r\n";
			$TextBody .= "DNI : ".$_GET['dni']."\r\n";
			*/
			$asunto ="Registro profesional ".$_GET['dni']; 
			// Additional headers
			$headers .= 'From: GESDESC <gestion@gesdesc.com>' . "\r\n";
			//echo $TextBody;
			//exit(); 
			if($activo==1) {
				mail ($sDestino, $asunto, $TextBody, $headers);  
				//EnviarCorreo($sDestino,$TextBody,$remitente,$asunto);
				echo "<br>Ha sido activado<br>"; 
			}else echo "<br>Ha sido desactivado<br>"; 
			
			echo "<a href=../administracion/menu_a.php?usuario=$usuario>Inicio</a>";
			exit();
			
		}else {
			echo "El profesional con DNI : " .$_GET['dni'] ." NO está registrado ";
			echo "<a href='../administracion/menu_a.php?usuario=$usuario'>Inicio</a>";
			exit();
		}
	}
	?>
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<B>DNI profesional:</B><INPUT type = "text" NAME="dni" SIZE="10">
   		<INPUT TYPE="Submit" name = "Submit" VALUE="Activar">
        <INPUT TYPE="hidden" name="accion" VALUE="Activar">
        <INPUT TYPE="hidden" name="usuario" VALUE="<?=$_GET['usuario']?>">
	</FORM> 
	<?php
	echo "<a href='../administracion/menu_a.php?page=inicio'>Inicio</a>";
}else{
	
//En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la 
    //pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<br><a href=../administracion/login_admin.php>Login</a>";
	
}
?> 
