 <?php
 

 //extract($_REQUEST);
if(isset($_POST['nif']) && isset($_POST['idFabrica']) ){
include ("../Conexiones/conexion_local.php");
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
mysql_query("SET NAMES UTF8",$enllac);
$nif =$_POST['nif'];
$idFabrica = $_POST['idFabrica'];
$strSQL = " select DISTINCT ID_FABRICA, DESCRIPCION from PRODUCTO where NIF = '$nif' and ID_FABRICA = '$idFabrica'";

$resultat2 = mysql_query($strSQL, $enllac); //precio y descuento por producto y provvedor
$count=mysql_num_rows($resultat2);
 if($count==1)echo "1";
 else {
	 $strSQL = " select DISTINCT ID_FABRICA, DESCRIPCION, MARCA from PRODUCTO where ID_FABRICA = '$idFabrica'";
	 $resultat2 = mysql_query($strSQL, $enllac); //precio y descuento por producto y provvedor
	 $count=mysql_num_rows($resultat2);
 	 if($count>0) {
		$fila=mysql_fetch_array($resultat2); 
	    echo trim($fila['MARCA'])."&";
		echo trim($fila['DESCRIPCION']);
     }
     else echo "" ;
 }
mysql_close($enllac);

}
?> 
