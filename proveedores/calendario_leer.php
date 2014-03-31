<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<? 
function retornapascua($year){
	if (($year <= 325) or ($year > 4099)){
		$dia=0;
		$mes=0;
	}else {
		list($jDay,$jMonth)=EasterJulian($year);
		if (($year > 325) && ($year <= 1582)) {
			$dia=$jDay;
			$mes=$jMonth;
		}
		else {
			list($oDay,$oMonth)=EasterOrthodox ($year, $jDay, $jMonth);
			list($wDay,$wMonth)=EasterWestern ($year);
			if ($year <= 1923) { 
				$dia=$wDay;
				$mes=$wMonth;
			}	
			else {
				$dia=$wDay;
				$mes=$wMonth;
			}
		}
	}
	return array($dia,$mes);
}

function IntDiv ($num, $dvsr)
{
	$negate = 0;
	$result = 0;
	if ($dvsr == 0)	return null;
	else {
		if ($num * $dvsr < 0 ) $negate = 1;
		if ($num < 0) $num = -$num;
		if ($dvsr < 0) $dvsr = -$dvsr;
		$result = (($num - ($num % $dvsr)) / $dvsr);
		if ($negate) return -$result;
		else
			return $result;
	}
}

function GetMonth($m)
{
	switch($m){
		case 3:
			return ("Marzo");
			break;
		case 4:
			return ("Abril");
			break;
		case 5:
			return ("Mayo");
			break;
	}
}

function GetOrdinal($d)
{
	$rmdr = $d % 10;
	if ((($d >= 4) and ($d <= 20)) or ($rmdr == 0) or ($rmdr > 3))
		return ($d + "th");
	else {
		switch($rmdr){
			case 1:
				return ($d + "st");
				break;
			case 2:
				return ($d + "nd");
				break;
			case 3:
				return ($d + "rd");
				break;
		} 
	}
}

function EasterJulian($year){
	$g = $year % 19;
	$i = (19 * $g + 15) % 30;
	$j = ($year + IntDiv($year, 4) + $i) % 7;
	$p = $i - $j + 28;
	
	$jDay = $p;
	$jMonth = 4;
	if ($p > 31)
	$jDay = $p - 31;
	else
	$jMonth = 3;
	return array($jDay,$jMonth);
}

function EasterWestern($year)
{
	$g = $year % 19;
	$c = IntDiv($year, 100);
	$h = ($c - IntDiv($c, 4) - IntDiv(8 * $c + 13, 25) + 19 * $g + 15) % 30;
	$i = $h - IntDiv($h, 28) * (1 - IntDiv($h, 28) * IntDiv(29, $h + 1) * IntDiv(21 - $g, 11));
	$j = ($year + IntDiv($year, 4) + $i + 2 - $c + IntDiv($c, 4)) % 7;
	$p = $i - $j + 28;
	
	$wDay = $p;
	$wMonth = 4;
	if ($p > 31)
	$wDay = $p - 31;
	else
	$wMonth = 3;
	return array($wDay,$wMonth);
}

function EasterOrthodox ($yr, $jDay, $jMonth)
{
	$extra = 0;
	$tmp = 0;
	
	$oDay = 0;
	$oMonth = 0;
	
	if (($yr > 1582) && ($yr <= 4099)) {
		$extra = 10;
		if ($yr > 1600) {
			$tmp = IntDiv($yr, 100) - 16;
			$extra = $extra + $tmp - IntDiv($tmp, 4);
		}

		$oDay = $jDay + $extra;
		$oMonth = $jMonth;

		if (($oMonth == 3) && ($oDay > 31)) {
			$oMonth = 4;
			$oDay = $oDay - 31;
		}

		if (($oMonth == 4) && ($oDay > 30)) {
			$oMonth = 5;
			$oDay = $oDay - 30;
		}
	}
	return array($oDay,$oMonth);
}

function domingopascua($Y) {
	$N = $Y-1900;
	$Y1 = $N/19;
	$A=floor(($Y1-floor($Y1))*19+0.001);
	$B1=(7*$A+1)/19;
	$B=floor($B1);
	$M1=(11*$A+4-$B)/29;
	$M=floor(($M1-floor($M1))*29+0.001);
	$Q1=$N/4;
	$Q=floor($Q1);
	$W1=($N+$Q+31-$M)/7;
	$W=floor(($W1-floor($W1))*7+0.001);
	$R=25-$M-$W;
	$P = $R;
	if ($R<=0) $P = 31 + $R;
	$N=4;
	if ($R<=0) $N=3;
	$dia = $P;
	$mes = $N;
	return array($dia,$mes);
}

function CalendarioPHP($year, $month, $day_heading_length = 3){
	global $unif;
	$nombreFichero = basename($_SERVER['PHP_SELF']); 
	$ColorFondoCelda = '#CCCCCC'; 
	//$ColorFondoTabla = '#666666';
	$ColorFondoTabla = 'Honeydew'; 
	$ColorFondoCeldasDiaSemana = '#fff4bf'; 
	$ColorFondoCeldasFestivo = '#ee0000'; 
	$ColorFondoCeldasFinDeSemana = '#110000'; 
	$ColorFondoCeldaDiaActual = '#00ff00'; 
	//$ColorDiaLaboral = '#444444'; 
	$ColorDiaLaboral = 'Gray'; 
	//$ColorDiaFestivo = '#ffffff';
	$ColorDiaFestivo = 'red'; 
	//$ColorDiaFinDeSemana = '#ffff00'; 
	$ColorDiaFinDeSemana = 'green'; 
	$ColorDiaActual = '#0000ff';
	 
	$TamanioFuente = '2'; 
	$TipoFuente = 'Arial, Helvetica, sans-serif'; 
	$AnchoCalendario = '1%'; 
	$AltoCalendario = '1%'; 
	$AnchoCeldas = '1%'; 
	$AltoCeldas = '1%'; 
	$AlineacionHorizontalTexto = 'center'; 
	$AlineacionVerticalTexto = 'center'; 
	
	// ----------- INICIO Dias Festivos ---------- 
	include ("../Conexiones/conexion_local.php");
	$enllac = mysql_connect($servidor,$usuari,$contrasenya);
	mysql_select_db($baseDatos,$enllac);
	
	$strSQL = "select * from calendario where MONTH(FECHA)= $month  and YEAR(FECHA) = $year AND NIF ='".$unif."'";
	$resultat = mysql_query($strSQL, $enllac);
	if (!$resultat)  die('Error: ' . mysql_error());
	$i=0;
    while($fila=mysql_fetch_assoc($resultat)){
		$hoy =date("d",strtotime($fila['FECHA']));
		$DiasFestivos[$i++]=date("j/n",mktime(0,0,0,$month,$hoy,$year));
		
	}		
	mysql_close($enllac);
	/*
	$DiasFestivos[0] = '1/1'; // 1 de enero 
	$DiasFestivos[1] = '6/1'; // 6 de enero 
	$DiasFestivos[2] = '19/3'; // 19 de marzo 
	$DiasFestivos[3] = '1/5'; // 1 de mayo 
	$DiasFestivos[4] = '15/8'; // 15 de agosto 
	$DiasFestivos[5] = '12/10'; // 12 de octubre 
	$DiasFestivos[6] = '1/11'; // 1 de noviembre 
	$DiasFestivos[7] = '6/12'; // 6 de diciembre 
	$DiasFestivos[8] = '25/12'; // 25 de diciembre 
	
	// festivos Regionales 
	$DiasFestivos[9] = '2/5'; // 2 de mayo 
	$DiasFestivos[10] = '15/5'; // 15 de mayo 
	$DiasFestivos[11] = '9/9'; // 9 de noviembre 
	*/
	
	// Semana Santa 
	list($diampas,$mespas)=retornapascua($year);
	$juevessant = date("j/n",mktime (0,0,0, $mespas, $diampas-3, $year)); 
	$viernessant = date("j/n",mktime (0,0,0, $mespas, $diampas-2, $year));
	$DiasFestivos[$i++] = $juevessant; // Jueves Santo 
	$DiasFestivos[$i++] = $viernessant; // Viernes Santo 
	
	$dia_actual=date("j",time()); 
	$mes_actual=date("n",time()); 
	$anio_actual=date("Y",time()); 
	$first_of_month = mktime (0,0,0, $month, 1, $year); 
	
	static $day_headings = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'); 
	$maxdays = date('t', $first_of_month);
	$date_info = getdate($first_of_month);
	$month = $date_info['mon']; 
	$year = $date_info['year']; 
	switch ($date_info['mon']) { 
		case 1 : $date_info['month']="Enero";break; 
		case 2 : $date_info['month']="Febrero";break; 
		case 3 : $date_info['month']="Marzo";break; 
		case 4 : $date_info['month']="Abril";break; 
		case 5 : $date_info['month']="Mayo";break; 
		case 6 : $date_info['month']="Junio";break; 
		case 7 : $date_info['month']="Julio";break; 
		case 8 : $date_info['month']="Agosto";break; 
		case 9 : $date_info['month']="Septiembre";break; 
		case 10 : $date_info['month']="Octubre";break; 
		case 11 : $date_info['month']="Noviembre";break; 
		case 12 : $date_info['month']="Diciembre";break; 
	}; 

	$calendar = ("<table class='rounded'"). 
	("border='0' "). 
	("height='".$AltoCalendario."' "). 
	("width='".$AnchoCalendario."' "). 
	("cellspacing='1' cellpadding='2' "). 
	("bgcolor='".$ColorFondoTabla."'> "); 

	$calendar .= ("<tr> "). 
	("<th height='".$AltoCeldas."' colspan='7'>"). 
	("<font color='".$ColorDiaFestivo."' size=".$TamanioFuente." face='".$TipoFuente."'>"). 
	("$date_info[month], $year"). 
	("</font>"). 
	("</th> </tr> "); 

	if($day_heading_length > 0 and $day_heading_length <= 4){ 
		$calendar .= "<tr> "; 
		foreach($day_headings as $day_heading){ 
			$calendar .= ("<th height='".$AltoCeldas."' abbr='".$day_heading."' class='dayofweek' bgcolor='".$ColorFondoCeldasDiaSemana."'>"). 
			("<font color='".$ColorDiaLaboral."' size='".$TamanioFuente."' face='".$TipoFuente."'>"). 
			($day_heading_length != 4 ? substr($day_heading, 0, $day_heading_length) : $day_heading). 
			("</font>"). 
			("</th> "); 
		} 
		$calendar .= "</tr> "; 
	} 
	$calendar .= "<tr> "; 
	
	$weekday = $date_info['wday']; //Para que sea el Domingo el primer dia de la semana 
	//$weekday = $date_info['wday']-1;
	if ($weekday==-1) $weekday=6;
	$day = 1; #starting day of the month 
	
	if($weekday > 0){ 
		$calendar .= ("<td bgcolor='".$ColorFondoTabla). 
		("' colspan='".$weekday."'></td> "); 
	} 

	while ($day <= $maxdays){ 
		if($weekday == 7){
			$calendar .= "</tr> <tr> "; 
			$weekday = 0; 
		}
		$esFestivo = 0; 
		$tmp_date=$day."/".$month; 
		for ($j=0;$j<$i;$j++) { 
			if ($tmp_date==$DiasFestivos[$j]) {$esFestivo=1;break;} 
		} 
	
		$calendar .= ("<td width='".$AnchoCeldas). 
		("' height='".$AltoCeldas). 
		("' align='".$AlineacionHorizontalTexto). 
		("' valign='".$AlineacionVerticalTexto). 
		("' "); 
	
		
		if (($day==$dia_actual) and ($month==$mes_actual) and ($year==$anio_actual)) {
			$calendar .= $ColorFondoCeldaDiaActual; 
		} else { 
			if (($esFestivo==1)) {
				$calendar .= $ColorFondoCeldasFestivo;
			} else { 
				if (($weekday == 0) or ($weekday == 6)) { 
					$calendar .= $ColorFondoCeldasFinDeSemana;
				} else {
					$calendar .= $ColorFondoCelda; 
				}
			}; 
		}; 
		
		//$fechalink = date("d/m/Y",mktime (0,0,0, $month, $day, $year)); 
		$fechalink=date("Y-m-d",mktime (0,0,0, $month, $day, $year));
		//$link = (basename($_SERVER["PHP_SELF"]))."?anoactual=$year&mesactual=$month&fecha=".$fechalink; 
		
		//$link = "procesarDiasFestivos.php?esFestivo=$esFestivo&anoactual=$year&unif=$unif&mesactual=$month&fecha=".$fechalink; 
		$calendar .= "'><font color='"; 
	if (($day==$dia_actual) and ($month==$mes_actual) and ($year==$anio_actual)) {
			$calendar .= $ColorDiaActual; 
		} else {
			if ($esFestivo==1){
				$calendar .= $ColorDiaFestivo; 
			} else {
				if (($weekday == 0) or ($weekday == 6)) {
					$calendar .= $ColorDiaFinDeSemana; 
				}else{
					$calendar .= $ColorDiaLaboral;
				}	
			}; 
		}; 
		$calendar .= ("' "). 
		("size='".$TamanioFuente."' "). 
		("face='".$TipoFuente."'><strong>".$day). 
		("</strong></font>").("</td> "); 
		$day++; 
		$weekday++; 
	} 

	if($weekday != 7){ 
		$calendar .= '<td bgcolor="'.$ColorFondoTabla.'" colspan="' . (7 - $weekday) . '"></td>'; 
	} 
	/*
	$calendar .= "</tr> "; 
	$calendar .= "<tr>";
	$calendar .= "<td align='center' valign='center' colspan='7'>";
	$calendar .= "<form method='GET' action='../proveedores/menu_prov.php' name='calendario' target='_self'>";
	$calendar .= "<p><input type='submit' value='< -Mes' name='mesmenos'>";
	$calendar .= "<input type='submit' value='<< -Año' name='anomenos'>";
	$calendar .= "<input type='submit' value='+Año >>' name='anomas'>";
	$calendar .= "<input type='submit' value='+Mes >' name='mesmas'></p>";
	$calendar .= "<input type='hidden' name='anoactual' value='$year'>";
	$calendar .= "<input type='hidden' name='mesactual' value='$month'>";
	$calendar .= "<input type='hidden' name='unif' value='$unif'>";
	$calendar .= "<input type='hidden' name='go' value='6'>";
	$calendar .= "</form>";
	$calendar .= "</td>";
	$calendar .= "</tr> ";
	*/
	$calendar .= "</table> "; 
	return $calendar; 
}

extract($_POST);
extract($_GET);
//print_r($_POST);
//print_r($_GET);
//exit();
//$nif="22222222A";

extract ($_REQUEST);//Esto extrae todas las variables del formulario
if(isset($xml)) {
 $xml1 = "<?xml version='1.0' encoding='utf-8'?>" .$xml;
// Obtener el valor del login que se quiere comprobar
 $xml1 = simplexml_load_string($xml1) or die("Error: Can not create object");
 $unif = $xml1->nif;
}



if(!isset($mesactual)) $mesactual=date("n",time());
if ($mesactual==''){
	$mesactual=date("n",time());
}
if(!isset($anoactual)) $anoactual=date("Y",time());
if ($anoactual==''){
	$anoactual=date("Y",time());
}	
$dia_actual=date("d",time());

$mes_actual = date("n",mktime (0,0,0, $mesactual, $dia_actual, $anoactual)); 
$anio_actual = date("Y",mktime (0,0,0, $mesactual, $dia_actual, $anoactual)); 

if(!isset($mesmenos)) $mesmenos="";
if ($mesmenos <>''){
	$mes_actual = date("n",mktime (0,0,0, $mesactual-1, $dia_actual, $anoactual)); 
	$anio_actual = date("Y",mktime (0,0,0, $mesactual-1, $dia_actual, $anoactual)); 
}
if(!isset($mesmas)) $mesmas="";
if ($mesmas <>''){
	
	$mes_actual = date("n",mktime (0,0,0, $mesactual+1, $dia_actual, $anoactual)); 
	$anio_actual = date("Y",mktime (0,0,0, $mesactual+1, $dia_actual, $anoactual)); 
}
if(!isset($anomenos)) $anomenos="";
if ($anomenos <>''){
	$mes_actual = date("n",mktime (0,0,0, $mesactual, $dia_actual, $anoactual-1)); 
	$anio_actual = date("Y",mktime (0,0,0, $mesactual, $dia_actual, $anoactual-1)); 
}
if(!isset($anomas)) $anomas="";
if ($anomas <>''){
	$mes_actual = date("n",mktime (0,0,0, $mesactual, $dia_actual, $anoactual+1)); 
	$anio_actual = date("Y",mktime (0,0,0, $mesactual, $dia_actual, $anoactual+1)); 
}
echo $nombre;
echo CalendarioPHP($anio_actual, $mes_actual, 4);
if($dia_actual>28)echo CalendarioPHP($anio_actual, $mes_actual+1, 4);
?>