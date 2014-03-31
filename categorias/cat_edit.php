<?php
session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {
?>
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  /*
  $insertSQL = sprintf("INSERT INTO CATEGORIA (CATEGORIA_NOMBRE, CATEGORIA_DESC) VALUES (%s, %s)",
                       GetSQLValueString($_POST['CATEGORIA_NOMBRE'], "text"),
                       GetSQLValueString($_POST['CATEGORIA_DESC'], "text"));
*/

$insertSQL = sprintf("INSERT INTO CATEGORIA (CATEGORIA_NOMBRE, CATEGORIA_DESC, SERVICIO) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['CATEGORIA_NOMBRE'], "text"),
					   GetSQLValueString($_POST['CATEGORIA_DESC'], "text"),
                       GetSQLValueString($_POST['SERVICIO'], "int"));

  mysql_select_db($database_categoria, $categoria);
  $Result1 = mysql_query($insertSQL, $categoria) or die(mysql_error());

  $insertGoTo = "cat_edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_categoria, $categoria);
$query_Recordset1 = "SELECT CATEGORIA_NOMBRE, CATEGORIA_DESC, CATEGORIA_ID, SERVICIO FROM CATEGORIA order by CATEGORIA_NOMBRE";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $categoria) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
			<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" />
			<img src="../images/logoGesdesc.GIF" width="134" height="41" /><br />
			<p class="curved-box-css4">&nbsp;&nbsp;Categorias</p>
<body>
<table border="1" class="rounded" >
  <tr class="cabecera">
    <td>CATEGORIA_NOMBRE</td>
    <td>CATEGORIA_DESC</td>
    <td>SERV</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="modificar_cat.php?recordID=<?php echo $row_Recordset1['CATEGORIA_ID']; ?>">
       <?php echo $row_Recordset1['CATEGORIA_NOMBRE']; ?>&nbsp; </a></td>
      <td><?php echo $row_Recordset1['CATEGORIA_DESC']; ?>&nbsp; </td>
       <td><?php echo $row_Recordset1['SERVICIO']; ?>&nbsp; </td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<br />
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">Primero</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Anterior</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Siguiente</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Último</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
<form action="<?php echo $editFormAction; ?>" method="post" id="form1">
  <table class="rounded">
    <tr valign="baseline">
      <td align="right">CATEGORIA_NOMBRE:</td>
      <td><input type="text" name="CATEGORIA_NOMBRE" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right">CATEGORIA_DESC:</td>
      <td><input type="text" name="CATEGORIA_DESC" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right"></td>
      <td><input type="radio" name="SERVICIO" value="0"  checked="checked"/> PRODUCTO <BR />
      <input type="radio" name="SERVICIO" value="1"  />SERVICIO</td>
    </tr>
    <tr valign="baseline">
      <td align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
Registros <?php echo ($startRow_Recordset1 + 1) ?> a <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> de <?php echo $totalRows_Recordset1 ?>
<br /><a href="../administracion/menu_a.php">Inicio</a>>><a href='javascript:history.back()'>Volver</a>
</body>
</html>
<?php
mysql_free_result($Recordset1);
}
?>
