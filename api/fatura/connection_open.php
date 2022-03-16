<?php

$dbtype = "sqlsrv";
$dbhost = "10.0.0.14";
$dtbase = "SOFTRAN_RASADOR";
$dbname = "softran";
$dbpass = "sof1209";

try {

	$conn = new PDO("$dbtype:Server=$dbhost;Database=$dtbase","$dbname","$dbpass");

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {

	die ("Erro na conexao com o banco de dados: ".$e->getMessage());

}
