<?php
include ("../Conexiones/conexion_local.php"); 
?>
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css" />
<title>Modificacion Clientes</title> 

<script language="Javascript" type="text/javascript" src="ajax_usuario.js"> 
</script>  
<script language="Javascript" type="text/javascript" src="../js/validar_form.js"> 
</script>  
<?php
session_start();
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['usuario'])) )
{
   //En caso de que el usuario no este autenticado, crear un f1 y redireccionar a la pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    header("Location:../clientes/menu_g_c.php");
}


 //Session("Url")="FormUsuariosModi.asp"
  $enllac = mysql_connect($servidor,$usuari,$contrasenya);
  mysql_select_db($baseDatos,$enllac);
  $strSQL;		
  $strSQL = "SELECT * FROM CLIENTE " ;
  $strSQL = $strSQL . "where DNI = '" . $_GET['dni']."'" ; 
  $resultat = mysql_query($strSQL, $enllac);
  $count=mysql_num_rows($resultat);
  if($count==0) header("Location:../clientes/menu_g_c.php");
  $fila2=mysql_fetch_array($resultat);
  $idprovincia = $fila2['PROVINCIA'];
  $idpoblacion = $fila2['LOCALIDAD'];
  //echo " Nombre: ". $fila['NOMBRE'] ." DNI :" .$fila['DNI'];


$dni = $_GET['dni'];
$idCliente = $fila2['ID_CLIENTE'];
$nombre=$fila2['NOMBRE'];
$apellido =$fila2['APELLIDO1'];
//echo " DNI : " . $dni ;
//echo " <BR> USUARIO : " . $usuario ;
 ?>

<body>
<table>
<tr>
<td>
<div id ="logo">
	<img src="../images/logo_gesdes.jpg" width="319" height="162" /> 
</div>
</td>
<td>
<div id="header" class="letratext">
    <!--
    <a href="../index.html">INICIO</a>
    -->
   <BR /> <a href="../compras/alta_c_cat.php?dni=<?=$dni?>&idCliente=<?=$idCliente?>">LISTADO DE PRECIOS</a>   
    <br /><a href="modificar.php?dni=<?=$dni?>" style="visibility:hidden" >EDITAR PERFIL</a>    
    <!--<br /><a href="../clientes/listado.php?dni=<?=$dni?>">Listado</a>-->
    <br /><a href="menu_g_c.php">SALIR SESION</a>
    
</div>

</td>

</tr>

</table>
<div id="apDiv1" class="letratext"><?=$nombre . " ".$apellido?></div>
<div id = "detalle">
<H3  class="letranegrita">MODIFICAR</H3> 
<div class="rounded" style="width:325">
<form action="procesarDatos.php?modo=MODIFICAR" method="post" NAME="f1"  onSubmit="return validar(this)"> 
<TABLE>
<TR> 
   <TD class="Estilo1">Nombre:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="nombre" SIZE="20" MAXLENGTH="20" value="<?=$fila2['NOMBRE']?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Apellido1:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="apellido1" SIZE="20" MAXLENGTH="50" value="<?=$fila2["APELLIDO1"]?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Apellido2:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="apellido2" SIZE="20" MAXLENGTH="50" value="<?=$fila2["APELLIDO2"]?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">DNI:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="dni" disabled SIZE="9" MAXLENGTH="9" value="<?=$fila2["DNI"]?>"></TD> 
</TR> 

<TR> 
   <TD class="Estilo1">Tfno Fijo:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="tfno" SIZE="20" MAXLENGTH="20"  value="<?=$fila2["TELEFONO"]?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Tfno Movil:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="movil" SIZE="20" MAXLENGTH="20"  value="<?=$fila2["MOVIL"]?>"></TD> 
</TR> 
   <TD class="Estilo1">Email:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" name="Email" SIZE="20" MAXLENGTH="50" value="<?=$fila2["EMAIL"]?>"></TD> 
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
<Input type="hidden"  NAME="id" value="<?= $fila2['ID_CLIENTE']?>">
<Input type="hidden"  NAME="dni" value="<?= $fila2['DNI']?>">
<Input type="hidden"  NAME="usuario_old" value="<?= $fila2['USUARIO']?>">
<INPUT TYPE="submit" NAME="accion" VALUE="Grabar"> 
<INPUT TYPE="submit" NAME="borrar" VALUE="Borrar"> 
</FORM>
<div>
<!--
<a href='javascript:history.back()'>Volver</a>
-->
<?php
  mysql_close($enllac);
 ?> 
</div>
<div style="background-color:#666"><span style="color:#FFF">gesdesc.com &copy; Politica de privacidad  93 831 03 01</span></div>


</body>
</html>

