 <?php
extract ($_REQUEST);//Esto extrae todas las variables del formulario
// Obtener el valor del login que se quiere comprobar
 /*
$xml="<?xml version='1.0' encoding='utf-8'?>";
$xml.="<facturas>";
$xml.="<factura>";
$xml.="<dni>123456789</dni>";
$xml.="<nif>22222222A</nif>";
$xml.="<items>";
$xml.="<item>";
$xml.="<idfabrica>1</idfabrica>";
$xml.="<cantidad>1</cantidad>";
$xml.="<pvp>1500</pvp>";
$xml.="<pneto>1125</pneto>";
$xml.="</item>";
$xml.="<item>";
$xml.="<idfabrica>1112C</idfabrica>";
$xml.="<cantidad>1</cantidad>";
$xml.="<pvp>1500</pvp>";
$xml.="<pneto>11utf25</pneto>";
$xml.="</item>";
$xml.="</items>";
$xml.="</factura>";
$xml.="</facturas>";
*/
$xml1 = simplexml_load_string($xml) or die("Error: Can not create object");
 $idFabrica = $xml1->idfabrica;
 $nif = $xml1->nif;
//$idFabrica = 1;
//$nif = "22222222A";


include ("../Conexiones/conexion_local.php"); 
$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
mysql_query("SET NAMES UTF8",$enlace);
mysql_set_charset('utf8');	 
$sql="SELECT ID_FABRICA,MARCA, DESCRIPCION, PVP, P_NETO_1, ADJUNTO, PROVEEDOR.NOMBRE,PROVEEDOR.LINK AS LINK_P,PRODUCTO.LINK FROM PRODUCTO, PROVEEDOR ";
$sql.= "WHERE PROVEEDOR.NIF ='$nif' and ID_FABRICA='$idFabrica' AND PRODUCTO.NIF = PROVEEDOR.NIF";
$resultat = mysql_query($sql,$enlace);



if (!$resultat) die('Error: ' . mysql_error());
		
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
while($fila=mysql_fetch_assoc($resultat)){
	$marca=$fila["MARCA"];
   $ma=str_replace("&","-",$marca);
$resp =$fila["NOMBRE"];
	if ($fila["LINK"]=="") $enlace="#";
	else $enlace = utf8_decode($fila["LINK"]);
	if ($fila["LINK_P"]=="") $enlacep="#";
	else $enlacep = utf8_decode($fila["LINK_P"]);
 	echo "<compra> \n".
       "\t <proveedor>".$resp."</proveedor> \n".
	   " \t\t <idfabrica>". utf8_decode($fila["ID_FABRICA"]) ."</idfabrica> \n".
	    " \t\t <marca>". utf8_decode($ma) ."</marca> \n".
			 " \t\t <descripcion>". utf8_decode($fila["DESCRIPCION"]) ."</descripcion> \n".
			 " \t\t <pvp>". $fila["PVP"] ."</pvp> \n".
			 " \t\t <pneto>". $fila["P_NETO_1"] ."</pneto> \n".
			  " \t\t <link>". $enlace ."</link> \n".
			  " \t\t <link_p>". $enlacep ."</link_p> \n".
			   " \t\t <adjunto>". $fila["ADJUNTO"] ."</adjunto> \n".
       "</compra>";  
}
/*
header('Content-Type: text/xml; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
echo '<?xml version="1.0"?><compra>hola</compra>';
*/
?>