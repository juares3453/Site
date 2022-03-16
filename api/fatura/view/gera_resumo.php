<?php

require '../vendor/autoload.php';

include '../connection_open.php';
include '../controller/controller.php';
include '../dao/dao.php';
include '../modal/modal.php';

$class = new Controller($conn);

echo $CdTipo = $_POST['CdTipo'];
echo $CdEmpresa = $_POST['CdEmpresa'];
echo $NrFatura = $_POST['NrFatura'];
echo $CdInscricao = $_POST['CdInscricao'];
echo $CdParcela = $_POST['CdParcela'];

ob_start();

?>

<html>
<head>
	<meta charset="utf-8">
	<title>Resumo Fatura <?php echo $NrFatura; ?></title>

	<link rel="stylesheet" type="text/css" href="../assets/foundation-5/css/foundation.css" />
	<link rel="stylesheet" type="text/css" href="../assets/css/envia.css" />
</head>
<body>

	<?php

	$frete = 0;
	$contDoc = 0;

	foreach($class->ListaDetalheFatura($CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao) as $dados) {

		$contDoc++;
		$CdDoc[0] = 0;

		$CdDoc[$contDoc] = $dados->getCdDocumento();

		$cliente = $dados->getCliente();
		$fatura = $dados->getCdFatura();

		if(!empty($dados->getNrNFSe())){
			$nrnfe = $dados->getNrNFSe();
		}

		$dtFat = $dados->getDtFatura();
		$vlFat = number_format($dados->getVlTtlFatura(),2,',','.');
		$vlSaldo = number_format($dados->getVlSaldo(),2,',','.');
		$dtVenc = $dados->getDtVencimento();

		if($CdDoc[$contDoc] != $CdDoc[$contDoc-1]){
			$frete += $dados->getVlFrete();
		}

	}

	if(!empty($dados->getNrNFSe())) {

		?>

		<div class="row">
			<fieldset>
				<b>Cliente: </b><?php echo $cliente; ?> - <b>Fatura: </b><?php echo $fatura; ?> - <b>NFSe: </b><?php echo $nrnfe; ?><br>
				<b>Data de Emissão: </b><?php echo $dtFat; ?> - 
				<b>Data de Vencimento: </b><?php echo $dtVenc; ?><br>
				<b>Valor Fatura: </b><?php echo $vlFat; ?>
				<b>Saldo Fatura: </b><?php echo $vlSaldo; ?>
				<b>Valor Frete: </b><?php echo number_format($frete,2,',','.'); ?><br>
			</fieldset>
		</div>

		<?php

	} else {

		?>

		<div class="row">
			<fieldset>
				<b>Cliente: </b><?php echo $cliente; ?> -
				<b>Fatura: </b><?php echo $fatura; ?><br>
				<b>Data Emissão: </b><?php echo $dtFat; ?> -
				<b>Data Vencimento: </b><?php echo $dtVenc; ?><br>
				<b>Valor Fatura: </b><?php echo $vlFat; ?> -
				<b>Saldo Fatura: </b><?php echo $vlSaldo; ?> -
				<b>Valor Frete: </b><?php echo number_format($frete,2,',','.'); ?><br>
			</fieldset>
		</div>

		<?php

		if ($frete != 0) {

			$cont = 0;
			$TotalCTe = 0;
			$TotalMercadoria = 0;
			$TotalPeso = 0;
			$TotalVolume = 0;
			$TotalTaxa = 0;
			$TotalSeguro = 0;
			$TotalTRT = 0;
			$TotalArmazenagem = 0;
			$TotalFrete =0;

			foreach($class->ListaDetalheFatura($CdTipo,$NrFatura,$CdEmpresa,$CdParcela,$CdInscricao) as $dados) {

				$cont++;

				$TotalCTe = $cont++;
				$TotalMercadoria += $dados->getVlMercadoria();
				$TotalPeso += $dados->getQtPeso();
				$TotalVolume += $dados->getQtVolume();
				$TotalTaxa += $dados->getVlTaxa();
				$TotalSeguro += $dados->getVlSeguro();
				$TotalTRT += $dados->getVlTRT();
				$TotalArmazenagem += $dados->getVlArmazenagem();
				$TotalFrete += $dados->getVlFrete();

			}

			?>

			<div class="row">
				<table>
					<thead>
						<tr>
							<th>Documentos</th>
							<th>Vl. Mercadoria</th>
							<th>Peso</th>
							<th>Volume</th>
							<th>Vl. Taxa</th>
							<th>Vl. Seguro</th>
							<th>Vl. TRT</th>
							<th>Vl. Armazenagem</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style='padding: 0px 7px 0px;'><?php echo $TotalCTe; ?></td>
							<td style='padding: 0px 7px 0px;'><?php echo number_format($TotalMercadoria,2,',','.'); ?></td>
							<td style='padding: 0px 7px 0px;'><?php echo number_format($TotalPeso,0,'','.'); ?></td>
							<td style='padding: 0px 7px 0px;'><?php echo $TotalVolume.' KG'; ?></td>
							<td style='padding: 0px 7px 0px;'><?php echo number_format($TotalTaxa,2,',','.'); ?></td>
							<td style='padding: 0px 7px 0px;'><?php echo number_format($TotalSeguro,2,',','.'); ?></td>
							<td style='padding: 0px 7px 0px;'><?php echo number_format($TotalTRT,2,',','.'); ?></td>
							<td style='padding: 0px 7px 0px;'><?php echo number_format($TotalArmazenagem,2,',','.'); ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<?php

		}
	}

	?>

</body>
</html>

<?php

$html = ob_get_clean();

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);

header('Content-Disposition: attachment; filename="Resumo_Fatura_'.$NrFatura.'.pdf"');

$mpdf->Output('php://output');

include 'connection_close.php';

exit();

?>