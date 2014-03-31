<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
if (isset($_POST['Submit'])) {
	include ("../Conexiones/conexion_local.php"); 
	$miUsuario; $miPassword;
	//Guardamos los datos del Form en variables y evitamos la comilla simple
 	$miUsuario = trim($_POST["usuarioa"]);
	$miPassword = trim($_POST["pwd"]);
	
	 // Unas pequeñas medidas de seguridad para proteger las bases de datos de posibles inyecciones
	//$miUsuario = stripslashes( $miUsuario);
 	//$miUsuario = mysql_real_escape_string($miUsuario);
 
    //Conectamos con el servidor y seleccionamos la base de datos
 	$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
	mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
 	
	//echo "hola2 :" .$miUsuario." ". $miPassword;
	//exit();
 	$sql = "SELECT * FROM PROVEEDOR WHERE USUARIO='" .$miUsuario ."'" . "and PWD='" . $miPassword . "'" ;
	$result=mysql_query($sql);
	$fila=mysql_fetch_array($result);
	$nif = $fila['NIF'];
	$idProveedor = $fila['ID_PROVEEDOR'];
	mysql_close($enlace);
	// Contamos el numero de filas
	$count=mysql_num_rows($result);
	$nombre=$fila['NOMBRE'];
	// Contamos el numero de filas
	 $count=mysql_num_rows($result);
	 if(($count==1) && ($fila['ACTIVO'] == 1)){
		echo "<script language='javascript'>window.location='../proveedores/menu_prov.php?unif=$nif&idProveedor=$idProveedor&nombre=$nombre'</script>;"; 
	 }else {
 		echo "Usuario o clave equivocado <br>o pendiente de activar<br>";
		?>
         <a href="../proveedores/menu_g_p3.php">Volver</a>
        <?php 
 		//header("location:../productos/LoginConec2.php");
 	}
}else {
?>

<div class="container">	
	<section class="main">
		<form class="form-2" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div id="resposta"></div>
		
		  <label for="usuarioa" class="letranegrita"><i class="icon-user"></i>Username</label>
			<input type = "text" NAME = "usuarioa" placeholder = "Username" id = "usuarioa" >
				<br><label for="pwd" class="letranegrita"><i class="icon-lock"></i>Password</label>
				<input id="pwd" type="password" name="pwd" placeholder="Password" class="showpassword">
						
			<br><input type="reset" onClick="ocultar()" value="Cancelar">
            <INPUT TYPE="Submit" name = "Submit" VALUE="Enviar">
		</form>
        <br />
        <meta charset="utf-8">
        <a href="../proveedores/menu_g_p4.php?go=3&desde=proveedor">¿NO PUEDE ACCEDER A SU CUENTA?</a>
        </section>
</div>



<?php } ?>