<?php
	session_start();
	//echo $_SESSION['autenticado'];
	//echo $_SESSION['usuario'];
	//echo $_GET['dni'];
	//exit();
if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {	
if ( !isset($_GET['dni']) )
{
	
   //En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
  
     echo "<script language='javascript'>window.location='../clientes/menu_g_c2.php'</script>;"; 
    //header("Localtion:../clientes/accesoCliente.php");
	exit();
}
 	//echo $_GET['dni'];
	//exit();
	if(isset($_GET['dni'])){
	// Necesario cada vez que se lean
 	// o guarden variables de sesi�n.
	 $_SESSION['UrlDestino']="alta_c_cat2.php";
	 $dni = $_GET['dni'];
	 $idCliente=$_GET['idCliente'];
	 //$servicio =$_GET['servicio'];
	 //$idProveedor = $_GET['idProveedor'];
	 include("categoria_c2.php");
	}
}
 ?>



