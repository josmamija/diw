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

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_categoria, $categoria);
$query_Recordset2 = "SELECT * FROM CATEGORIA ORDER BY CATEGORIA_NOMBRE";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $categoria) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$nombre=$row_Recordset2['CATEGORIA_NOMBRE'];
if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

$queryString_Recordset2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset2") == false && 
        stristr($param, "totalRows_Recordset2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset2 = sprintf("&totalRows_Recordset2=%d%s", $totalRows_Recordset2, $queryString_Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
 
<head>
<title>Insertar subcategorias</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" />
</head>
	<img src="../images/logoGesdesc.GIF" width="134" height="41" /><br />
	<p class="curved-box-css4">&nbsp;&nbsp;Categorias</p>
<body>
<table border="1" class="rounded">
  <tr class="cabecera">
    <td>CATEGORIA_NOMBRE</td>
    <td>CATEGORIA_DESC</td>
     <td>SERV</td>
  </tr>
  <?php do { ?>
    <tr>
      <td title="Editar categoria">
      <a href="subcat_edit.php?recordID=<?php echo $row_Recordset2['CATEGORIA_ID'];?>&nombre=<?=$row_Recordset2['CATEGORIA_NOMBRE']?>"> <?php echo $row_Recordset2['CATEGORIA_NOMBRE']; ?>&nbsp; </a></td>
      <td><?php echo $row_Recordset2['CATEGORIA_DESC']; ?>&nbsp; </td>
      <td><?php echo $row_Recordset2['SERVICIO']; ?>&nbsp; </td>
    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>

Registros <?php echo ($startRow_Recordset2 + 1) ?> a <?php echo min($startRow_Recordset2 + $maxRows_Recordset2, $totalRows_Recordset2) ?> de <?php echo $totalRows_Recordset2 ?>
<br />
<table border="0"   align="left">
  <tr>
    <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, 0, $queryString_Recordset2); ?>">[Primero]</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, max(0, $pageNum_Recordset2 - 1), $queryString_Recordset2); ?>">[Anterior]</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, min($totalPages_Recordset2, $pageNum_Recordset2 + 1), $queryString_Recordset2); ?>">[Siguiente]</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, $totalPages_Recordset2, $queryString_Recordset2); ?>">[Último]</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
<br />


<br /><a href='../administracion/menu_a.php'>Inicio</a>
>><a href='javascript:history.back()'>Volver</a>
</body>
</html>
<?php
mysql_free_result($Recordset2);
}
?>
