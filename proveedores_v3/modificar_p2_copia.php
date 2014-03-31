<?php

session_start();
//echo $_SESSION['autenticado'] . " ". $_SESSION['nif'];
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['nif'])) )
{
   //En caso de que el usuario no este autenticado, crear un f1 y redireccionar a la pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
	//
	//exit();
	echo "<script language='javascript'>window.location='../proveedores/menu_g_p.php'</script>;"; 
	//header("Location:../proveedores/login_prov.php");
	exit();
	
}
include ("../Conexiones/conexion_local.php"); 
 $enllac = mysql_connect($servidor,$usuari,$contrasenya);
  mysql_select_db($baseDatos,$enllac);
  $strSQL;		
  $strSQL = "SELECT * FROM PROVEEDOR " ;
  $strSQL = $strSQL . "where NIF = '" . $_GET['unif']."'" ; 
  $resultat = mysql_query($strSQL, $enllac);
  $count=mysql_num_rows($resultat);
  if($count==0) header("Location:../proveedores/menu_g_p.php");
  $fila2=mysql_fetch_array($resultat);
  $idprovincia = $fila2['PROVINCIA'];
  $idpoblacion = $fila2['LOCALIDAD'];
  $nombre=$fila2['NOMBRE'];
  $unif=$_GET['unif'];
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css" />
<title>Proveedor</title>
<script language="Javascript" type="text/javascript" src="ajax_proveedor.js"> 
</script>  
<script language="Javascript" type="text/javascript" src="../js/validar_form.js"> 
</script>  
</head>
<body>
<div id="apDiv1" class="letratext"><?=$nombre ?></div> 
<table><tr>
<td><div id ="logo"><img src="../images/logo_gesdes.jpg" width="319" height="162"/></div></td>
<td>
<p class="curved-box-css4">&nbsp;&nbsp;Proveedor</p>
<div id="menu2" class="letratext">
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=0&unif=<?=$unif?>&nombre=<?=$nombre?>">&nbsp;&nbsp;01. INICIO</a>
     <!--
     &nbsp;&nbsp;<a href="../index.html">&nbsp;&nbsp;01. INICIO</a>
     
    <br /><a href="../productos/alta_t_cat.php?unif=<?=$unif?>&id_proveedor=<?=$id_proveedor?>">ALTA PRODUCTO</a>
    -->
   
    <!--
    <br />&nbsp;&nbsp;<a href="../productos/SelecModi_t.php?go=1&unif=<?=$unif?>" >EDITAR PRODUCTO</a>

    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=1&unif=<?=$unif?>&nombre=<?=$nombre?>">&nbsp;&nbsp;03. EDITAR PRODUCTO</a>
    <br />&nbsp;&nbsp;<a href="../productos/listado_t.php?unif=<?=$unif?>">&nbsp;&nbsp;04. LISTAR PRODUCTOS</a>
    <br />&nbsp;&nbsp;<a href="../compras/gestion_compra_p.php?unif=<?=$unif?>">&nbsp;&nbsp;05. CONFIRMAR PEDIDOS</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/modificar_p2.php?unif=<?=$unif?>" style="visibility:hidden">&nbsp;&nbsp;06. EDITAR PERFIL</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_g_p.php">&nbsp;&nbsp;07. VOLVER</a>
        -->
    
    <br />
    &nbsp;&nbsp;<a href="../productos/alta_t_cat.php">&nbsp;&nbsp;02. ALTA PRODUCTO</a>
    <!--
    <br />&nbsp;&nbsp;<a href="../productos/SelecModi_t.php?go=1&unif=<?=$unif?>" >EDITAR PRODUCTO</a>
    -->
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=1&unif=<?=$unif?>&nombre=<?=$nombre?>">&nbsp;&nbsp;03. EDITAR PRODUCTO</a>
    <!--
    <br />&nbsp;&nbsp;<a href="../productos/listado_t.php?unif=<?=$unif?>">&nbsp;&nbsp;04. LISTAR PRODUCTOS</a>
    -->
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=3&unif=<?=$unif?>">&nbsp;&nbsp;04. LISTAR PRODUCTOS</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=4&unif=<?=$unif?>">&nbsp;&nbsp;05. CONFIRMAR PEDIDOS</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/modificar_p2.php?unif=<?=$unif?>">&nbsp;&nbsp;06. EDITAR PERFIL</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=6&unif=<?=$unif?>">&nbsp;&nbsp;07. EDITAR CALENDARIO FESTIVOS</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_g_p.php">&nbsp;&nbsp;08. SALIR SESION</a>

    
    
    
</div>
</td>
</tr>
</table>
<div id="apDiv1" class="letratext"><?=$nombre?></div>

<H3 class="letranegrita">MODIFICAR</H3> 
<div class="rounded" style="width:325">
<form action="procesarDatos_p.php?modo=MODIFICAR" method="post" NAME="f1"  onSubmit="return validar(this)"> 
<TABLE>
<TR> 
   <TD class="Estilo1">Nombre:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="nombre" SIZE="30" MAXLENGTH="100" value="<?=$fila2['NOMBRE']?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">NIF/CIF:</TD> 
   <TD class="Estilo1">
   <INPUT TYPE="text" NAME="nif" disabled SIZE="9" MAXLENGTH="9" value="<?=$fila2["NIF"]?>"></TD> 
</TR> 

<TR> 
   <TD class="Estilo1">Tfno Fijo:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="tfno" SIZE="20" MAXLENGTH="20"  value="<?=$fila2["TELEFONO"]?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Tfno Movil:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="movil" SIZE="20" MAXLENGTH="20"  value="<?=$fila2["MOVIL"]?>"></TD> 
</TR> 
<TR>
   <TD class="Estilo1">Email:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" name="Email" SIZE="20" MAXLENGTH="50" value="<?=$fila2["EMAIL"]?>"></TD> 
</TR> 

<TR>
   <TD class="Estilo1">Link:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" name="Link" SIZE="30" MAXLENGTH="50" value="<?=$fila2["LINK"]?>"></TD> 
</TR> 

<TR> 
   <TD class="Estilo1">Usuario:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="usuario" id ="usuario" SIZE="20" MAXLENGTH="20" onBlur="compruebaCambio()" value="<?=$fila2["USUARIO"]?>"  ><br><span id ="resposta" style="color:#F00"></span></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Password:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="password" SIZE="8" MAXLENGTH="8"  value="<?=$fila2["PWD"]?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Sector:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="sector" SIZE="20" MAXLENGTH="20"  value="<?=$fila2["SECTOR"]?>"></TD> 
</TR> 
 <TR> 
   <TD class="Estilo1">Direccion:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="direccion" SIZE="20" MAXLENGTH="50"  value="<?=$fila2["DIRECCION"]?>"></TD> 
</TR>

<TR> 
   <TD class="Estilo1">Pais:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="pais" SIZE="20" MAXLENGTH="20"  value="<?=$fila2["PAIS"]?>"></TD> 
</TR> 
 
 
</TABLE> 
<?php 
include ("../includes/provincia.php");
?>
<hr> 
<Input type="hidden"  NAME="id" value="<?= $fila2['ID_PROVEEDOR']?>">
<Input type="hidden"  NAME="nif" value="<?= $fila2['NIF']?>">
<Input type="hidden"  NAME="usuario_old" value="<?= $fila2['USUARIO']?>">
<INPUT TYPE="submit" NAME="accion" VALUE="Grabar"> 
<INPUT TYPE="submit" NAME="borrar" VALUE="Borrar"> 
</FORM>
<div>

<?php
  mysql_close($enllac);
 ?> 
<div style="background-color:#666"><span style="color:#FFF">gesdesc.com &copy; Politica de privacidad  93 831 03 01</span></div>

</body> 
</html> 