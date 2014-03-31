<?php
$directorio_escaneado = scandir('archivos_subidos');
$nombre = $_POST['nombre_archivo'] .".pdf";
$archivos = array();

foreach ($directorio_escaneado as $item) {
    if ($item != '.' and $item != '..') {
		if($item==$nombre) {
        	$archivos[] = $item;
		}
    }
}
echo json_encode($archivos);
//echo json_encode($nombre);
?>
