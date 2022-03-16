<?php

include '../connection_open.php';
include '../dao/DAO_login.php';
include '../modal/modal_login.php';
include '../controller/controller_login.php';

$class = new LoginController($conn);

$DsLogin = $_POST['DsLogin'];
$CdInscricao = $_POST['CdInscricao'];

$obj = new LoginModal();
$obj->setInAceiteTermo(1);
$obj->setDsLogin($DsLogin);
$obj->setCdInscricao($CdInscricao);

$class->AtualizaTermo($obj);

header('Location: ../inicio');