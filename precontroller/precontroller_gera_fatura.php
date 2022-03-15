<?php

$CdTipo = $_GET['CdTipo'];
$NrFatura = $_GET['NrFatura'];
$CdEmpresa = $_GET['CdEmpresa'];
$CdInscricao = $_GET['CdInscricao'];
$CdParcela = $_GET['CdParcela'];

?>

<form action="../fatura/view/gera_detalhamento.php" method="POST" accept-charset="utf-8" name="fatura">
	<input type="hidden" name="CdTipo" value="<?php echo $CdTipo; ?>">
	<input type="hidden" name="NrFatura" value="<?php echo $NrFatura; ?>">
	<input type="hidden" name="CdEmpresa" value="<?php echo $CdEmpresa; ?>">
	<input type="hidden" name="CdInscricao" value="<?php echo $CdInscricao; ?>">
	<input type="hidden" name="CdParcela" value="<?php echo $CdParcela; ?>">
</form>

<script language="JavaScript">document.fatura.submit();</script>