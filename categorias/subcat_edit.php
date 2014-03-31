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
  $insertSQL = sprintf("INSERT INTO SUBCATEGORIA (CATEGORIA_ID, SUBCAT_NOMBRE) VALUES (%s,%s)",
                       GetSQLValueString($_POST['categoria'], "int"),
                       GetSQLValueString($_POST['SUBCAT_NOMBRE'], "text"));

  mysql_select_db($database_categoria, $categoria);
  $Result1 = mysql_query($insertSQL, $categoria) or die(mysql_error());

  $insertGoTo = "subcat_edit.php";
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

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}

mysql_select_db($database_categoria, $categoria);
$query_Recordset1 = sprintf("SELECT * FROM SUBCATEGORIA where CATEGORIA_ID = %s ORDER BY SUBCAT_NOMBRE", GetSQLValueString($colname_DetailRS1, "int"));
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edicion subcategorias</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" />
</head>
	
<body>
<div align="center"><img  src="../images/logoGesdesc.GIF" width="134" height="41" /></div><br />
<p align="center"  class="cabecera">&nbsp;&nbsp;Categoria</p>
<?php echo "<p align='center' style='color:red'>".$_GET['nombre'] ."</p>";?>
<table class="rounded" align="center">
  <tr class="cabecera">
    <td>SUBCAT_ID</td>
    <td>SUBCAT_NOMBRE</td>
  </tr>
  <?php do { 
  	$cat=$row_Recordset1['CATEGORIA_ID'];
	$subcat=$row_Recordset1['SUBCAT_ID'];
	$nombre=$row_Recordset1['SUBCAT_NOMBRE'];
   ?>
    <tr>
    <td><?php echo $subcat; ?>&nbsp; </td>
      <td title="Editar SUBCATEGORIA">
	  <a href="modificar_sub.php?cat=<?=$cat?>&amp;subcat=<?=$subcat?>&amp;nombre=<?=$nombre?>"><?php echo $nombre; ?>&nbsp; </a>
      </td>
	  <tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<br />
<table border="0" align="center" >
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">[Primero]</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">[Anterior]</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">[Siguiente]</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">[Último]</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
<p align="center">Registros <?php echo ($startRow_Recordset1 + 1) ?>
 a <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?>
 de <?php echo $totalRows_Recordset1 ?></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" class="rounded">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">SUBCAT_NOMBRE:</td>
      <td><input type="text" name="SUBCAT_NOMBRE" value="" size="32" /></td>
      
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar subcategoría" /></td>
    </tr>
  </table>
  <input type="hidden" name="categoria" value=<?=$colname_DetailRS1?> />
  <input type="hidden" name="MM_insert" value="form1" />
 
</form>

 <p align="center"> <a href="subcat_insert.php">Inicio</a>>><a href='javascript:history.back()'>Volver</a><p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
