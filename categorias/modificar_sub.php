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
  $updateSQL = sprintf("UPDATE SUBCATEGORIA SET SUBCAT_NOMBRE=%s WHERE CATEGORIA_ID=%s and SUBCAT_ID=%s",
                       GetSQLValueString($_POST['SUBCAT_NOMBRE'], "text"),
                       GetSQLValueString($_POST['CATEGORIA_ID'], "int"),
                       GetSQLValueString($_POST['SUBCAT_ID'], "int"));
//echo $updateSQL;
//exit();
  mysql_select_db($database_categoria, $categoria);
  $Result1 = mysql_query($updateSQL, $categoria) or die(mysql_error());

  $updateGoTo = "subcat_insert.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
extract($_REQUEST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modificar subcategoria</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" />
</head>
	
<body>
<div align="center"><img  src="../images/logoGesdesc.GIF" width="134" height="41" /></div><br />
<p align="center"  class="cabecera">&nbsp;&nbsp;Editar subcategoria</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="CATEGORIA_ID" value="<?php echo $cat; ?>" />
  <input type="hidden" name="SUBCAT_ID" value="<?php echo $subcat; ?>" />
  <table align="center" class="rounded">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">CATEGORIA_ID:</td>
      <td><?php echo $cat; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SUBCAT_ID:</td>
      <td><?php echo $subcat;?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SUBCAT_NOMBRE:</td>
      <td><input type="text" name="SUBCAT_NOMBRE" value="<?php echo $nombre; ?>" size="52" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  
</form>
<p align="center"><a href='javascript:history.back()'>Volver</a><p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
