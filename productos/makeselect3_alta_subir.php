<script language="Javascript" type="text/javascript" src="../productos/ajax_id_prod.js"> 
</script>  
<script language="Javascript" type="text/javascript" src="../js/validar_form.js">
</script>  

<?php
    session_start();
	$idcat = $_GET['categoria'];
	$idsubcat = $_GET['subcategoria'];
	$idProveedor=$_GET['id_proveedor'];
	$miNIF = $_GET['nif'];
	$nombre=$_GET['nombre'];
	$_SESSION['UrlDestino']="../productos/makeselect3_alta.php";
    header("Content-Type: text/html;charset=utf-8");
	
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['nif'])) )
{
   //En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    header("Localtion:../proveedores/menu_g_p.php");
}

 ?>

 
<form action="../productos/procesarDatos_t.php?modo=ALTA" method="post" NAME="f1"  onSubmit="return validar_producto(this)"> 
<TABLE width="410" class="rounded"> 
<TR> 
   <TD width="138" class="Estilo1">Código almacén:</TD> 
   <TD width="245" class="Estilo1"><INPUT TYPE="text" NAME="cod_almacen" id ="cod_almacen" SIZE="15" MAXLENGTH="15" ></TD> 
</TR> 

<TR> 
   <TD width="138" class="Estilo1">Código fábrica:</TD> 
   <TD width="245" class="Estilo1"><INPUT TYPE="text" NAME="id_fabrica" id ="id_fabrica" SIZE="15" MAXLENGTH="15" onBlur="compruebaValido_p()"><span id = "resposta" style="color:#F00"><span></TD> 
</TR> 

<TR> 
   <TD class="Estilo1">Marca:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="marca" id ="marca" SIZE="10" MAXLENGTH="15"></TD> 
</TR>
<TR> 
   <TD class="Estilo1">Descripción:</TD> 
   <TD class="Estilo1">
   <!--
   <INPUT TYPE="text" name="descripcion" SIZE="30" MAXLENGTH="100" >
   -->
   <textarea name="descripcion" cols="30" rows="6" id="descripcion"></textarea>
   </TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Link (http:// delante):</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" name="link" id="link" SIZE="35" MAXLENGTH="100" ></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">PVP:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="pvp" SIZE="11" MAXLENGTH="20"  ></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Descuento una unidad:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="descuento" SIZE="11" MAXLENGTH="11" >%</TD> 
</TR>
<TR> 
   <TD class="Estilo1">Uds máxima descuento:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="max_u_des" SIZE="11" MAXLENGTH="11" ></TD> 
</TR>
<TR> 
   <TD class="Estilo1">Descuento máximo:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="descuento_m" SIZE="11" MAXLENGTH="11" >%</TD> 
</TR>

</TABLE> 

<INPUT TYPE="submit" NAME="accion" VALUE="Grabar"> 
<input type="reset" name="Submit" value="Restablecer">
<input type="button" name="cancelar" value="Cancelar" onclick="history.back(-1);" />
<Input type="hidden"  NAME="id_proveedor" value="<?=$idProveedor?>">
<Input type="hidden"  NAME="nif" value="<?=$miNIF?>">
<Input type="hidden"  NAME="categoria" value="<?=$idcat?>">
<Input type="hidden"  NAME="subcategoria" value="<?=$idsubcat?>">
<Input type="hidden" id="nombre" value="<?=$nombre?>">
<Input type="hidden"  NAME="existencias" value="1">
</FORM> 
