<?php
include ("../Conexiones/conexion_local.php"); 
//session_start();
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['nif'])) )
{
   //En caso de que el usuario no este autenticado, crear un f1 y redireccionar a la pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    //header("Location:../proveedores/login_prov.php");
	exit();
	 echo "<script language='javascript'>window.location='../proveedor/menu_g_p.php'</script>;"; 
}
//echo " cod_producto: ".  $_POST['cod_producto'];
//echo " nif: ".  $_POST['nif'];
// $nif=$_POST['nif'];
 //Session("Url")="FormUsuariosModi.asp"
 $enllac = mysql_connect($servidor,$usuari,$contrasenya);
 mysql_select_db($baseDatos,$enllac);
 $strSQL;		
 $strSQL = "SELECT * FROM PRODUCTO " ;
 $strSQL = $strSQL . "WHERE NIF = '" . $unif ."'" . " AND COD_PRODUCTO = '" . $_GET['cod_producto'] ."'" ; 
 $resultat = mysql_query($strSQL, $enllac);
 $count=mysql_num_rows($resultat);
 if($count==0){
	echo "NO existe producto con ese codigo";
    echo "<a href='javascript:history.back()'> Volver</a>";  
	exit();
 }
 else {
	$fila=mysql_fetch_array($resultat);
	//echo " Nombre: ". $fila['NOMBRE'] ." DNI :" .$fila['DNI'];
	$desmaximo=round(100-($fila['P_NETO_M']*100)/$fila['PVP'],2);
//echo $unif;
$nom_arch= $fila['NIF']."_".$fila['ID_FABRICA'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../uploads/upload.js"></script>
<script type="text/javascript" src="../uploads/subir.js"></script>


<H3 >MODIFICAR</H3> 


<div class="container">
       <h3> Adjuntar documento (PDF)</h3>
       <hr />
       <div id="respuesta" class="alert"></div>
       <form action="javascript:void(0);">
          <div class="row">
          <!--
             <div class="col-lg-2"> 
                <label> Nombre el archivo: </label> 
             </div>
             -->
             <!--
             <div class="col-lg-2">
             -->
                <input type="hidden" name="nombre_archivo" id="nombre_archivo" value="<?= $nom_arch?>"/>
             <!--
             </div>
             -->
             <div class="col-lg-2">
                <input type="file" name="archivo" id="archivo" />
             </div> 
          </div>
          <hr />
          <div class="row">
             <div class="col-lg-2">
                <input type="submit" id="boton_subir" value="Subir" class="btn btn-success" />
                <progress id="barra_de_progreso" value="0" max="100"></progress>
             </div>
             <!--<div class="col-lg-4">-->
                
             <!--</div>-->
          </div>
       </form>
      <hr />
        <div id="archivos_subidos">Documento adjunto:&nbsp;</div>
    </div>





<form action = "../productos/procesarDatos_t_tmp.php?modo=MODIFICAR" method = "post" NAME="Formulario" accept-charset="utf-8"> 
<?php include ("../productos/categoria_modi.php");?>
<TABLE class="rounded">
<TR> 
   <TD class="Estilo1">Código Almacen:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="cod_almacen" SIZE="15" MAXLENGTH="15" value="<?=$fila['COD_ALMACEN']?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Código Fábrica:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" disabled NAME="id_fabrica" SIZE="15" MAXLENGTH="15" value="<?=$fila['ID_FABRICA']?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Marca:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="marca" SIZE="15" MAXLENGTH="15"  value="<?=$fila["MARCA"]?>"></TD> 
</TR> 
   <TD class="Estilo1">Descripción:</TD> 
   <TD class="Estilo1">
   <!--
   <INPUT TYPE="text" name="descripcion" SIZE="40" MAXLENGTH="50" value="<?=$fila["DESCRIPCION"]?>">
   -->
   <textarea name="descripcion" cols="30" rows="6"><?=utf8_encode($fila["DESCRIPCION"])?></textarea>
   </TD> 
</TR> 

</TR> 
   <TD class="Estilo1">Link (http:// delante):</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" name="link" SIZE="40" MAXLENGTH="100" value="<?=$fila["LINK"]?>"></TD> 
</TR> 

<TR> 
   <TD class="Estilo1">PVP:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="pvp" SIZE="20" MAXLENGTH="20"  value="<?=$fila["PVP"]?>"></TD> 
</TR> 
<TR> 
   <TD class="Estilo1">Descuento una Ud.:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="descuento" SIZE="5" MAXLENGTH="11"  value="<?=$fila["DESCUENTO"]?>">%</TD> 
</TR>
<TR> 
   <TD class="Estilo1">Uds. máxima descuento:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="max_u_des" SIZE="5" MAXLENGTH="11"  value="<?=$fila["MAX_U_DES"]?>"></TD> 
</TR> 
 
<TR> 
   <TD class="Estilo1">Descuento máximo:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="descuento_m" SIZE="5" MAXLENGTH="11"value="<?=$desmaximo?>" >%</TD> 
</TR>
<!--
<TR> 
   <TD class="Estilo1">Existencias:</TD> 
   <TD class="Estilo1"><INPUT TYPE="text" NAME="existencias" SIZE="11" MAXLENGTH="11"  value="<?=$fila["EXISTENCIAS"]?>"></TD> 
 </TR>  
-->   
 
</TABLE> 

<Input type="hidden"  NAME="nif" value="<?= $fila['NIF']?>">
<Input type="hidden"  NAME="id_producto" value="<?= $fila['PRODUCTO_ID']?>">
<Input type="hidden"  NAME="id_fabrica" value="<?= $fila['ID_FABRICA']?>">
<Input type="hidden"  NAME="existencias" value="<?=$fila["EXISTENCIAS"]?>">
<Input type="hidden"  NAME="subcat" value="<?=$fila["SUBCAT_ID"]?>">
<Input type="hidden"  NAME="id_proveedor" value="<?=$fila['ID_PROVEEDOR']?>">
<Input type="hidden"  NAME="adjunto" id ="adjunto" value= "0">
<INPUT TYPE="submit" NAME="accion" VALUE="Grabar"> 
<INPUT TYPE="submit" NAME="borrar" VALUE="Borrar"> 
<input type="button" name="cancelar" value="Cancelar" onclick="history.back(-1);" />
</FORM> 
<!--
<hr align="left" width="300"> 
<div align="left"><a href='javascript:history.back()'>Volver</a>  </div>
-->
<?php
/*
 $sCadena= "<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1>";
 $sCadena=$sCadena . "<TR bgcolor='#993333'><TD class='Estilo1'>&nbsp;Nombre</TD>";
 $sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Email&nbsp;</TD>";
 $sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Telefono&nbsp;</TD>";
 $sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Clave&nbsp;</TD></TR>";
      
while($fila=mysql_fetch_array($resultat)){
   $sCadena=$sCadena . "<tr><td>Nombre:</td><td class='Estilo1'>&nbsp;" . $fila["Nombre"] . "</td></tr>";
   $sCadena=$sCadena . "<tr><td>Apellido1:</td><td class='Estilo1'>&nbsp;" . $fila["Apellido1"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Apellido2:</td><td class='Estilo1'>&nbsp;" . $fila["Apellido2"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Tfno. Fijo:</td><td class='Estilo1'>&nbsp;" . $fila["telefono"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Tfno. Movil:</td><td class='Estilo1'>&nbsp;" . $fila["movil"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Email:</td><td class='Estilo1'>&nbsp;" . $fila["Email"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Usuario:</td><td class='Estilo1'>&nbsp;" . $fila["Usuario"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Password:</td><td class='Estilo1'>&nbsp;" . $fila["Pwd"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Direccion:</td><td class='Estilo1'>&nbsp;" . $fila["Direccion"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Localidad:</td><td class='Estilo1'>&nbsp;" . $fila["Localidad"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>CP:</td><td class='Estilo1'>&nbsp;" . $fila["CP"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Provincia:</td><td class='Estilo1'>&nbsp;" . $fila["Provincia"] . "&nbsp;</td></tr>";
   $sCadena=$sCadena . "<tr><td>Pais:</td><td class='Estilo1'>&nbsp;" . $fila["pais"] . "&nbsp;</td></tr>";
 }
 */
 echo "</table>";
  mysql_close($enllac);
 }
 ?> 
</body> 
</html> 