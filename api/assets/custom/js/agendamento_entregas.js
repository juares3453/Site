$(document).ready(function(){
	$("#modalSucess").modal('show');
});

$('#cnpj').blur(function(){
	var dados = $('#formulario').serialize();
	$.ajax({
		type : 'POST',
		dataType: 'JSON',
		url  : 'precontroller/busca_dados_cliente.php',
		data: dados,
		success :  function(data){

			$('#nome').val(data.nome);
			$("#nome").prop("readonly", true);
			$('#cidade').val(data.cidade);
			$("#cidade").prop("readonly", true);
			$('#telefone').val(data.telefone);
			$('#bairro').val(data.bairro);
			$("#bairro").prop("readonly", true);
			$('#numero').val(data.numero);
			$("#numero").prop("readonly", true);
			$('#cep').val(data.cep);
			$("#cep").prop("readonly", true);
			$('#endereco').val(data.endereco);
			$("#endereco").prop("readonly", true);
			$('#complemento').val(data.complemento);
			$('#uf').val(data.uf);
			$("#uf").prop("readonly", true);

		},

		error: function (data) {

			$('#nome').val("");
			$("#nome").prop("readonly", false);
			$('#cidade').val("");
			$('#telefone').val("");
			$("#bairro").prop("readonly", false);
			$('#bairro').val("");
			$("#bairro").prop("readonly", false);
			$('#numero').val("");
			$("#numero").prop("readonly", false);
			$('#cep').val("");
			$("#cep").prop("readonly", false);
			$('#endereco').val("");
			$("#endereco").prop("readonly", false);
			$('#complemento').val("");
			$('#uf').val("");

		}
	});

	return false;

});

$('#cep').blur(function(){
	var dados = $('#formulario').serialize();

	$.ajax({
		type : 'POST',
		dataType: 'JSON',
		url  : 'precontroller/busca_cep.php',
		data: dados,
		success :  function(data){
			$('#cidade').val(data.cidade);
			$('#uf').val(data.uf);
			$("#bairro").focus();
		},

		error: function (data) {
			alert('CEP inválido ou não cadastrado, entrar em contato com (54)2102-7700');
			$('#cep').val("");
			$('#cidade').val("");
			$('#uf').val("");
		}

	});

	return false;

});

$('#data').blur(function(){
	var dados = $('#formulario').serialize();

	$.ajax({
		type : 'POST',
		dataType: 'JSON',
		url  : 'precontroller/valida_data_agendamento.php',
		data: dados,
		success :  function(data){
			alert(data);
			$('#data').val("");
			//$("#cep").focus();
		}
	});

	return false;

});

var checkTodos = $("#checkTodos");
checkTodos.click(function () {
	if ( $(this).is(':checked') ){
		$('.check').prop("checked", true);
	}else{
		$('.check').prop("checked", false);
	}
});

$(document).ready(function () {
	$('#cnpj').cpfcnpj({
		mask: true,
		validate: 'cpfcnpj',
		event: 'focusout',
		handler: '#cnpj',
		ifValid: function (input) { },
		ifInvalid: function (input) { alert('CNPJ/CPF inválido'); $('#cnpj').val(""); }
	});
});

$(document).ready(function(){
	$('#telefone').mask('(00) 000000000');
});

$(".readonly").keydown(function(e){
	e.preventDefault();
});

$('#formulario').submit(function() {
	var requiredCheckboxes = $('.options :checkbox');

	if(requiredCheckboxes.is(':checked')) {
		var dados = $('#formulario').serialize();
		$.ajax({
			dataType: 'JSON',
			url  : 'precontroller/valida_submit_agendamento.php',
			type: 'POST',
			data: dados,
			context: this,
			success: function(data) {
				if (data.valida == '1') {
					alert(data.mensagem);
				} else if(data.valida == '2'){
					this.submit();
				}
			}
		});
	} else {
		alert('Selecione pelo menos uma nota fiscal para realizar o agendamento.');
		return false;
	}

	return false;

});

;
(function($) {
	$('#formulario').submit(function(e) {
		var files = $('#arquivoXml')[0].files;
		var exts = ['xml'];
		for (let i = 0; i < files.length; i++) {
			const file = files[i];
			if (file) {
				var get_ext = file.name.split('.');
				get_ext = get_ext.reverse();
				if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
					continue;
				} else {
					alert('Arquivo XML inválido, favor selecionar somente arquivos .xml');
					e.preventDefault();
					$("#arquivoXml").focus();
					return false;
				}
			} else return false;
		}
		return true;
	});
})(jQuery);

;
(function($) {
	$('#formulario').submit(function(e) {
		var files = $('#arquivoPdf')[0].files;
		var exts = ['pdf'];
		for (let i = 0; i < files.length; i++) {
			const file = files[i];
			if (file) {
				var get_ext = file.name.split('.');
				get_ext = get_ext.reverse();
				if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
					continue;
				} else {
					alert('Arquivo PDF inválido, favor selecionar somente arquivos .pdf');
					e.preventDefault();
					$("#arquivoPdf").focus();
					return false;
				}
			} else return false;
		}
		return true;
	});
})(jQuery);


$('#cepNovo').change(function(){
	var dados = $('#formulario').serialize();

	$.ajax({
		type : 'POST',
		dataType: 'JSON',
		url  : 'precontroller/busca_cep.php',
		data: dados,
		success :  function(data){
			$('#cidadeNovo').val(data.cidade);
			$('#ufNovo').val(data.uf);
			$("#bairroNovo").focus();
		},

		error: function (data) {
			alert('CEP inválido ou não cadastrado, entrar em contato com (54)2102-7700');
			$('#cepNovo').val("");
			$('#cidadeNovo').val("");
			$('#ufNovo').val("")
		}

	});

	return false;

});

//Valida click no checkbox "novo local de entrega"
$("#novoLocal").click(function(){
	if (!$(this).is(':checked')){
		$('#novoLocalEntrega').fadeOut('slow');

		//Ao desmarcar desabilita todos inputs
		$('#cepNovo').prop("disabled", true);
		$('#cidadeNovo').prop("disabled", true);
		$('#ufNovo').prop("disabled", true);
		$('#bairroNovo').prop("disabled", true);
		$('#enderecoNovo').prop("disabled", true);
		$('#numeroNovo').prop("disabled", true);

		//Ao desmarcar limpa todos inputs
		$('#cepNovo').val("");
		$('#cidadeNovo').val("");
		$('#ufNovo').val("");
		$('#bairroNovo').val("");
		$('#enderecoNovo').val("");
		$('#numeroNovo').val("");

	} else {
		$('#novoLocalEntrega').fadeIn('slow');

		//Ao marcar habilita todos inputs
		$('#cepNovo').prop("disabled", false);
		$('#cidadeNovo').prop("disabled", false);
		$('#ufNovo').prop("disabled", false);
		$('#bairroNovo').prop("disabled", false);
		$('#enderecoNovo').prop("disabled", false);
		$('#numeroNovo').prop("disabled", false);

		//Ao marcar torna obrigatoria o preenchimento
		$('#cepNovo').prop("required", true);
		$('#cidadeNovo').prop("required", true);
		$('#ufNovo').prop("required", true);
		$('#bairroNovo').prop("required", true);
		$('#enderecoNovo').prop("required", true);
		$('#numeroNovo').prop("required", true);

	}
});

$(document).ready(function(){
	if ($("#novoLocal").is(':checked') == false){
		$('#novoLocalEntrega').css('display', 'none');
	}
});