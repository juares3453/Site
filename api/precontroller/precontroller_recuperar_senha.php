<?php

include '../connection_open_email.php';

include '../connection_open.php';
include '../dao/DAO_login.php';
include '../modal/modal_login.php';
include '../controller/controller_login.php';

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

	<form action="../recuperar_senha" method="POST" accept-charset="utf-8" name="captcha">
		<input type="hidden" name="code" value="99">
	</form>

	<script language="JavaScript">document.captcha.submit();</script>

	<?php

	exit();

}

$class = new LoginController($conn);

$cnpj = $_POST['cnpj'];
$cnpjModificado = str_replace(".", "", $cnpj);
$cnpjModificado = str_replace("/", "", $cnpjModificado);
$cnpjModificado = str_replace("-", "", $cnpjModificado);


foreach($class->ListaSenhaUsuario($cnpjModificado) as $dados){
	$email = $dados->getDsEmail();
}

if(isset($email)){

	//Cria hash
	$hash = md5(rand());
	//Insert na tabela
	$class->InsertRecuperaSenha($cnpjModificado,$hash);

	//Envia email
	$mail->From = "portal@rasador.com.br";
	$mail->FromName = "Transportes Rasador LTDA";

	$mail->AddAddress($email);

	$mail->IsHTML(true);

	$mail->Subject = "Recuperar Senha - Portal Transportes Rasdor";

	$mensagem[] = "

	Olá, você solicitou uma nova senha para o cnpj <b>".$cnpj."</b> ? <br><br>

	Se sim, <a href='http://10.0.50.234/Site/altera_senha_ex?hash=".$hash."'>clique aqui</a> para altera-lá. <br><br>

	Caso você não tenha solicitado a recuperação de senha, favor ignore este e-mail. <br><br>

	Atenciosamente, <br>
	Transportes Rasador LTDA <br><br>

	<small>Este é um e-mail automático, favor não respondê-lo.</small>

	";

	//Monta a Mensagem
	$mail->Body = implode("",$mensagem);

	//Envia o email
	$mail->Send();

} else {

	?>

	<form action="../recuperar_senha" method="POST" accept-charset="utf-8" name="recuperar_senha">
		<input type="hidden" name="code" value="111">
	</form>

	<script language="JavaScript">document.recuperar_senha.submit();</script>

	<?php
}

?>

<form action="../recuperar_senha" method="POST" accept-charset="utf-8" name="recuperar_senha">
	<input type="hidden" name="code" value="88">
	<input type="hidden" name="valor" value="<?php echo $email; ?>">
</form>

<script language="JavaScript">document.recuperar_senha.submit();</script>