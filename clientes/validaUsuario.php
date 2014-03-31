 <?php
 

 //extract($_REQUEST);
 
if(isset($_POST['usuario']) ){
include ("../Conexiones/conexion_local.php");
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
$usu =trim($_POST['usuario']);
$strSQL = " select * from CLIENTE where trim(USUARIO) = '$usu'";
$resultat2 = mysql_query($strSQL, $enllac); //precio y descuento por producto y provvedor
$count=mysql_num_rows($resultat2);
 if($count>0)echo "* Usuario ya existe!!!";
 else echo "" ;
mysql_close($enllac);

}

?> 
