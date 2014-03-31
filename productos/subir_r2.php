<?php
$uploadedfileload="true";
$uploadedfile_size=$_FILES['uploadedfile'][size];

echo $_FILES[uploadedfile][name];
if ($_FILES[uploadedfile][size]>1000000)
{
	$msg=$msg." <br> El archivo es mayor que 1MB, debes reducirlo antes de subirlo<BR>";
	$uploadedfileload="false";
}
//echo "<br>". $_FILES[uploadedfile][type];
/*
if (!($_FILES[uploadedfile][type] =="image/jpeg" OR $_FILES[uploadedfile][type] =="image/gif" or 
$_FILES[uploadedfile][type] =="application/pdf"))
{
	$msg=$msg." Tu archivo tiene que ser PDF. Otros archivos no son permitidos<BR>";
	$uploadedfileload="false";
}
*/

if (!($_FILES[uploadedfile][type] =="application/pdf"))
{
	$msg=$msg." Tu archivo tiene que ser PDF. Otros archivos no son permitidos<BR>";
	$uploadedfileload="false";
}
$nombre=$_FILES[uploadedfile][name];
$partes_nombre = explode('.', $nombre);
$extension = end( $partes_nombre );
//$file_name=$_FILES[uploadedfile][name];
//$add="../uploads/$file_name";
$dni="37268627W";
$idProducto="123AC";
$file_name=$dni ."_".$idProducto;
$add="../uploads/" .$file_name .".". $extension;

//echo "<br>".$add;
if($uploadedfileload=="true"){
	if(move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add)){
		echo "<br>Ha sido subido satisfactoriamente";
	}
	else{
		echo "<br>Error al subir el archivo";
	}

}else{
	echo $msg;
}
?>
<p style="color:#F00"></p>
