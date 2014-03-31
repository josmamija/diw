
<?php
if (isset($_POST['Submit'])) {
	session_start();
	include ("../Conexiones/conexion_local.php"); 
	$miUsuario; $miPassword;
	//Guardamos los datos del Form en variables y evitamos la comilla simple
 	$miUsuario = trim($_POST["usuario"]);
	$miPassword = trim($_POST["pwd"]);
	//Unas pequeñas medidas de seguridad para proteger las bases de datos de posibles inyecciones
	//$miUsuario = stripslashes( $miUsuario);
 	//$miUsuario = stripslashes($miUsuario);
 	//$miUsuario = mysql_real_escape_string($miUsuario);
 	//$miUsuario = mysql_real_escape_string($miUsuario);
    //Conectamos con el servidor y seleccionamos la base de datos
 	$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
	mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
 	//$sql="SELECT * FROM PROVEEDOR WHERE USUARIO='$miUsuario' and PWD='$miPassword'";
 	$sql = "SELECT * FROM ADMINISTRADOR WHERE USUARIO='" .$miUsuario ."'" . "and PWD='" . $miPassword . "'" ;
	$result=mysql_query($sql);
	$fila=mysql_fetch_array($result);
	// Contamos el numero de filas
	 $count=mysql_num_rows($result);
	 if($count==1){
 		//Registramos usuario y redireccionamos a exito.php
		//Crear una variable para guardar el ID del usuario para tenerlo siempre disponible
	  if(!isset($_SESSION['autenticado'])); $_SESSION['autenticado'] = 'SI';
	  if(!isset($_SESSION['usuario'])); $_SESSION['usuario']=$_POST['usuario'];
		session_write_close();	
	  /*
	  echo "<script language='javascript'>window.location='../administracion/menu_a.php?usuario=".$miUsuario."'</script>;"; 
	*/
	  echo "<script language='javascript'>window.location='../administracion/menu_a.php'</script>;"; 
        
	  //echo "hola"; exit();
	  //header("location:../administracion/menu_a.php");
 	 }
	 else {
 		echo "<br>Usuario o clave equivocado <br>";
		?>
         <a href="../administracion/login_admin.php">Volver</a>
        <?php 
 		//header("location:../productos/LoginConec2.php");
 	}
}
?>