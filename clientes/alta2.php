
<script language="Javascript" type="text/javascript" src="../clientes/ajax_usuario.js"> 
</script>  
<script language="Javascript" type="text/javascript" src="../js/validar_form.js"> 
</script>  
  <meta charset="UTF-8">
	<div style=" display:inline-block">
    	<div class="rounded" style="background-color:#CF9;color: #333; float:left;width:200px;height:130px; font-size:14px">
			<p align="center"><strong><em>1º <br />
				ACEPTAR CONDICIONES</em></strong>
			</p>
            <p align="center"><strong><em>Normativa de uso</em></strong></p>
		</div>
        <div style="float:left; width:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        <div class="rounded" style="background-color:#CF9;color: #333;float:left;width:200px;height:130px " >
			<p align="center"><strong><em>2º</em></strong><br>
				<strong><em>RELLENAR FORMULARIO</em></strong>
			</p>
			<p align="center"><em><strong>Datos reales que se verificarán</em></strong></p>
		</div>
		
        
		<div style="float:left; width:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div class="rounded" style="background-color:#CF9;color: #333;float:left; width:200px; height:130px">
			<p align="center"><strong><em>3º<br />
            
				EL USO DEL SERVIVIO <BR />
                PROFESIONAL ES<BR />
                ES GRATUITO
                
                </em></strong>
             </p>   
              
			</p>
	    </div>
    </div>
    
	<br />
		<H3  class="letranegrita">REGISTRO PROFESIONAL</H3>
       
		<div class="rounded" style="width:325">
            <form action="../clientes/procesarDatos2.php?modo=ALTA" method="post" NAME="f1"  onSubmit="return validar(this)"> 
    
            <TABLE > 
            <TR> 
               <TD class="Estilo1">Nombre empresa:</TD> 
               <TD class="Estilo1"><INPUT TYPE="text" NAME="nombre" SIZE="40" MAXLENGTH="60" required="required"></TD> 
            </TR> 
            
            <TR> 
               <TD class="Estilo1">Actividad empresa:</TD> 
               <TD class="Estilo1"><INPUT TYPE="text" NAME="apellido1" SIZE="40" MAXLENGTH="60" ></TD> 
            </TR> 
            
            <TR> 
               <TD class="Estilo1">Nombre comercial:</TD> 
               <TD class="Estilo1"><INPUT TYPE="text" NAME="apellido2" SIZE="40" MAXLENGTH="60" ></TD> 
            </TR>
        
           
            
              
              
           
            
              <TR> 
                <TD class="Estilo1"><label>
                <input type="radio" name="nifcif" value="1" id="RadioGroup1_0" checked="checked" />
               NIF</label>
             
              <label>
                <input type="radio" name="nifcif" value="2" id="RadioGroup1_1" />
                CIF</label>
                </TD> 
                <TD class="Estilo1"><INPUT TYPE="text" NAME="dni" id="dni" SIZE="9" MAXLENGTH="9" required ></TD> 
              <TR> 
                 <TD class="Estilo1">Tfno Fijo:</TD> 
                 <TD class="Estilo1"><INPUT TYPE="text" NAME="tfno" SIZE="20" MAXLENGTH="20"  ></TD> 
              <TR> 
              <TR> 
                 <TD class="Estilo1">Tfno Movil:</TD> 
                 <TD class="Estilo1"><INPUT TYPE="text" NAME="movil" SIZE="20" MAXLENGTH="20"></TD> 
              <TR> 
                 <TD class="Estilo1">Email:</TD> 
                 <TD class="Estilo1"><INPUT type="email" name="Email" SIZE="30" MAXLENGTH="50"  required="required"></TD> 
              </TR> 
              <TR> 
                <TD class="Estilo1">Usuario:</TD> 
                <TD class="Estilo1">
                  <INPUT TYPE="text" NAME="usuario" id = "usuario" SIZE="20" MAXLENGTH="20"  onBlur="compruebaValido()" required>
                 <span id ="resposta_existe" style="color:#F00"></span></TD> 
              </TR> 
              <TR> 
                <TD class="Estilo1">Razón social:</TD> 
                <TD class="Estilo1"><INPUT TYPE="text" NAME="direccion" SIZE="40" MAXLENGTH="50" required></TD> 
              </TR>
            </TABLE>
            <?php include ("../includes/provincia.php");?>
            Pais :<INPUT TYPE="text" NAME="pais" SIZE="20" MAXLENGTH="20"> 
            <hr> 
            <INPUT TYPE="submit" NAME="accion" VALUE="Grabar"> 
            <input type="reset" name="Submit" value="Restablecer">
            </FORM> 
	
</div>



