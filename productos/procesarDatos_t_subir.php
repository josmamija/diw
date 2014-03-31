<?php

if (isset($_POST['accion'])) { 
	header("Content-type: text/html; charset=utf-8"); 
	 $miNIF = $_POST['nif'];
	include ("../Funciones/funciones.php"); 
    include ("../Conexiones/conexion_local.php");
	//response.write sDestino
  		$strSQL;
 		$enllac = mysql_connect($servidor,$usuari,$contrasenya);
 		mysql_select_db($baseDatos,$enllac);
		mysql_set_charset('utf8');
		// Obtener un password de 8 caracteres 
  		if ($_GET['modo'] == "ALTA") {
			$idProveedor = $_POST['id_proveedor'];
			$codProducto= $_POST["id_fabrica"]; // de momento ponemos el mismo que el id de fabrica
			$codProducto = str_replace(' ', '', $codProducto);
			$idcat=$_POST['categoria'];
			$idsubcat=$_POST['subcategoria'];
			$nombre =$_POST['nombre'];
 			$_SESSION['UrlDestino']="makeselect3_alta.php";
			$pneto =  round(($_POST["pvp"] * (100- $_POST["descuento"]))/100,3);
			$pneto_m = round( ($_POST["pvp"] * (100- $_POST["descuento_m"]))/100,3);
			$strSQL = "insert into PRODUCTO ";
			$strSQL = $strSQL . "(COD_PRODUCTO,NIF,ID_PROVEEDOR,ID_FABRICA,COD_ALMACEN,CATEGORIA_ID,SUBCAT_ID,MARCA,DESCRIPCION,PVP,MAX_U_DES,DESCUENTO, EXISTENCIAS,LINK,P_NETO_1,P_NETO_M)";
			$strSQL = $strSQL . " values (" ;
			$strSQL = $strSQL . "'" . $codProducto ;
			$strSQL = $strSQL . "','" . $miNIF ;	
			$strSQL = $strSQL . "','" . $idProveedor;
			$strSQL = $strSQL . "','" . $codProducto;
			$strSQL = $strSQL . "','" . str_replace(' ', '',$_POST["cod_almacen"]) . "','" . $idcat ;
			$strSQL = $strSQL . "','" . $idsubcat . "','" . $_POST["marca"] ;
			//$strSQL .= "','" . GetSQLValueString(trim($_POST['descripcion']), "text")  . "','" . $_POST["pvp"];
			$strSQL = $strSQL . "','" . trim($_POST["descripcion"]) . "','" . $_POST["pvp"];
			$strSQL = $strSQL . "','" . $_POST["max_u_des"];
			$strSQL = $strSQL . "','" . $_POST["descuento"] ;
			$strSQL = $strSQL . "','" . $_POST["existencias"] ;
			$strSQL = $strSQL . "','" . $_POST["link"] ;
			$strSQL = $strSQL . "','" . $pneto;
			$strSQL = $strSQL . "','" . $pneto_m . "')" ;
    		$resultat = mysql_query($strSQL, $enllac);
			if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
    		echo "<br>Producto dado ALTA<br>"; 
			
			
			//header("Localtion:../includes/menu_prov.php?unif=$miNIF");
			echo "<div align='left'><a href='../proveedores/menu_prov.php?unif=$miNIF&idProveedor=$idProveedor'>Volver</a>  </div>";
			exit();			
		}
		elseif ($_GET['modo'] == "MODIFICAR") { 
		    $modificado =1;
			$desc= GetSQLValueString($_POST['descripcion'], "text");
		    $idProveedor = $_POST['id_proveedor'];
		    $pneto =  round(($_POST["pvp"] * (100- $_POST["descuento"]))/100,3);
			$pneto_m = round( ($_POST["pvp"] * (100- $_POST["descuento_m"]))/100,3);
    		$_SESSION['UrlDestino']="modificar_t.php?unif=".$miNIF;
    		$strSQL = "update PRODUCTO set ID_FABRICA =" . "'" . $_POST["id_fabrica"] . "',";
			$strSQL = $strSQL . "COD_ALMACEN = " . "'" . $_POST["cod_almacen"] . "',";
			$strSQL = $strSQL . "COD_PRODUCTO = " . "'" . $_POST["id_fabrica"] . "',";  
			$strSQL = $strSQL . "CATEGORIA_ID = " . "'" . $_POST["categoria"] . "',";
			$strSQL = $strSQL . "SUBCAT_ID = " . "'" . $_POST["subcategoria"] . "',";
			$strSQL = $strSQL . "MARCA = " . "'" . $_POST["marca"] . "',";
			$strSQL = $strSQL . "DESCRIPCION = " . "'" . trim($_POST["descripcion"]) . "',";
			//$strSQL .=  "DESCRIPCION = " . "'" . $desc  . "'," ;
			$strSQL = $strSQL . "LINK = " . "'" . $_POST["link"] . "',";			
			$strSQL = $strSQL . "PVP = " . "'" . $_POST["pvp"] . "',";
			$strSQL = $strSQL . "MAX_U_DES = " . "'" . $_POST["max_u_des"] . "',";
			$strSQL = $strSQL . "DESCUENTO = " . "'" . $_POST["descuento"] . "',";
			$strSQL = $strSQL . "P_NETO_1 = " . "'" . $pneto. "',";
			$strSQL = $strSQL . "P_NETO_M = " . "'" . $pneto_m . "',";
			$strSQL = $strSQL . "MODIFICADO = " . "'" . $modificado . "',";
			$strSQL = $strSQL . "EXISTENCIAS = " . "'" . $_POST["existencias"] . "'";	
					
			$strSQL = $strSQL . " where NIF = '" .  $miNIF . "' and ID_FABRICA = '" . $_POST['id_fabrica'] . "'" ; 
			$resultat = mysql_query($strSQL, $enllac);
			if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
			
			/*
			echo "<br>Producto Modificado con exito<br>"; 
			echo "<div align='left'><a href='../proveedores/menu_prov.php?unif=$miNIF&idProveedor=$idProveedor'>Volver</a>  </div>";
			exit();	
			*/
			header("Localtion:../proveedores/menu_prov.php?unif=$miNIF&idProveedor=$idProveedor");		
		}
	}
    elseif (isset($_POST['borrar'])) {
			include ("../Conexiones/conexion_local.php");
			$miNIF = $_POST['nif'];
			$idProveedor = $_POST['id_proveedor'];
	      	$_SESSION['UrlDestino']="SelecModi_t.php?unif=".$miNIF;
			$enllac = mysql_connect($servidor,$usuari,$contrasenya);
			mysql_select_db($baseDatos,$enllac);
			$strSQL = "delete from PRODUCTO where NIF = '" .  $miNIF . "' and ID_FABRICA = '" . $_POST['id_fabrica'] . "'" ;
			$resultat = mysql_query($strSQL, $enllac);
			if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
			echo "<br>Producto eliminado con exito<br>"; 
			echo "<div align='left'><a href='../proveedores/menu_prov.php?unif=$miNIF&idProveedor=$idProveedor'>Volver</a>  </div>";
			exit();		
}

?> 
