
<?php
function EnviarCorreo($sDestino,$TextBody,$remitente,$asunto){
//error_reporting(E_ALL);
//error_reporting(E_STRICT);

//date_default_timezone_set('America/Toronto');

require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php
// if not already loaded
$mail  = new PHPMailer();
$mail->CharSet = "UTF-8";
$body  =  $TextBody;
//$body = file_get_contents('contents.html');
//$body             = preg_replace('/[\]/','',$body);
//$body = file_get_contents($Body);
//$body = preg_replace('/[\]/','',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Port          = 465;                    // set the SMTP port for the GMAIL server
$mail->Username      = "framodala@gmail.com"; // SMTP account username
$mail->Password      = "clis1234";        // SMTP account password
$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
/*
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Port          = 25;                    // set the SMTP port 
$mail->Username      = "gestion@gesdesc.com"; // SMTP account username
$mail->Password      = "gesdesc1967";        // SMTP account password
*/

//Indicamos que vamos a conectar por smtp
$mail->Mailer = "smtp";
$mail->Host       = "smtp.1and1.es"; // SMTP server

//Le indicamos que el servidor smtp requiere autenticación
$mail->SMTPAuth = true;
$mail->SMTPDebug  =2;                     // enables SMTP debug information (for testing)
$mail->IsHTML(true); // send as HTML
$mail->SetFrom($remitente, 'GESDESC');
$mail->AddReplyTo("fragaal@josmamija.nixiweb.com","gesdesc");
$mail->Subject    = $asunto;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);

//$address = "framodala@gmail.com";
$address = $sDestino;
$mail->AddAddress($address, "GesDesc");
$mail->AddBCC($remitente); 
//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
//if(!$mail->SmtpSend()) {	
  echo "Mailer Error: " . $mail->ErrorInfo;
  //exit();
} else {
  echo "Mensaje enviado!";
  //header("Location:../clientes/menu_g_c.php");
}
}
?>
