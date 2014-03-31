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
  mysql_set_charset('utf8');
  $count=mysql_num_rows($resultat);
  if($count==0) header("Location:../proveedores/menu_g_p.php");
  $fila2=mysql_fetch_array($resultat);
  $idprovincia = $fila2['PROVINCIA'];
  $idpoblacion = $fila2['LOCALIDAD'];
  $nombre=$fila2['NOMBRE'];
  $unif=$_GET['unif'];
  $pais =utf8_encode($fila2["PAIS"]);
  
?>
<script language="Javascript" type="text/javascript" src="../proveedores/ajax_proveedor.js"> 
</script>  
<script language="Javascript" type="text/javascript" src="../js/validar_form.js"> 
</script> 

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

<H3 class="letranegrita">MODIFICAR</H3> 
<div class="rounded" style="width:325">
<form action="procesarDatos_p.php?modo=MODIFICAR" method="post" NAME="f1"  onSubmit="return validar(this)"> 
<TABLE>
<TR> 
   <TD class="Estilo1">Nombre:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="nombre" SIZE="30" MAXLENGTH="100" value="<?=$fila2['NOMBRE']?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Nombre comercial:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="nombreComercial" SIZE="30" MAXLENGTH="100" value="<?=$fila2['NOMBRE_COMERCIAL']?>"></TD> 
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
   <TD class="Estilo1"><INPUT TYPE="text" name="Link" id="Link" SIZE="30" MAXLENGTH="60" value="<?=$fila2["LINK"]?>"></TD> 
</TR> 
<TR>
   <TD class="Estilo1">Link de ofertas:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" name="Link_ofertas" id="Link_ofertas" SIZE="30" MAXLENGTH="60" value="<?=$fila2["LINK_OFERTAS"]?>"></TD> 
</TR> 

<TR> 
   <TD class="Estilo1">Usuario:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="usuario" id ="usuario" SIZE="20" MAXLENGTH="20" onBlur="compruebaCambio()" value="<?=$fila2["USUARIO"]?>"  ><br><span id ="resposta_existe_prov" style="color:#F00"></span></TD> 
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
   <TD class="Estilo1"><INPUT TYPE="text" NAME="pais" SIZE="20" MAXLENGTH="20"  value="<?=$pais?>"></TD> 
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
<input type="button" name="cancelar" value="Cancelar" onclick="history.back(-1);" />
</FORM>
<div>

<?php
  mysql_close($enllac);
 ?> 
