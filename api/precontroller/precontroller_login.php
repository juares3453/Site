<?php

/**** Validação de login, se o usuário não existe não loga;
Faz validação de hash com a senha digita e compara com a do banco de dados;
Validação de tentativas de login;
Criação da sessão do usuário;
Armazena em tabela de logs os dados da sessão ip e etc. ****/

if(isset($_POST['user']) && isset($_POST['pass'])){
	if(!empty($_POST['user']) && !empty($_POST['pass'])){

		include '../connection_open.php';
		include '../assets/hash.php';
		include '../dao/DAO_login.php';
		include '../modal/modal_login.php';
		include '../controller/controller_login.php';

		$cnpj_form = str_replace(str_split('./-'), '', $_POST['cnpj']); //Cnpj Form Trata os caracteres
		$cnpj_form_cont = strlen($cnpj_form);

		if($cnpj_form_cont == 11){
			$cnpj_form = '000'.$cnpj_form;
		}

		$usuario_form = $_POST['user']; //Usuario do formulario
		$senha_form = $_POST['pass']; //Senha do formulario
		$login = 0;

		$class = new LoginController($conn);

		foreach ($class->ConsultaDadosLoginPortal($usuario_form,$cnpj_form) as $dados){
			//Valida se o usuário existe
			if($usuario_form == $dados->getDsLogin()) {
				//Faz hash da senha
				$hash = Bcrypt::hash($dados->getDsSenha());
				//Valida a senha com hash
				if (Bcrypt::check($senha_form, $hash)) {

					$login = 1;

					//Percorre a tabela de logs
					foreach($class->ConsultaLogsPortal($usuario_form,$cnpj_form) as $dadosLog){

						//Verifica se o usuário existe
						if($dadosLog->getRowCount() < 0){

							//Valida se está ativo
							if($dadosLog->getInAtivo() == 1){

								require_once '../controller/controller_session.php';

								//Cria dados da session
								$id = session::iniciar();
								//session::set_var('hash_id',md5(gethostbyaddr($_SERVER['REMOTE_ADDR'])));
								session::set_var('id_usuario',md5($dadosLog->getID()));
								session::set_var('cnpj',$dados->getCdInscricao());
								session::set_var('ip',$_SERVER['REMOTE_ADDR']);
								session::set_var('data_logado',date('Y-m-d H:i:s'));
								session::set_var('usuario', $dados->getDsLogin());
								session::set_var('id_cnpj', $dados->getID());

								$obj = new LoginModal();
								$obj->setDsLogin($dados->getDsLogin());
								$obj->setCdInscricao($dados->getCdInscricao());
								$obj->setDtUltimoAcesso(date('Y-m-d H:i:s'));
								$obj->setDsEnderecoIp(session::get_var('ip'));
								$obj->setDtUltimaVisita($dadosLog->getDtUltimoAcesso());
								$obj->setCdError(1);
								$obj->setInAtivo(1);

								//Caso já tenha entrado no portal só da o update no time e ip
								$class->UpdateLogs($obj);

								include '../connection_close.php';

								header('Location: inicio');

							} else {

								//Captura a data da ultima tentativa de login
								$dataUltTentativa = $dadosLog->getDtUltimaTentativa().'<br>';

								//Data atual - 2 minutos
								$dataAtual = date('Y-m-d H:i:s',strtotime('-2 minutes'));

								if($dataUltTentativa < $dataAtual){

									require_once '../controller/controller_session.php';

									//Cria dados da session
									$id = session::iniciar();
									//session::set_var('hash_id',md5(gethostbyaddr($_SERVER['REMOTE_ADDR'])));
									session::set_var('id_usuario',md5($dadosLog->getID()));
									session::set_var('cnpj',$dados->getCdInscricao());
									session::set_var('ip',$_SERVER['REMOTE_ADDR']);
									session::set_var('data_logado',date('Y-m-d H:i:s'));
									session::set_var('usuario', $dados->getDsLogin());
									session::set_var('id_cnpj', $dados->getID());

									$obj = new LoginModal();
									$obj->setDsLogin($dados->getDsLogin());
									$obj->setCdInscricao($dados->getCdInscricao());
									$obj->setDtUltimoAcesso(date('Y-m-d H:i:s'));
									$obj->setDsEnderecoIp(session::get_var('ip'));
									//Caso tem data de ultimo acesso passa para a data de ultima visita
									if(!empty($dadosLog->getDtUltimoAcesso())){
										$obj->setDtUltimaVisita($dadosLog->getDtUltimoAcesso());
									} else {
										$obj->setDtUltimaVisita(date('Y-m-d H:i:s'));
									}
									$obj->setCdError(1);
									$obj->setInAtivo(1);

									//Caso já tenha entrado no portal só da o update no time e ip
									$class->UpdateLogs($obj);

									include '../connection_close.php';

									//header('Location: inicio');

								} else {

									?>

									<form action="index" method="POST" accept-charset="utf-8" name="usuario_bloqueado">
										<input type="hidden" name="code" value="44">
									</form>

									<script language="JavaScript">document.usuario_bloqueado.submit();</script>

									<?php

								}

							}

						} else {

							//Valida se está ativo
							if($dadosLog->getInAtivo() == 1){

								require_once '../controller/controller_session.php';

								//Cria dados da session
								$id = session::iniciar();
								//session::set_var('hash_id',md5(gethostbyaddr($_SERVER['REMOTE_ADDR'])));
								session::set_var('id_usuario',md5($dadosLog->getID()));
								session::set_var('cnpj',$dados->getCdInscricao());
								session::set_var('ip',$_SERVER['REMOTE_ADDR']);
								session::set_var('data_logado',date('Y-m-d H:i:s'));
								session::set_var('usuario', $dados->getDsLogin());
								session::set_var('id_cnpj', $dados->getID());

								$obj = new LoginModal();
								$obj->setDsLogin($dados->getDsLogin());
								$obj->setCdInscricao($dados->getCdInscricao());
								$obj->setDtUltimoAcesso(date('Y-m-d H:i:s'));
								$obj->setDsEnderecoIp(session::get_var('ip'));
								//Caso tem data de ultimo acesso passa para a data de ultima visita
								if(!empty($dadosLog->getDtUltimoAcesso())){
									$obj->setDtUltimaVisita($dadosLog->getDtUltimoAcesso());
								} else {
									$obj->setDtUltimaVisita(date('Y-m-d H:i:s'));
								}
								$obj->setCdError(1);
								$obj->setInAtivo(1);

								//Insere caso nunca tenha logado no portal se o usuário existir
								$class->SalvaLogs($obj);

								include '../connection_close.php';

								//header('Location: inicio');

							} else if ($dadosLog->getInAtivo() == '0') {

								//Captura a data da ultima tentativa de login
								$dataUltTentativa = $dadosLog->getDtUltimaTentativa().'<br>';

								//Data atual - 2 minutos
								$dataAtual = date('Y-m-d H:i:s',strtotime('-2 minutes'));

								if($dataUltTentativa < $dataAtual){

									require_once '../controller/controller_session.php';

									//Cria dados da session
									$id = session::iniciar();
									//session::set_var('hash_id',md5(gethostbyaddr($_SERVER['REMOTE_ADDR'])));
									session::set_var('id_usuario',md5($dadosLog->getID()));
									session::set_var('cnpj',$dados->getCdInscricao());
									session::set_var('ip',$_SERVER['REMOTE_ADDR']);
									session::set_var('data_logado',date('Y-m-d H:i:s'));
									session::set_var('usuario', $dados->getDsLogin());
									session::set_var('id_cnpj', $dados->getID());

									$obj = new LoginModal();
									$obj->setDsLogin($dados->getDsLogin());
									$obj->setCdInscricao($dados->getCdInscricao());
									$obj->setDtUltimoAcesso(date('Y-m-d H:i:s'));
									$obj->setDsEnderecoIp(session::get_var('ip'));
									//Caso tem data de ultimo acesso passa para a data de ultima visita
									if(!empty($dadosLog->getDtUltimoAcesso())){
										$obj->setDtUltimaVisita($dadosLog->getDtUltimoAcesso());
									} else {
										$obj->setDtUltimaVisita(date('Y-m-d H:i:s'));
									}
									$obj->setCdError(1);
									$obj->setInAtivo(1);

									//Insere caso nunca tenha logado no portal se o usuário existir
									$class->SalvaLogs($obj);

									include '../connection_close.php';

									//header('Location: inicio');

								} else {

									?>

									<form action="index" method="POST" accept-charset="utf-8" name="usuario_bloqueado">
										<input type="hidden" name="code" value="44">
									</form>

									<script language="JavaScript">document.usuario_bloqueado.submit();</script>

									<?php

								}

							} else {

								require_once '../controller/controller_session.php';

								//Cria dados da session
								$id = session::iniciar();
								//session::set_var('hash_id',md5(gethostbyaddr($_SERVER['REMOTE_ADDR'])));
								session::set_var('id_usuario',md5($dadosLog->getID()));
								session::set_var('cnpj',$dados->getCdInscricao());
								session::set_var('ip',$_SERVER['REMOTE_ADDR']);
								session::set_var('data_logado',date('Y-m-d H:i:s'));
								session::set_var('usuario', $dados->getDsLogin());
								session::set_var('id_cnpj', $dados->getID());

								$obj = new LoginModal();
								$obj->setDsLogin($dados->getDsLogin());
								$obj->setCdInscricao($dados->getCdInscricao());
								$obj->setDtUltimoAcesso(date('Y-m-d H:i:s'));
								$obj->setDsEnderecoIp(session::get_var('ip'));
								//Caso tem data de ultimo acesso passa para a data de ultima visita
								if(!empty($dadosLog->getDtUltimoAcesso())){
									$obj->setDtUltimaVisita($dadosLog->getDtUltimoAcesso());
								} else {
									$obj->setDtUltimaVisita(date('Y-m-d H:i:s'));
								}
								$obj->setCdError(1);
								$obj->setInAtivo(1);

								//Insere caso nunca tenha logado no portal se o usuário existir
								$class->SalvaLogs($obj);

								include '../connection_close.php';

								//header('Location: inicio');

							}

						}

					}

				//Se a senha for invalida começa a contar as tentativas de login
				} else {

					$login = 1;

					//Consulta a tabela de logs
					foreach($class->ConsultaLogsPortal($usuario_form,$cnpj_form) as $dadosLog){

						//Verifica se o usuario já foi inserido caso exista
						if($dadosLog->getRowCount() < 0){

							//Valida a tentativa de logins se CdError < 3 continua se não bloqueia
							if($dadosLog->getCdError() < 3 && $dadosLog->getInAtivo() == 1){

								$obj = new LoginModal();
								$obj->setDsLogin($dados->getDsLogin());
								$obj->setCdInscricao($dados->getCdInscricao());
								$obj->setDtUltimaTentativa(date('Y-m-d H:i:s'));
								$obj->setDsEnderecoIp($_SERVER['REMOTE_ADDR']);
								$obj->setInAtivo(1);

								//Cria log caso senha estiver errada e update tentativas CdError
								$class->UpdateErrorLogin($obj);

								//Diminui cada tentativa ao digitar senha errada
								$tentativas = 3 - $dadosLog->getCdError();

								?>

								<form action="index" method="POST" accept-charset="utf-8" name="senha_invalida">
									<input type="hidden" name="code" value="55">
									<input type="hidden" name="valor" value="<?php echo $tentativas?>">
								</form>

								<script language="JavaScript">document.senha_invalida.submit();</script>

								<?php

								include '../connection_close.php';


							} else {

								//Valida se usuário não está ativo se está ativo bloqueia usuário
								if($dadosLog->getInAtivo() == 1){

									$obj = new LoginModal();
									$obj->setDsLogin($dados->getDsLogin());
									$obj->setCdInscricao($dados->getCdInscricao());
									$obj->setDtUltimaTentativa(date('Y-m-d H:i:s'));
									$obj->setDsEnderecoIp($_SERVER['REMOTE_ADDR']);
									$obj->setInAtivo(0);
									$obj->setCdError(3);

									//Bloqueia usuario e volta para a tela de login
									$class->AlteraStatusUsuario($obj);

									?>

									<form action="index" method="POST" accept-charset="utf-8" name="usuario_bloqueado">
										<input type="hidden" name="code" value="44">
									</form>

									<script language="JavaScript">document.usuario_bloqueado.submit();</script>

									<?php

									include '../connection_close.php';

								}

								//Valida se usuário está ativo se não estiver ativo faz a validação do tempo de tentativas
								if($dadosLog->getInAtivo() == 0){

									//Captura a data da ultima tentativa de login
									$dataUltTentativa = $dadosLog->getDtUltimaTentativa().'<br>';

									//Data atual - 2 minutos
									$dataAtual = date('Y-m-d H:i:s',strtotime('-2 minutes'));

									//Verifica se a ultima tentativa passou de dois minutos
									if($dataUltTentativa < $dataAtual){

										$obj = new LoginModal();
										$obj->setDsLogin($dados->getDsLogin());
										$obj->setCdInscricao($dados->getCdInscricao());
										$obj->setDtUltimaTentativa(date('Y-m-d H:i:s'));
										$obj->setDsEnderecoIp($_SERVER['REMOTE_ADDR']);
										$obj->setInAtivo(1);
										$obj->setCdError(1);

										//Desbloqueia usuario caso passado de 2 minutos
										$class->AlteraStatusUsuario($obj);

										include '../connection_close.php';

										?>

										<form action="index" method="POST" accept-charset="utf-8" name="senha_invalida">
											<input type="hidden" name="code" value="55">
											<input type="hidden" name="valor" value="3">
										</form>

										<script language="JavaScript">document.senha_invalida.submit();</script>

										<?php

									} else {

										//Usuario ainda bloqueado aguarda 2 minutos na tela de login

										include '../connection_close.php';

										?>

										<form action="index" method="POST" accept-charset="utf-8" name="usuario_bloqueado">
											<input type="hidden" name="code" value="44">
										</form>

										<script language="JavaScript">document.usuario_bloqueado.submit();</script>

										<?php

									}

								}

							}


						} else {

							$obj = new LoginModal();
							$obj->setDsLogin($dados->getDsLogin());
							$obj->setCdInscricao($dados->getCdInscricao());
							$obj->setDtUltimaTentativa(date('Y-m-d H:i:s'));
							$obj->setDsEnderecoIp($_SERVER['REMOTE_ADDR']);
							$obj->setInAtivo(1);
							$obj->setCdError(1);

							//Insere log da tentativa de login do cliente
							$class->SalvaLogs($obj);

							include '../connection_close.php';

							?>

							<form action="index" method="POST" accept-charset="utf-8" name="senha_invalida">
								<input type="hidden" name="code" value="55">
								<input type="hidden" name="valor" value="3">
							</form>

							<script language="JavaScript">document.senha_invalida.submit();</script>

							<?php

						}

					}

				}

			//Se usuário não existe
			} else {

				$login = 1;

				include '../connection_close.php';

				?>

				<form action="index" method="POST" accept-charset="utf-8" name="usuario_nao_existe">
					<input type="hidden" name="code" value="22">
				</form>

				<script language="JavaScript">document.usuario_nao_existe.submit();</script>

				<?php

			}

		}

		//Se usuário não existe
		if($login == 0){

			include '../connection_close.php';

			?>

			<form action="index" method="POST" accept-charset="utf-8" name="usuario_nao_existe">
				<input type="hidden" name="code" value="66">
			</form>

			<script language="JavaScript">document.usuario_nao_existe.submit();</script>

			<?php

		}

	} else {

		include '../connection_close.php';

		header('location: index');

	}

} else {

	include '../connection_close.php';

	header('location: index');

}

?>