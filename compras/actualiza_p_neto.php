 <?php
 

 //extract($_REQUEST);
if(isset($_POST['nif']) && isset($_POST['idFabrica']) ){
 function calcular_des($pvp,$p_neto_1,$p_neto_m, $max_u_des,$unidades) {
   // descuento adicional por cada unidad vendida
   $desc_adic= (($p_neto_1 - $p_neto_m)/$pvp)*100 / ($max_u_des -1); 
   if($unidades > $max_u_des) $unidades = $max_u_des; // limitamos el descuento al maximo de unidades
   // %descuento a aplicar
   $descuento= (($pvp-$p_neto_1)*100)/$pvp + $desc_adic * ($unidades-1);
   //echo "<br>" .(100-$descuento);
   // precio neto final aplicado el descuento por unidad
   $p_net = ((100-$descuento) * $pvp)/100;
   //echo "<br>" .$p_net;
   //exit();
    return(round($p_net*100)/100);
 }

include ("../Conexiones/conexion_local.php");
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);

$nif =$_POST['nif'];
$idFabrica = $_POST['idFabrica'];
$cantidad = $_POST['cantidad'];
/*
$nif ="22222222A";
$idFabrica = "2222AB";
$cantidad = 2;
*/
//$codCompra = $fila["COD_COMPRA"];
$strSQL = " select PVP,P_NETO_1,P_NETO_M,MAX_U_DES from PRODUCTO where NIF = '$nif' and ID_FABRICA = '$idFabrica'";
$resultat2 = mysql_query($strSQL, $enllac); //precio y descuento por producto y provvedor
$fila2=mysql_fetch_array($resultat2);
$p_neto=calcular_des($fila2["PVP"],$fila2["P_NETO_1"],$fila2["P_NETO_M"],$fila2["MAX_U_DES"],$cantidad);
echo $p_neto ;

mysql_close($enllac);

}

?> 
