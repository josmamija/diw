 <?php
 //extract($_REQUEST);
//$idFabrica="F3AA40445"; 
if(isset($_POST['idFabrica']) ){
include ("../Conexiones/conexion_local.php");
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
$idFabrica = $_POST['idFabrica'];
$strSQL = " select DESCRIPCION from PRODUCTO where ID_FABRICA = '$idFabrica'";
$resultat2 = mysql_query($strSQL, $enllac);
$fila=mysql_fetch_array($resultat2);
$desc=$fila['DESCRIPCION'];
/*
$i;
$cadena="";
for ($i=0;$i< strlen($desc);++$i) {
	if($i%40==0) $cadena.= substr($desc,$i,40)."<br>";
}
$cadena.= substr($desc,$i,40);
echo $cadena;
*/
echo $desc;
mysql_close($enllac);
}
?> 
