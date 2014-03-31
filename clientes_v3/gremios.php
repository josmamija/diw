<?php
session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {
	include ("../Conexiones/conexion_local.php"); 
	$enllac = mysql_connect($servidor,$usuari,$contrasenya);
	mysql_select_db($baseDatos,$enllac);
	$consulta = "select * from GREMIO order by NOMBRE";
	$resultat = mysql_query($consulta, $enllac);
	if (!$resultat) die('Error: ' . mysql_error());
	else {
?>
<?php
		//echo "<span class='cabecera'> GREMIOS</span>";
		echo "<table><tr><th>GREMIOS</th></tr>";
		while($fila=mysql_fetch_array($resultat)){
			$sCadena= "<tr><td><a href= '". $fila["LINK_GREMIO"]. "' target='new' >" . $fila["NOMBRE"] . "</a></td></TR>";
   			echo $sCadena;
 		}			
		echo "</table>";
	}
}else{ // autorizacion
	//En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la 
	//pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<a href=../clientes/menu_g_c3.php> Login</a>";
}
?>

