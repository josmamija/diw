<?php
session_start();
//echo $_SESSION['usuario'];
//echo $_SESSION['autenticado'];

if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {
	
	if (isset($_POST['Submit']) || isset($_GET['nif'])) { 
	
		include ("../Conexiones/conexion_local.php");
		include ("../Funciones/funciones.php");
		//include ("../Correo/correo.php");
		include("../PHPMailer-master/enviarCorreo.php");
		
		$strSQL;
 		$enllac = mysql_connect($servidor,$usuari,$contrasenya);
 		mysql_select_db($baseDatos,$enllac);
		$_SESSION['UrlDestino']="menu_a.php";
		$sql ="SELECT * FROM PROVEEDOR WHERE NIF = '". $_GET['nif']."'";
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);
		$fila=mysql_fetch_array($result); 
		if($count==1) {
			//echo "hola";
			//exit();
			$email = $fila['EMAIL'];
			if($_GET['accion']=="Activar") $activo =1;
			else $activo=0;   
    		$strSQL = "update PROVEEDOR set ACTIVO = " .$activo . " where NIF = '". $_GET['nif']."'";
			$resultat = mysql_query($strSQL, $enllac);
			if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
			$sDestino= $fila['EMAIL'];
			$sPassword =$fila['PWD'];
			//$sPassword = generarPassword(8);
			$TextBody = "<img src='../images/logoGesdesc.GIF' width='134' height='41' /><br />";
    		$TextBody .= "Ha sido dado de alta y activado en nuestro Servicio: http://www.gesdesc.com<br>";
			$TextBody .= "Usuario: <font color='red'>" .  $fila["USUARIO"]. "</font><br>";
			$TextBody .= "Clave: <font color='red'>" . $fila['PWD']. "</font> <br>";
			$TextBody .= "Email : ".$fila['EMAIL']."<br>";
			$TextBody .= "NIF : ".$_GET['nif']."<br><br>";
			$TextBody .= "Si esta interesado, nos puede indicar el nombre de la categoría<br>";
			$TextBody .= "y de subcategoría que desee que implementemos para sus productos.<br>";
			
			$remitente ="gestion@gesdesc.com";
			$asunto ="Registro proveedor ".$_GET['nif']; 
			//echo $TextBody;
			//exit(); 
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: GESDESC <gestion@gesdesc.com>' . "\r\n";
			if($activo==1) {
				mail ($sDestino, $asunto, $TextBody, $headers);
				//EnviarCorreo($sDestino,$TextBody,$remitente,$asunto);
				echo "<br>Ha sido activado<br>"; 
			}else echo "<br>Ha sido desactivado<br>"; 
			
			echo "<a href=../administracion/menu_a.php?page=inicio'>Inicio</a>";
			exit();
			
		}else {
			echo "El proveedor con NIF : " .$_GET['nif'] ." NO está registrado ";
			echo "<a href='../includes/menu_a.php?page=inicio'>Inicio</a>";
			exit();
		}
	}
	?>
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<B>NIF proveedor:</B><INPUT type = "text" NAME="nif" SIZE="10">
   		<INPUT TYPE="Submit" name = "Submit" VALUE="Activar">
        <INPUT TYPE="hidden" name="accion" VALUE="Activar">
	</FORM> 
	<?php
	echo "<a href='../administracion/menu_a.php'>Inicio</a>";
}else{
	
//En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la 
    //pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<a href=../administracion/login_admin.php>Login</a>";
	
}
?> 
