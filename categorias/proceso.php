<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<div id="menu2" class="letratext">
     &nbsp;&nbsp;<a href="../index.html">INICIO</a>
     <!--
    <br /><a href="../productos/alta_t_cat.php?unif=<?=$unif?>&id_proveedor=<?=$id_proveedor?>">ALTA PRODUCTO</a>
    -->
    <br />&nbsp;&nbsp;<a href="../productos/alta_t_cat.php">ALTA PRODUCTO</a>
    <!--
    <br />&nbsp;&nbsp;<a href="../productos/SelecModi_t.php?go=1&unif=<?=$unif?>" >EDITAR PRODUCTO</a>
    -->
    <br />&nbsp;&nbsp;<a href="proceso.php?go=1" >EDITAR PRODUCTO</a>
    
    <br />&nbsp;&nbsp;<a href="../productos/listado_t.php?unif=<?=$unif?>">LISTAR PRODUCTOS</a>
    <br />&nbsp;&nbsp;<a href="../compras/gestion_compra_p.php?unif=<?=$unif?>">CONFIRMAR PEDIDOS</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/modificar_p2.php?unif=<?=$unif?>">EDITAR PERFIL PROVEEDOR</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_g_p.php">VOLVER</a>
</div>
</td>
</tr>
</table>
<div id="apDiv1" class="letratext"><?=$nombre?></div>
<div id = "detalle" class="letratext">

<?php

if (!isset($_GET['go'])) $opcion = 0;
else $opcion=$_GET['go'];

switch ($opcion)
 {

case 1:
 include("../proveedores/menu_g_p.php");
break;
 case 2:
 include("contenido2.php");
break;
 case 3:
 include("contenido3.php");
break;
 case 4:
 include("contenido4.php");
break;
 case 0:
 include("inicio.php");
break;
 default:
 include("inicio.php");
 }
 ?>