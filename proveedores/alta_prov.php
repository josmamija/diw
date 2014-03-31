<script language="Javascript" type="text/javascript" src="../proveedores/ajax_proveedor.js"> 
</script>  
<script language="Javascript" type="text/javascript" src="../js/validar_form.js"> 
</script>  
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta charset="UTF-8">
	<div style=" display:inline-block">
    	<div class="rounded" style="background-color:#CF9;color: #333; float:left;width:200px;height:130px">
			<p align="center"><strong><em>1º <br />
				ACEPTAR EL CONTRATO</em></strong>
			</p>
            <p align="center"><strong><em>Normativa de uso</em></strong></p>
		</div>
        <div style="float:left; width:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        <div class="rounded" style="background-color:#CF9;color: #333;float:left;width:200px;height:130px " >
			<p align="center"><strong><em>2º</em></strong><br>
				<strong><em>RELLENAR FORMULARIO</em></strong>
			</p>
			<p align="center"><em><strong>Datos relaes que se verificarán</em></strong></p>
		</div>
		
        
		<div style="float:left; width:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div class="rounded" style="background-color:#CF9;color: #333;float:left; width:200px; height:130px">
			<p align="center"><strong><em>3º<br />
            
				DATOS BANCARIOS
                </em></strong>
             </p>   
              <p><strong><em>  Envio de datos bancarios de forma segura. 
                Para acceso promoción clickar CANCELAR
                </strong></em>
			</p>
	    </div>
    </div>

<H3  class="letranegrita">REGISTRO PROVEEDOR</H3> 
<div class="rounded" style="width:325">
<form action="procesarDatos_p.php?modo=ALTA" method="post" NAME="f1"  onSubmit="return validar(this)"> 
<TABLE> 
<TR> 
   <TD class="Estilo1">Nombre:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="nombre" SIZE="30" MAXLENGTH="100" required></TD> 
</TR> 

<TR> 
   <TD class="Estilo1">Nombre comercial:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="nombreComercial" SIZE="30" MAXLENGTH="100" required></TD> 
</TR> 
<TR> 
   <TD class="Estilo1"><label>
                <input type="radio" name="nifcif" value="1" id="RadioGroup1_0" checked="checked" />
               NIF</label>
             
              <label>
                <input type="radio" name="nifcif" value="2" id="RadioGroup1_1" />
                CIF</label>
                </TD>  
   <TD class="Estilo1"><INPUT TYPE="text" NAME="nif" id = "dni" SIZE="9" MAXLENGTH="9" required></TD> 
<TR> 
   <TD class="Estilo1">Sector:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="sector" SIZE="20" MAXLENGTH="20"></TD>    
</TR>    
<TR> 
   <TD class="Estilo1">Tfno Fijo:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="tfno" SIZE="20" MAXLENGTH="20"  ></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Tfno Movil:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="movil" SIZE="20" MAXLENGTH="20"></TD> 
<TR> 
   <TD class="Estilo1">Email:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" name="Email" SIZE="30" MAXLENGTH="50" required></TD> 
</TR> 

<TR> 
   <TD class="Estilo1">Link:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" name="Link" id="Link" SIZE="30" MAXLENGTH="50" ></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Usuario:</TD> 
   <TD class="Estilo1">
   <INPUT TYPE="text" NAME="usuario" id ="usuario" SIZE="20" MAXLENGTH="20" onBlur="compruebaValido()"required>
   
   <span id="resposta_existe_prov" style="color:#F00"></span>
   </TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Direccion:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="direccion" id="direccion" SIZE="30" MAXLENGTH="50" required></TD> 
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




