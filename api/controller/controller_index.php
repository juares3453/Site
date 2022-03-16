<?php

class IndexController {

	public function RetornoMensagem($x,$a) {
		if($x == '11'){
			return '<h5><b>* Senha incorreta</b></h5>';
		} else if ($x == '22'){
			return '<h5><b>* Usuário inválido</b></h5>';
		} else if ($x == '33'){
			return '<h5><b>* Sua sessão expirou ! Faça o login novamente.</b></h5>';
		} else if($x == '44'){
			return '<h5><b>* Usuário bloqueado, aguarde 2 minutos para uma nova tentativa.</b></h5>';
		} else if ($x == '55' && $a != 0){
			return '<h5><b>* Senha incorreta. Número de tentativas restantes: '.$a.'</b></h5>';
		} else if ($x == '66'){
			return '<h5><b>* Usuário ou CNPJ / CPF inválidos</b></h5>';
		} else if ($x == '77'){
			return '<h5 class="sucesso"><b>* Solicitação de novo usuário concluída, aguarde retorno por e-mail.<b/></h5>';
		} else if ($x == '88'){

			$mascara = explode("@", $a);

			$part1Email = $mascara[0];
			$part2Email = $mascara[1];

			$quantidadeCarac = strlen($part1Email); 
			$inicio = $quantidadeCarac / 4; 
			$inicioString = substr($part1Email, 0, $inicio); 
			$restanteString = str_replace($inicioString, "", $part1Email); 
			$restanteString = preg_replace( "/[^0-9_-]/", "*", $restanteString); 

			$quantidadeCarac2 = strlen($part2Email);
			$finalParte2 = substr($part2Email, 2, $quantidadeCarac2);
			$inicioParte2 = str_replace($finalParte2, "", $part2Email);
			$inicioParte2 = preg_replace( "/[^0-9_-]/", "*", $inicioParte2);
			$emailNovo = $inicioString.$restanteString."@".$inicioParte2.$finalParte2;

			return '<h5 class="sucesso">* E-mail enviado para <b>'.$emailNovo.'</b>, verifique sua caixa de entrada/spam !</h5>';

		} else if ($x == '99'){
			return '<h5><b>* Por favor, confirme o captcha.</b></h5>';
		} else if ($x == '111'){
			return '<h5><b>* CPNJ não cadastrado, <u><a href="novo_usuario">clique aqui</a></u> para solicitar um cadastro.</b></h5>';
		} else {
			header("Location: index");
		}
	}
}

