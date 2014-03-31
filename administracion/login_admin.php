<?php
if (isset($_POST['Submit'])) {
	include ("../Conexiones/conexion_local.php"); 
	$miUsuario = trim($_POST["usuario"]);
	$miPassword = trim($_POST["pwd"]);
	// Unas pequeñas medidas de seguridad para proteger las bases de datos de posibles inyecciones
	// $miUsuario = stripslashes( $miUsuario);
 	//$miUsuario = stripslashes($miUsuario);
 	//$miUsuario = mysql_real_escape_string($miUsuario);
 	//$miUsuario = mysql_real_escape_string($miUsuario);
    //Conectamos con el servidor y seleccionamos la base de datos
	session_start();
	$_SESSION['autenticado'] = 'SI';
	$_SESSION['usuario']=$_POST['usuario'];
	session_write_close();	
	$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
	mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
 	$sql = "SELECT * FROM ADMINISTRADOR WHERE USUARIO='" .$miUsuario ."'" . "and PWD='" . $miPassword . "'" ;
	$result=mysql_query($sql);
	$fila=mysql_fetch_array($result);
	$count=mysql_num_rows($result);
	if($count==1){
	  header('Location: menu_a.php');	
 	  /*
	  echo "<script language='javascript'>window.location='../administracion/menu_a.php?usuario=".$miUsuario."'</script>;"; 
      */
	 }
	 else {
 		echo "<br>Usuario o clave equivocado <br>";
		?>
         <a href="../administracion/login_admin.php">Volver</a>
        <?php 
 		//header("location:../productos/LoginConec2.php");
 	}
}else {
?>
<html>
<head>
<title>Login administrador</title>
</head>
<body bgcolor="white">
<font face="arial" size="+1">
<h2>Login administrador</h2>
 <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<BR><B>Usuario:</B><INPUT type = "text" NAME="usuario" SIZE="30">
    <BR><B>Password:</B><INPUT type="password" NAME="pwd" SIZE="15" ><BR><BR>
	<INPUT TYPE="Submit" name = "Submit" VALUE="Enviar">
 </FORM>
  
</font>
</body>
</html>
<?php } ?>