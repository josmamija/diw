<?php
if (isset($_POST['Submit'])) {
	include ("../Conexiones/conexion_local.php"); 
	$miUsuario; $miPassword;
	//Guardamos los datos del Form en variables y evitamos la comilla simple
 	$miUsuario = trim($_POST["usuario"]);
	$miPassword = trim($_POST["pwd"]);
	// Unas pequeñas medidas de seguridad para proteger las bases de datos de posibles inyecciones
	//$miUsuario = stripslashes( $miUsuario);
 	//$miUsuario = mysql_real_escape_string($miUsuario);
 	//Conectamos con el servidor y seleccionamos la base de datos
 	$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
	mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
 	$sql = "SELECT * FROM CLIENTE WHERE USUARIO='" .$miUsuario ."'" . "and PWD='" . $miPassword . "'" ;
	$result=mysql_query($sql);
	$fila=mysql_fetch_array($result);
	$dni = $fila['DNI'];
	$idCliente = $fila['ID_CLIENTE'];
	$nombre=$fila['NOMBRE'];
	$apellido=$fila['APELLIDO1'];
	//Contamos el numero de filas
	$count=mysql_num_rows($result);
	if(($count==1) && ($fila['ACTIVO'] == 1)){
		$_SESSION["usuario"] = $miUsuario;
		//Iniciar una sesion de PHP
      	//Crear una variable para indicar que se ha autenticado
      	$_SESSION['autenticado']    = 'SI';
      	//Crear una variable para guardar el ID del usuario para tenerlo siempre disponible
       	//echo "hola2 :" .$miUsuario." ". $miPassword . " ". $nombre . " ". $dni. " ".$idCliente;
	 	echo "<script language='javascript'>window.location='../clientes/menu_c.php?dni=$dni&idCliente=$idCliente&nombre=$nombre&apellido=$apellido'</script>;"; 
	 	//header("Location: menu_c.php?dni=".$dni. "&idCliente=".$idCliente."&nombre=$nombre&apellido=$apellido");
 	 }else {
 		echo "Usuario o clave equivocado <br>o pendiente de activar<br>";
		?>
        <a href="../clientes/menu_g_c.php?ver=1">Volver</a>
        <?php 
 		//header("location:../productos/LoginConec2.php");
 	}
}else {
?>
<div class="container">	
<section class="main">
<form class="form-2" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div id="resposta"></div>
	<label for="usuario" class="letranegrita"><i class="icon-user"></i>Username</label>
	<input type = "text" NAME = "usuario" placeholder = "Username" id = "usuario" >
	<br><label for="password" class="letranegrita"><i class="icon-lock"></i>Password</label>
	<input id="pwd" type="password" name="pwd" placeholder="Password" class="showpassword">
	<br><input type="reset" onClick="ocultar()" value="Cancelar">
    <INPUT TYPE="Submit" name = "Submit" VALUE="Enviar">
</form>
</section>
</div>
<!--
<h2>Identificacion profesional </h2>
 <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<BR><B>Usuario:</B><INPUT type = "text" NAME="usuario" SIZE="10">
    <BR><B>Password:</B><INPUT type="password" NAME="pwd" SIZE="8" ><BR><BR>
	<INPUT TYPE="Submit" name = "Submit" VALUE="Enviar">
	</FORM> 
 -->   
<?php } ?>