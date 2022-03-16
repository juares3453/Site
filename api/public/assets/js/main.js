$(function(){  
	// Backstratch
		$("#header").backstretch(["/public/assets/img/bg-header.jpg", "/public/assets/img/bg-header2.jpg", "/public/assets/img/bg-header3.jpg", "/public/assets/img/bg-header4.jpg"], {duration: 3000, fade: 750});

	$('#LinkTo, #LinkTo2').click(function(){
		var rel = $(this).attr('rel');
		$('div.Contato, div.Trabalhe').slideUp('slow');
		$('div.'+rel+'').slideDown('slow');
		return false;
	});

	$('div#SP, div#RS, div#SC, div#PR').slideUp('slow');

	$('a#Estado').click(function(){
		var rel = $(this).attr('rel');

		$('div#SP, div#RS, div#SC, div#PR').slideUp('slow');
		$('div#'+rel+'').slideDown('slow');
		return false;
	});

	// Modal
		$('#myModal').modal('show');

	// Contato
	    $("#contatoEnvioMail").validate({
	        rules : {
	        nome : "required",
	        email : {
	            required : true,
	            email : true
	        },
	        telefone : "required",
	        cidade : "required",
	        mensagem : "required"
	        },
	        messages : {
	        nome : "O campo nome é obrigatório.",
	        email : "Por favor insira um e-mail válido.",
	        telefone : "O campo telefone é obrigatório.",
	        cidade : "O campo cidade é obrigatório.",
	        mensagem : "O campo mensagem é obrigatório."
	        },
	         submitHandler: function(form){
	            $.ajax({
	                type: "POST",   
	                url: "/envio-de-formulario-contato",
	                cache: false,
	                data: jQuery(form).serialize(),
	                success: function(data){
	                    $('#carregando').slideUp('fast');
	                    $('#carregando-sucesso').text(data).slideDown('slow');
	                },
	                error: function(data){
	                    //alert(JSON.stringify(data));
	                    $("#carregando").slideUp("fast", function() {
	                        $('#enviar_contato').slideDown('slow');
	                    });
	                    $('#mensagem-error').text('Erro ao enviar o formulário, tente novamente.').slideDown('fast');
	                }
	            });
	         }   
	    });
	    $("#enviar_contato").click(function() {
	        if ($('#contatoEnvioMail').valid()){
	            $("#enviar_contato").slideUp("fast", function() {
	                $('#carregando').slideDown('slow');
	            });
	        }else{
	            $("#erro-form").slideDown('fast').delay(5000).fadeOut("slow");
	        }
	    });


	// Trabalhe Conosco
	    
	    $("#enviar_work").click(function() {
	       $("#contatoEnvioWork").validate({
		        rules : {
		        nome : "required",
		        sobrenome : "required",
		        cargo : "required",
		        email : {
		            required : true,
		            email : true
		        },
		        telefone : "required",
		        cidade : "required",
		        mensagem : "required"
		        },
		        messages : {
		        nome : "O campo nome é obrigatório.",
		        email : "Por favor insira um e-mail válido.",
		        telefone : "O campo telefone é obrigatório.",
		        sobrenome : "O campo sobrenome é obrigatório.",
		        cargo : "O campo cargo é obrigatório.",
		        cidade : "O campo cidade é obrigatório.",
		        mensagem : "O campo mensagem é obrigatório."
		        }
		    });
	       	
	    });

});


