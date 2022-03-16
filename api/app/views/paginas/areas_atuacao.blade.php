@extends('template')
@section('conteudo')
<div class="container">
	<div class="titulo">
		<h1>Áreas de Atuação</h1>
		<img src="public/assets/img/borda-titulo.png" />
	</div>
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4 col-sm-5 map">
				<img src="public/assets/img/mapa-brasil.png" alt="" class="img-responsive" />
			</div>
			<div class="col-md-7 col-sm-7 col-md-offset-1">
				<a href="#" id="Estado" rel="SP">
					São Paulo
				</a>
				<a href="#" id="Estado" rel="PR">
					Paraná
				</a>
				<a href="#" id="Estado" rel="SC">
					Santa Catarina
				</a>
				<a href="#" id="Estado" rel="RS">
					Rio Grande do Sul
				</a>
				<div id="SP">
					<div class="row">
						<h2 class="regiao">   Grande São Paulo</h3>
							<div class="col-md-6">
								<h4 class="regiao" style="text-decoration: underline;">Metropolitana</h4>
								<p>Barueri</p>
								<p>*Biritiba Mirim</p>
								<p>Cajamar</p>
								<p>*Cajeiras</p>
								<p>Carapicuíba</p>
								<p>Cotia</p>
								<p>Diadema</p>
								<p>Embu das Artes</p>
								<p>*Embu-Guaçu</p>
								<p>*Ferraz de Vasconcelos</p>
								<p>*Francisco Morato</p>
								<p>*Franco da Rocha</p>
								<p>Guarulhos</p>
								<p>Itapecerica da Serra</p>
								<p>Itapevi</p>
								<p>*Itaquaquecetuba</p>
								<p>Jandira</p>
							</div>
							<div class="col-md-6">
								<br>
								<p>*Mairiporã</p>
								<p>*Mauá</p>
								<p>*Mogi das Cruzes</p>
								<p>Osasco</p>
								<p>*Perus</p>
								<p>*Poá</p>
								<p>*Ribeirão Pires</p>
								<p>*Rio Grande da Serra</p>
								<p>Santana de Parnaíba</p>
								<p>Santo André</p>
								<p>São Bernardo do Campo</p>
								<p>São Caetano do Sul</p>
								<p>São Paulo</p>
								<p>*Suzano</p>
								<p>Taboão da Serra</p>
								<p>Vargem Grande Paulista</p>
							</div>
							<div class="clearfix"></div>
							<h2 class="regiao">   Interior de São Paulo</h3>
								<div class="col-md-6">
									<h4 class="regiao" style="text-decoration: underline;">Campinas</h4>
									<p>*Americana</p>
									<p>*Amparo</p>
									<p>Araçariguama</p>
									<p>*Araras</p>
									<p>*Atibaia</p>
									<p>*Braganca Paulista</p>
									<p>*Cajati</p>
									<p>Campo Limpo Paulista</p>
									<p>*Conchal</p>
									<p>*Cosmópolis</p>
									<p>Hortolândia</p>
									<p>*Ibiúna</p>
									<p>*Indaiatuba</p>
									<p>*Itapira</p>
									<p>*Itatiba</p>
									<p>*Itu</p>
									<p>*Jaguariúna</p>
									<p>Jarinu</p>
									<p>Jundiaí</p>
									<p>*Limeira</p>
									<p>Mairinque</p>
									<p>*Mogi Guaçu</p>
									<p>*Mogi Mirim</p>
									<p>*Monte Mor</p>
									<p>*Nova Odessa</p>
									<p>*Paulínia</p>
									<p>*Pedreira</p>
									<p>*Piedade</p>
									<p>Porto Feliz</p>
									<p>*Registro</p>
									<p>*Salto</p>
									<p>*Salto de Pirapora</p>
									<p>*Santa Barba D Oeste</p>
									<p>São Roque</p>
									<p>*Socorro</p>
									<p>Sorocaba</p>
									<p>*Sumará</p>
									<p>*Tatuí</p>
									<p>*Tiete</p>
									<p>*Valinhos</p>
									<p>Várzea Paulista</p>
									<p>*Vinhedos</p>
									<p>Votorantim</p>
								</div>
								<div class="col-md-6">
									<h4 class="regiao" style="text-decoration: underline;">Dutra - Vale do Paraíba</h4>
									<p>*Aparecida</p>
									<p>*Arujá</p>
									<p>*Caçapava</p>
									<p>*Cachoeira Paulista</p>
									<p>*Campos do Jordao</p>
									<p>*Cruzeiro</p>
									<p>*Guararema</p>
									<p>*Guaratinguetá</p>
									<p>*Jacareí</p>
									<p>*Lorena</p>
									<p>*Pindamonhangaba</p>
									<p>*Santa Izabel</p>
									<p>*São Jose dos Cam-pos</p>
									<p>*Taubaté</p>
									<p>*Tremembé</p>
									<br /><br />
									<h4 class="regiao" style="text-decoration: underline;">Baixada Santista</h4>
									<p>Bertioga</p>
									<p>*Caraguatatuba</p>
									<p>*Cubatão</p>
									<p>Guarujá</p>
									<p>Itanhaém</p>
									<p>Mongaguá</p>
									<p>Peruíbe</p>
									<p>Praia Grande</p>
									<p>Santos</p>
									<p>*São Sebastiao</p>
									<p>São Vicente</p>
									<p>*Ubatuba</p>
								</div>
							</div>
						</div>
						<div id="PR">
							<div class="row">
								<h2 class="regiao">   Paraná</h3>
									<div class="col-md-6">
										<p>Almirante Tamandaré</p>
										<p>Antonina</p>
										<p>Apucarana</p>
										<p>Arapongas</p>
										<p>Araucária</p>
										<p>Assai</p>
										<p>*Balsa Nova</p>
										<p>Bela Vista Do Paraiso</p>
										<p>*Bocaiuva do Sul</p>
										<p>Cambe</p>
										<p>Campina Grande do Sul</p>
										<p>Campo Largo</p>
										<p>Campo Magro</p>
										<p>Carambeí</p>
										<p>Castro</p>
										<p>Colombo</p>
										<p>Curitiba</p>
										<p>Fazenda Rio Grande</p>
										<p>Guaratuba</p>
										<p>Ibiporã</p>
										<p>Itaperuçu</p>
										<p>Jandaia Do Sul</p>
										<p>Jataizinho</p>
										<p>Londrina</p>
										<p>Mandaguari</p>
									</div>
									<div class="col-md-6">
										<p>*Mandirituba</p>
										<p>Marialva</p>
										<p>Maringá</p>
										<p>Matinhos</p>
										<p>Morretes</p>
										<p>Paranaguá</p>
										<p>*Paranavaí</p>
										<p>Pien</p>
										<p>Pinhais</p>
										<p>Piraquara</p>
										<p>Ponta Grossa</p>
										<p>Pontal do Paraná</p>
										<p>Quatro Barras</p>
										<p>Quitandinha</p>
										<p>Rio Branco do Sul</p>
										<p>Rolândia</p>
										<p>Sabáudia</p>
										<p>São Jose dos Pinhais</p>
										<p>Sarandi</p>
										<p>Sertanopolis</p>
										<p>*Tunas do Paraná</p>

									</div>
								</div>
							</div>
							<div id="SC">
								<div class="row">
									<h2 class="regiao">   Santa Catarina</h3>
										<div class="col-md-6">
											<p>Aguas Mornas</p>
											<p>*Alfredo Wagner</p>
											<p>Angelina</p>
											<p>Antônio Carlos</p>
											<p>*Apiúna</p>
											<p>*Ascurra</p>
											<p>Balneário Camboriú</p>
											<p>Barra Velha</p>
											<p>Biguaçu</p>
											<p>Blumenau</p>
											<p>Bombinhas</p>
											<p>Brusque</p>
											<p>Camboriú</p>
											<p>Florianópolis</p>
											<p>Gaspar</p>
											<p>Governador Celso Ramos</p>
											<p>Guabiruba</p>
											<p>Guaramirim</p>
											<p>Ilhota</p>

										</div>
										<div class="col-md-6">
											<p>Indaial</p>
											<p>Itajaí</p>
											<p>Itapema</p>
											<p>Jaraguá Do Sul</p>
											<p>Joinville</p>
											<p>*Lontras</p>
											<p>*Major Gercino</p>
											<p>Navegantes</p>
											<p>Palhoça</p>
											<p>Penha</p>
											<p>Porto Belo</p>
											<p>Rancho Queimado</p>
											<p>Santo Amaro da Imperatriz</p>
											<p>*São Bonifácio</p>
											<p>*São Joao Batista</p>
											<p>São Jose</p>
											<p>São Pedro de Alcântara</p>
											<p>Tijucas</p>
										</div>
									</div>
								</div>
								<div id="RS">
									<div class="row">
										<h2 class="regiao">   Rio Grande do Sul</h3>
											<div class="col-md-6">
												<p>Alvorada</p>
												<p>*Antônio Prado</p>
												<p>*Barão</p>
												<p>Bento Goncalves</p>
												<p>*Bom Principio</p>
												<p>Cachoeirinha</p>
												<p>*Campo Bom</p>
												<p>*Canela</p>
												<p>Canoas</p>
												<p>Carlos Barbosa</p>
												<p>*Casca</p>
												<p>Caxias do Sul</p>
												<p>*Cotiporã</p>
												<p>*Dois Irmãos</p>
												<p>Eldorado do Sul</p>
												<p>*Encantado</p>
												<p>*Estancia Velha</p>
												<p>Esteio</p>
												<p>*Estrela</p>
												<p>Farroupilha</p>
												<p>Flores da Cunha</p>
												<p>Garibaldi</p>
												<p>*Gramado</p>
												<p>Gravataí</p>
												<p>Guaíba</p>
												<p>*Guaporé</p>
												<p>*Igrejinha</p>
												<p>*Ivoti</p>

											</div>
											<div class="col-md-6">
												<p>*Lagoa Vermelha</p>
												<p>*Lajeado</p>
												<p>*Monte Belo do Sul</p>
												<p>*Muçum</p>
												<p>*Nova Araçá</p>
												<p>*Nova Prata</p>
												<p>Nova Santa Rita</p>
												<p>*Novo Bassano</p>
												<p>*Novo Hamburgo</p>
												<p>*Pareci Novo</p>
												<p>*Parobé</p>
												<p>Porto Alegre</p>
												<p>*Salvador do Sul</p>
												<p>*Santa Tereza</p>
												<p>São Leopoldo</p>
												<p>*São Marcos</p>
												<p>*São Sebastiao do Cai</p>
												<p>São Vendelino</p>
												<p>*Sapiranga</p>
												<p>Sapucaia do Sul</p>
												<p>* Teutônia </p>
												<p>*Três Coroas</p>
												<p>*Triunfo</p>
												<p>*Tupandi</p>
												<p>*Veranópolis</p>
												<p>Viamão</p>
												<p>*Vila Flores</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<br><br>
						<div class="col-md-4 col-sm-5 map" style="color: red;">
							<p>(*) cidades não atendidas no segmento e-commerce</p>
						</div>
					</div>
					@stop