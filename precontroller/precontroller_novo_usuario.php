<?php

include '../connection_open_email.php';

if (isset($_POST['g-recaptcha-response'])) {
	$captcha_data = $_POST['g-recaptcha-response'];

	$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdSreMUAAAAAJN-mz3y8M5TvNwb4CeJanozgwqU&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if ($resposta.success) {

	} else {
		header('Location: index');
		exit;
	}
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data) {

	?>

	<form action="../novo_usuario" method="POST" accept-charset="utf-8" name="captcha">
		<input type="hidden" name="code" value="99">
	</form>

	<script language="JavaScript">document.captcha.submit();</script>

	<?php

	exit();

}

$cnpj = $_POST['cnpj'];
$nome = $_POST['nome'];
$email = $_POST['email'];

//Envia email
$mail->From = "portal@rasador.com.br";
$mail->FromName = "Rasador NFe"; // Seu nome

$mail->AddAddress('comercialrs@rasador.com.br');

$mail->IsHTML(true);

$mail->Subject = "Solicitação de novo usuário portal rasador";
$mail->Body = "

Dados da solicitação de <b>novo usuário</b> abaixo:
<br><br>

CNPJ: <b>".$cnpj."</b><br>
NOME: <b>".$nome."</b><br>
EMAIL: <b>".$email."</b><br>

";

//Envia o email
$mail->Send();

?>

<form action="../novo_usuario" method="POST" accept-charset="utf-8" name="novo_usuario">
	<input type="hidden" name="code" value="77">
</form>

<script language="JavaScript">document.novo_usuario.submit();</script>