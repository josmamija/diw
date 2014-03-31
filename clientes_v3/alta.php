
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css" />
<title>Modificacion Clientes</title> 
<style type="text/css">
 
#apDiv1 {
	position:absolute;
	width:226px;
	height:28px;
	z-index:1;
	left: 441px;
	top: 21px;
}
</style>
<script language="Javascript" type="text/javascript" src="ajax_usuario.js"> 
</script>  
<script language="Javascript" type="text/javascript" src="../js/validar_form.js"> 
</script>  

<body>
<table>
<tr>
<td>
<div id ="logo">
	<img src="../images/logo_gesdes.jpg" width="319" height="162" /> 
</div>
</td>
<td>
<p class="curved-box-css4">&nbsp;&nbsp;Profesional</p>
<div id="header" class="letratext">
    <!--
    <a href="../index.html">01.&nbsp;&nbsp;INICIO</a>
   -->
    <!--<br /><a href="../clientes/listado.php?dni=<?=$dni?>">Listado</a>-->
    <br /><a href="menu_g_c.php">01.&nbsp;&nbsp;VOLVER</a>
    
</div>

</td>

</tr>

</table>

<div id = "detalle">
<H3  class="letranegrita">MODIFICAR</H3> 
<div class="rounded" style="width:325">
<form action="procesarDatos.php?modo=ALTA" method="post" NAME="f1"  onSubmit="return validar(this)"> 

<TABLE > 
<TR> 
   <TD class="Estilo1">Nombre:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="nombre" SIZE="20" MAXLENGTH="20"></TD> 
</TR> 

<TR> 
   <TD class="Estilo1">Apellido1:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="apellido1" SIZE="20" MAXLENGTH="50" ></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Apellido2:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="apellido2" SIZE="20" MAXLENGTH="50" ></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">DNI:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="dni" SIZE="9" MAXLENGTH="9"  ></TD> 
<TR> 
   <TD class="Estilo1">Tfno Fijo:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="tfno" SIZE="20" MAXLENGTH="20"  ></TD> 
<TR> 
<TR> 
   <TD class="Estilo1">Tfno Movil:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="movil" SIZE="20" MAXLENGTH="20"></TD> 
<TR> 
   <TD class="Estilo1">Email:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" name="Email" SIZE="20" MAXLENGTH="50" ></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Usuario:</TD> 
   <TD class="Estilo1">
   <INPUT TYPE="text" NAME="usuario" id = "usuario" SIZE="20" MAXLENGTH="20"  onBlur="compruebaValido()" >
   <span id ="resposta" style="color:#F00"></span></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Direccion:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="direccion" SIZE="20" MAXLENGTH="50" ></TD> 
</TR>
</TABLE>

<?php 
include ("../includes/provincia.php");
?>

Pais :<INPUT TYPE="text" NAME="pais" SIZE="20" MAXLENGTH="20"> 
<hr> 
<INPUT TYPE="submit" NAME="accion" VALUE="Grabar"> 
<input type="reset" name="Submit" value="Restablecer">
</FORM> 
<div>
<!--
<a href='javascript:history.back()'>Volver</a>
-->

</div>
<div style="background-color:#666"><span style="color:#FFF">gesdesc.com &copy; Politica de privacidad  93 831 03 01</span></div>


</body>
</html>




