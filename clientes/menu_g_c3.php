<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GESDESC</title>
	<meta charset="UTF-8">
	<title>GESDESC</title>
    
	<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css">
    <style>
		#apDiv2 {
		position: absolute;
		width: 680px;
		height: 540px;
		z-index: 1;
		left: 4px;
		top: 27px;
		}
		
		#moopio1 {
			background-color:#9C0;
			float:left;
			width:185px;
			height:126px; 
			padding-top:3px 
			
			
		}
		#moopio1:hover {
			background-color: #9F9;
			float:left;
			width:185px;
			height:126px; 
			padding-top:3px 
		}
		#moopio2 {
			background-color:#9C0;
			float:left;
			width:185px;
			height:126px; 
			padding-top:3px 
			
			
		}
		#moopio2:hover {
			background-color: #9F9;
			float:left;
			width:185px;
			height:126px; 
			padding-top:3px 
		}
	</style>
</head>
<body>
<div id="apDiv2">
    <table>
    <tr>
    <td>
        <div id ="logo" align="center"  style="width:600">
        <img src="../images/logo_gesdesc_n.jpg" width="400" height="150" /> 
        </div>
    </td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
       <!--<div id="header" class="rounded"  style="font-size:16px; background-color: #AC0 ">
       <a href="proveedores/menu_g_p2.php" style=" color:#333">&nbsp;&nbsp;PROVEEDOR&nbsp;&nbsp;</a>
       <br /> <a href="clientes/menu_g_c2.php" style=" color:#333" >&nbsp;&nbsp;PROFESIONAL&nbsp;&nbsp;</a> </div>
       -->
       <a href="#">
   		<img src="../images/video.PNG" width="100" height="180" alt="productos y servicios" />
   		</a> 
    </td>
    </tr>
    </table>
    <div id = "cuerpo"  align="left" class="letratext">
      <ul id="llista_imatges" class="rounded" style="background-color: #333;color: #CF9">
		    <li><strong><em>PROFESSIONAL</em></strong></li>
        <li>&nbsp;&nbsp;&nbsp;</li>
        <li><a href="mailto:gestion@gesdesc.com"><strong><em>CONTACTO</em></strong></a></li>
        <li>&nbsp;&nbsp;&nbsp;</li>
        <li><a href="../index.html"><strong><em>INICIO</em></strong></a></li>
      </ul>
      <div class="rounded" id ="acceso" style="width:250px; height:130px">
        <?php include "accesoCliente2_recordar.php" ?>

      </div> 
      <p></p>
      <p align="right"><em>Podr&aacute;s exponer tus servicios a   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /> todos los asistentes de la WEB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</em></p>
      <br />

      <div style=" display:inline-block">
        <div style="float:left; width:20px">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div> 
        <div style="float:left; width:20px">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
         <div  style="float:left;width:185px;height:126px; padding-top:7px " align="center" >
		      <img src="../images/linea_c2.PNG" width="185px" height="126px" />
        </div>
        <!--
		    <div class="rounded" style="background-color:#9C0;float:left;width:185px;height:126px; padding-top:3px " align="center"  >
            -->
             <div id ="moopio1" class="rounded" align="center"  >
            <em>COMO PROVEEDOR</em>
		 	    <a href="../proveedores/menu_g_p4.php?go=0">
                <img src="../images/poma.png" width="163" height="102" /></a>
        </div>
        <div style="float:left; width:50px; padding-top:20px">
          <img src="../images/linea_h.PNG" width="50" height="80px" />
        </div>
		<div class="rounded" style="background-color:#9C0;float:left;width:185px;height:126px; padding-top:7px " align="center">
        	<img src="../images/gente_corro.PNG" width="163" height="120" />
   	  	</div>
    
      
      <div style=" display:inline-block">
        <div class="rounded" style="background-color:#9C0;float:left;width:185px;height:126px; padding-top:7px " align="center"  >
          
        	<img src="../images/professionales.PNG" width="159" height="115" />
         </div>
        <div style="float:left; width:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div style="float:left; width:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
		    <div style="float:left; width:400px;padding-top:50px" >
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <em>El gestor de descuento te hará más competitivo</em>
        </div>
        <div style="float:left; width:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
      </div>
      

      <div style=" display:inline-block">
        <div style="float:left; width:20px">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div style="float:left; width:20px">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div> 
        <div  style="float:left;width:185px;height:126px; padding-top:0px " align="center"  >
          <img src="../images/linea_c2_i.PNG" width="185px" height="126px" />
        </div>
		    <div class="rounded" id ="moopio2" align="center" >
            <em>COMO PROFESIONAL</em>
            	<a href="../clientes/menu_g_c4.php?go=0">
		 	    <img src="../images/poma.png" width="163" height="101" />
                </a>
        </div>
		    <div style="float:left; width:50px; padding-top:25px">
          <img src="../images/linea_h.PNG" width="50" height="80px" />
        </div>
		    <div class="rounded" style="background-color:#9C0;float:left;width:185px;height:126px; padding-top:7px " align="center">
          <img src="../images/productos.png" width="163" height="120" />
        </div>
      </div>
      <p align="right">
        <em>
          Localizarás materiales para tu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
          trabajo y además para tus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br> 
          hobbys o compras cotidianas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          y TODO CON DESCUENTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </em>
       </p>  
    </div>  
  
     <p> <a href="https://twitter.com/gesdescCom/" target="_blank"><img src="../images/twitter.jpg" width="68" height="65" alt="twitter" /></a>
    <a href="https://www.facebook.com/pages/GesdescCom/482595125192295/" target="_blank"><img src="../images/facebook.jpg" width="68" height="65" alt="facebook" /></a>
    <span style="background-color:#666; color: #aacc00">Para más información envie un correo a gestion@gesdesc.com</span>
    </p>
 </div>
</body>
</html>