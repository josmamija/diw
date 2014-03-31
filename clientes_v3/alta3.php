<script language="Javascript" type="text/javascript" src="../clientes/ajax_usuario.js"> 
</script>  
<script language="Javascript" type="text/javascript" src="../js/validar_form.js"> 
</script>  
		<H3  class="letranegrita">REGISTRO PROFESIONAL</H3>
        <P>El uso del servicio de compras es totalmente gratuito, requiere confirmación de las condiciones de uso de gesdesc
<a href="../clientes/cond_uso.php">condiciones</a>
		<div class="rounded" style="width:325">
            <form action="../clientes/procesarDatos3.php?modo=ALTA" method="post" NAME="f1"  onSubmit="return validar(this)"> 
    
            <TABLE > 
            <TR> 
               <TD class="Estilo1">Nombre empresa:</TD> 
               <TD class="Estilo1"><INPUT TYPE="text" NAME="nombre" SIZE="40" MAXLENGTH="60"></TD> 
            </TR> 
            
            <TR> 
               <TD class="Estilo1">Actividad empresa:</TD> 
               <TD class="Estilo1"><INPUT TYPE="text" NAME="apellido1" SIZE="40" MAXLENGTH="40" ></TD> 
            </TR> 
            <!--
            <TR> 
               <TD class="Estilo1">Apellido2:</TD> 
               <TD class="Estilo1"><INPUT TYPE="text" NAME="apellido2" SIZE="20" MAXLENGTH="50" ></TD> 
            </TR>
            --> 
            <TR> 
               <TD class="Estilo1">NIF/CIF:</TD> 
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
               <TD class="Estilo1"><INPUT TYPE="text" name="Email" SIZE="30" MAXLENGTH="50" ></TD> 
            </TR> 
            <TR> 
               <TD class="Estilo1">Usuario:</TD> 
               <TD class="Estilo1">
               <INPUT TYPE="text" NAME="usuario" id = "usuario" SIZE="20" MAXLENGTH="20"  onBlur="compruebaValido()" >
               <span id ="resposta_existe" style="color:#F00"></span></TD> 
            </TR> 
            <TR> 
               <TD class="Estilo1">Razón social:</TD> 
               <TD class="Estilo1"><INPUT TYPE="text" NAME="direccion" SIZE="40" MAXLENGTH="50" ></TD> 
            </TR>
            </TABLE>
            <?php include ("../includes/provincia.php");?>
            Pais :<INPUT TYPE="text" NAME="pais" SIZE="20" MAXLENGTH="20"> 
            <hr> 
            <INPUT TYPE="submit" NAME="accion" VALUE="Grabar"> 
            <input type="reset" name="Submit" value="Restablecer">
            </FORM> 
	
</div>



