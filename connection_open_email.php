<?php

if(basename($_SERVER["PHP_SELF"]) != 'connection_open_email.php'){

	require_once('assets/ClassEmail/class.phpmailer.php');
	require_once('assets/ClassEmail/class.smtp.php');

	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host = "mail.rasador.com.br";
	$mail->Port = 587;
	$mail->SMTPAutoTLS = false;
	$mail->SMTPAuth = true;
	$mail->Username = 'root';
	$mail->Password = 'rgY$raS&049';
	$mail->CharSet = 'UTF-8';

} else {

	header('location: index');
	exit();

}

?>