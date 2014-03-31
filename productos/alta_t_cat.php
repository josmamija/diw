<?php
session_start();
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['nif'])) )
{
   //En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
	header("Localtion:../proveedores/menu_g_p2.php");
}
 include("categoria.php");
 ?>



