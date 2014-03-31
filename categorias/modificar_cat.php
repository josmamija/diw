<?php require_once('../Connections/categoria.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE CATEGORIA SET CATEGORIA_NOMBRE=%s, CATEGORIA_DESC=%s , SERVICIO=%s WHERE CATEGORIA_ID=%s",
                       GetSQLValueString($_POST['CATEGORIA_NOMBRE'], "text"),
                       GetSQLValueString($_POST['CATEGORIA_DESC'], "text"),
					   GetSQLValueString($_POST['SERVICIO'], "int"),
                       GetSQLValueString($_POST['CATEGORIA_ID'], "int"));

  mysql_select_db($database_categoria, $categoria);
  $Result1 = mysql_query($updateSQL, $categoria) or die(mysql_error());

  $updateGoTo = "cat_edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_categoria, $categoria);
$idcat=$_GET['recordID'];
$query_Recordset1 = "SELECT * FROM CATEGORIA where CATEGORIA_ID = $idcat order by CATEGORIA_NOMBRE";
$Recordset1 = mysql_query($query_Recordset1, $categoria) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar categoria</title>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
			<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" />
			<img src="../images/logoGesdesc.GIF" width="134" height="41" /><br />
			<p class="curved-box-css4">&nbsp;&nbsp;Editar categorias</p>
<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="rounded">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">CATEGORIA_ID:</td>
      <td><?php echo $row_Recordset1['CATEGORIA_ID']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">CATEGORIA_NOMBRE:</td>
      <td><input type="text" name="CATEGORIA_NOMBRE" value="<?php echo htmlentities($row_Recordset1['CATEGORIA_NOMBRE'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">CATEGORIA_DESC:</td>
      <td><input type="text" name="CATEGORIA_DESC" value="<?php echo htmlentities($row_Recordset1['CATEGORIA_DESC'], ENT_COMPAT, 'utf-8'); ?>" size="52" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right"></td>
      <?php 
	  $s= htmlentities($row_Recordset1['SERVICIO'], ENT_COMPAT, 'utf-8'); 
	  if ($s==0) {
		  ?>
		  <td><input type="radio" name="SERVICIO" value="0" checked="checked" /> PRODUCTO <BR />
      <input type="radio" name="SERVICIO" value="1"  />SERVICIO</td>
		<?php  
	  }
	  else {
		  ?>
          <td><input type="radio" name="SERVICIO" value="0"  /> PRODUCTO <BR />
      <input type="radio" name="SERVICIO" value="1"  checked="checked" />SERVICIO</td>
      <?php
	  }
	  
	  ?>
      
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="CATEGORIA_ID" value="<?php echo $row_Recordset1['CATEGORIA_ID']; ?>" />
</form>
<br /><a href="../administracion/menu_a.php">Inicio</a>>><a href='javascript:history.back()'>Volver</a>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
