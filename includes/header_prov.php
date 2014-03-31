<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css" />
<title>Profesional</title>
<body>
<div id="apDiv1" class="letratext"><?=$nombre ?></div> 
<table><tr>
<td><div id ="logo"><img src="../images/logo_gesdes.jpg" width="319" height="162"/></div></td>
<td>
<p class="curved-box-css4">&nbsp;&nbsp;Proveedor</p>
<div id="menu2" class="letratext">
     &nbsp;&nbsp;<a href="../index.html">&nbsp;&nbsp;01. INICIO</a>
     <!--
    <br /><a href="../productos/alta_t_cat.php?unif=<?=$unif?>&id_proveedor=<?=$id_proveedor?>">ALTA PRODUCTO</a>
    -->
    <br />
    &nbsp;&nbsp;<a href="../productos/alta_t_cat.php">&nbsp;&nbsp;02. ALTA PRODUCTO</a>
    <!--
    <br />&nbsp;&nbsp;<a href="../productos/SelecModi_t.php?go=1&unif=<?=$unif?>" >EDITAR PRODUCTO</a>
    -->
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=1&unif=<?=$unif?>&nombre=<?=$nombre?>">&nbsp;&nbsp;03. EDITAR PRODUCTO</a>
    <br />&nbsp;&nbsp;<a href="../productos/listado_t.php?unif=<?=$unif?>">&nbsp;&nbsp;04. LISTAR PRODUCTOS</a>
    <br />&nbsp;&nbsp;<a href="../compras/gestion_compra_p.php?unif=<?=$unif?>">&nbsp;&nbsp;05. CONFIRMAR PEDIDOS</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/modificar_p2.php?unif=<?=$unif?>">&nbsp;&nbsp;06. EDITAR PERFIL PROVEEDOR</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_g_p.php">&nbsp;&nbsp;07. VOLVER</a>
</div>
</td>
</tr>
</table>
<div id="apDiv1" class="letratext"><?=$nombre?></div>
