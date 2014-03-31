 <?php
 

 //extract($_REQUEST);
if(isset($_POST['nif']) && isset($_POST['idFabrica']) ){
include ("../Conexiones/conexion_local.php");
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
$nif =$_POST['nif'];
$idFabrica = $_POST['idFabrica'];
$strSQL = " select ID_FABRICA from PRODUCTO where NIF = '$nif' and ID_FABRICA = '$idFabrica'";
$resultat2 = mysql_query($strSQL, $enllac); //precio y descuento por producto y provvedor
$count=mysql_num_rows($resultat2);
 if($count==1)echo "Cód. existente";
 else echo "" ;
mysql_close($enllac);

}

?> 
