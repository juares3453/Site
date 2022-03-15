<?php

include '../connection_open.php';
include '../dao/DAO_login.php';
include '../modal/modal_login.php';
include '../controller/controller_login.php';

$cnpj = $_POST['cnpj'];
$usuario = $_POST['usuario'];
$novaSenha = $_POST['senha'];

$class = new LoginController($conn);

$obj = new LoginModal();
$obj->setCdInscricao($cnpj);
$obj->setDsLogin($usuario);
$obj->setDsSenha($novaSenha);

$class->AlteraSenha($obj);

?>

<form action="../altera_senha_ex" method="POST" accept-charset="utf-8" name="altera_senha_ex">
	<input type="hidden" name="code" value="222">
</form>

<script language="JavaScript">document.altera_senha_ex.submit();</script>