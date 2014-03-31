<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/nhpup_1.1.js"></script>
-->

<script>
function abrir(URL){

 var gatFinestra = window.open(URL,"FinestraGat","resizable=yes,width=500,height=500, top=120,left=100"); 
} 
</script>



<?php
include ("../Conexiones/conexion_local.php"); 
$miNIF = $_GET["unif"];
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
// COMPROBAR QUE EL SOCIO NO TENGA MAS DE 3 PRESTECS 
$consulta = "select * from PRODUCTO WHERE NIF = '" . $miNIF ."'";
$resultat = mysql_query($consulta, $enllac);
//echo "NIF : " . $miNIF;
echo "<p  class='letranegrita' style='width:200'>LISTADO DE PRODUCTOS</p>";
if (!$resultat) die('Error: ' . mysql_error());
else {
	$sCadena= "<TABLE BORDER=1 class='rounded'>";
 	$sCadena=$sCadena . "<tr class='cab_inv'><TD>&nbsp;Cod. Fábrica&nbsp;</TD>";
	$sCadena=$sCadena . "<TD>&nbsp;Cod. almacén&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Categoria&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Subcategoria&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Marca&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Descripción&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>PVP&nbsp;&#8364;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>Descuento<br>(1 ud.) %</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>Máximo<BR>desc (Uds.)</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>Descuento<br>máximo %</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>Pneto<br>máximo &#8364;</TD>";
	$sCadena.="<TD class='Estilo1'>Anexo</TD></tr>";
	echo $sCadena;
    while($fila=mysql_fetch_array($resultat)){
		$mas=$fila["DESCRIPCION"];
		$desmaximo=round(100-($fila['P_NETO_M']*100)/$fila['PVP'],2);
   		//$sCadena= "<tr><td class='Estilo1'>&nbsp;" . $fila["COD_PRODUCTO"] . "</td>";
		$sCadena="<tr><td>";
		$sCadena.="<a href ='../proveedores/menu_prov.php?go=2&unif=".$miNIF."&cod_producto=".$fila["ID_FABRICA"]."'>".$fila["ID_FABRICA"]."</a></td>";
  		//$sCadena= "<tr><td class='Estilo1'>&nbsp;" . $fila["ID_FABRICA"] . "&nbsp;</td>";
   		//$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["CATEGORIA_ID"] . "&nbsp;</td>";
   		$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["COD_ALMACEN"] . "&nbsp;</td>";
   		$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["MARCA"] . "&nbsp;</td>";
   		//$sCadena.= "<td title =$mas>&nbsp;" . $fila["DESCRIPCION"] . "&nbsp;</td>";
		echo $sCadena;
		//$sCadena.= "<td><a onmouseover='nhpup.popup("."'Lorem ipsum dolor sit ...'". ");"." href='#'>". $fila["DESCRIPCION"] . "</a></td>";
   		?>
        <td>
        <a onmouseover="nhpup.popup(' <?=utf8_encode($mas)?>');" href='#'><?=utf8_encode(substr($mas,0,30))?></a>
        
		</td>
		<?php
		
		$sCadena= "<td class='Estilo1'>&nbsp;" . $fila["PVP"] . "&nbsp;</td>";
		$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["DESCUENTO"] . "&nbsp;</td>";
   		$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["MAX_U_DES"] . "&nbsp;</td>";
   		$sCadena.= "<td class='Estilo1'>&nbsp;" . $desmaximo . "&nbsp;</td>";
		$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["P_NETO_M"] . "&nbsp;</td>";
		if( $fila["ADJUNTO"]==0){
			$sCadena.= "<td>&nbsp;</td></tr>";
		}
		else {
			
			$anexo = "../uploads/archivos_subidos/";
			$anexo.=$miNIF."_".$fila["ID_FABRICA"].".pdf";
			$sCadena.= "<td><a href='#' onclick='abrir(\"$anexo\")' ><img src='../images/anexo.png' width='15' height='15' alt='' longdesc='Anexo' /> </a></td></tr>";	
		}
   		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["EXISTENCIAS"] . "&nbsp;</td>";
   		echo $sCadena;
 	}
	echo "</table>";
	mysql_close($enllac);
}
?>
<!--
<br><a href='javascript:history.back()'>Volver</a>
-->
