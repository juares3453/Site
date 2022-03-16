@extends('template')
@section('conteudo')
<div class="container">
	@if($sucesso == true)
	<div class="col-sm-6 col-md-8 col-md-offset-2">
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
				×</button>
				<span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp; <strong>Sucesso!</strong>
				<hr class="message-inner-separator">
				<p>Seu e-mail foi enviado com sucesso, logo retornaremos. Obrigado.</p>
			</div>
		</div>
		<div class="clearfix"></div>
		@endif
		<h2>Clique abaixo no link desejado:</h2>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<a href="#" id="LinkTo" rel="Contato">
				<div class="titulo">
					<h2>Fale</h2>
					<h1>Conosco</h1>
					<img src="public/assets/img/borda-titulo.png" />
				</div>
			</a>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<a href="#" id="LinkTo2" rel="Trabalhe">
				<div class="titulo">
					<h2>Trabalhe Conosco</h2>
					<h1>Conosco</h1>
					<img src="public/assets/img/borda-titulo.png" />
				</div>
			</a>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-8 Contato" id="formMail">
			<form id="contatoEnvioMail" method="post">
				<div id="erro-form" style="display: none;">
					<div class="error-notice">
						<div class="oaerror warning">
							<strong>Erros Encontrados</strong>
							- Por favor, preencha todos os campos corretamente!
						</div>
					</div>
				</div>
				<div>
					<div class="col-md-12">
						<p>Selecione a área que você deseja entrar em cotato e preencha o formulário.</p>
						<select name="area" id="area" class="form-control">
							<option value="graziela@rasador.com.br">Área de Interesse</option>
							<option value="comercial@rasador.com.br">Comercial</option>
							<option value="recepcao@rasador.com.br">Compras</option>
							<option value="financeiro@rasador.com.br">Financeiro</option>
							<option value="frota@rasador.com.br">Frota</option>
							<option value="cristiano@rasador.com.br">Logística</option>
							<option value="cristiano@rasador.com.br">Operacional</option>
							<option value="rh@rasador.com.br">Recursos Humanos</option>
							<option value="ti@rasador.com.br">Tecnologia</option>
						</select>
					</div>
					<div class="col-md-6">
						<input type="text" name="nome" id="nome" class="form-control" placeholder="Nome">
					</div>
					<div class="col-md-6">
						<input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone">
					</div>
					<div class="col-md-6">
						<input type="text" name="email" id="email" class="form-control" placeholder="E-mail">
					</div>
					<div class="col-md-6">
						<input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade">
					</div>
					<div class="col-md-12">
						<textarea name="mensagem" rows="9" class="form-control" id="texto" placeholder="Mensagem"></textarea>
					</div>
					<div class="col-md-6 col-md-offset-3">
						<input type="hidden" name="_token" value="9y7TiNvbjvCqBy29ADFojdzyoau4vycHERlR5u2D" />
						<input type="submit" class="btn submit-form" id="enviar_contato" value="Enviar Contato" />
						<div id="carregando" class="alert alert-info">Enviando! Aguarde.</div>
						<div id="carregando-sucesso" class="alert alert-success"></div>
						<div id="mensagem-error" class="alert alert-danger"></div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-8 Trabalhe" id="formWork">
			<form id="contatoEnvioWork" method="post" action="{{URL::route('env.wor')}}" enctype="multipart/form-data">
				<div>
					<div class="col-md-12">
						<p>Preencha as informações e anexo seu currículo.</p>
					</div>
					<div class="col-md-6">
						<input type="text" name="nome" id="nome" class="form-control" placeholder="Nome">
					</div>
					<div class="col-md-6">
						<input type="text" name="sobrenome" id="sobrenome" class="form-control" placeholder="Sobrenome">
					</div>
					<div class="col-md-6">
						<input type="text" name="email" id="email" class="form-control" placeholder="E-mail">
					</div>
					<div class="col-md-6">
						<input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone">
					</div>
					<div class="col-md-6">
						<input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade">
					</div>
					<div class="col-md-6">
						<input type="text" name="cargo" class="form-control" placeholder="Cargo Pretendido">
					</div>
					<div class="col-md-6">
						<br />
						Sexo: &nbsp;
						Masculino <input type="radio" name="sexo" value="Masculino" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Feminino <input type="radio" name="sexo" value="Feminino" />
					</div>
					<div class="col-md-6">
						<select name="estado" class="form-control">
							<option value="RS">Rio Grande do Sul</option>
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AP">Amapá</option>
							<option value="AM">Amazonas</option>
							<option value="BA">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espirito Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MT">Mato Grosso</option>
							<option value="MG">Minas Gerais</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PR">Paraná</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="SC">Santa Catarina</option>
							<option value="SP">São Paulo</option>
							<option value="SE">Sergipe</option>
							<option value="TO">Tocantins</option>
						</select>
					</div>
					<div class="col-md-12">
						<br />
						<p>Anexe seu currículo</p>
						<input type="file" name="curriculo" id="curriculo" />
					</div>
					<div class="col-md-6 col-md-offset-3">
						<input type="hidden" name="_token" value="9y7TiNvbjvCqBy29ADFojdzyoau4vycHERlR5u2D" />
						<input type="submit" class="btn submit-form" id="enviar_work" value="Enviar Currículo" />
						<div id="carregando" class="alert alert-info">Enviando! Aguarde.</div>
						<div id="carregando-sucesso" class="alert alert-success"></div>
						<div id="mensagem-error" class="alert alert-danger"></div>
					</div>
				</div>
			</form>
		</div>
		<div class="clearfix"></div>
		<h2>Matriz e filiais:</h2>
		<div class="col-md-4 infos-filiais">
			<h2 class="end">Matriz Bento Gonçalves</h2>
			<p>Rua Laudelino M. Alexandre, 90</p>
			<p>Bairro Juventude - Bento Gonçalves, RS</p>
			<p>Fone/Fax: (54) 2102-7700</p>
			<p class="email"> <a href="mailto::transportes@rasador.com.br">transportes@rasador.com.br</a></p>
		</div>
		<div class="col-md-4 infos-filiais">
			<h2 class="end">Ponto de Distribuição em Porto Alegre - RS</h2>
			<p>Rua Vitor Valpírio, 339</p>
			<p>Bairro Anchieta - Porto Alegre, RS</p>
			<p>Fone: (51) 3374-2622</p>
			<p class="email"> <a href="mailto::portoalegre@rasador.com.br">portoalegre@rasador.com.br </a></p>
		</div>
		<div class="col-md-4 infos-filiais">
			<h2 class="end">Ponto de Distribuição na Grande Florianópolis - SC</h2>
			<p>Av. Thiago Antunes Teixeira, 398</p>
			<p>Bairro Bela Vista - São Jose, SC</p>
			<p>Fone: (48) 3094-7599</p>
			<p class="email"> <a href="mailto::floripa@rasador.com.br">floripa@rasador.com.br</a></p>
		</div>
		<div class="col-md-4 infos-filiais">
			<h2 class="end">Centro de Distribuição em Curitiba - PR</h2>
			<p>Rua Samuel da Rocha Coelho, 502</p>
			<p>Bairro CIC - Curitiba, PR</p>
			<p>Fones: (41) 3778-7244</p>
			<p class="email"> <a href="mailto::curitiba@rasador.com.br">curitiba@rasador.com.br</a></p>
		</div>
		<div class="col-md-4 infos-filiais">
			<h2 class="end">Centro de Distribuição em Barueri - SP</h2>
			<p>Av. Dr, Humberto Gianella,705</p>
			<p>Jardim Belval - Barueri, SP</p>
			<p>Fone/Fax: (11) 2787-1900</p>
			<p class="email"> <a href="mailto::logisticasp@rasador.com.br">logisticasp@rasador.com.br</a></p>
		</div>
		<div class="col-md-4 infos-filiais">
			<h2 class="end">Filial Londrina - PR</h2>
			<p>Av. Jorge Casoni, 267</p>
			<p>Lago Igapo - PR</p>
			<p>Fones: (43) 3029-5254 </p>
			<p class="email"> <a href="mailto::londrina@rasador.com.br">londrina@rasador.com.br</a></p>
		</div>

	</div>
	@stop