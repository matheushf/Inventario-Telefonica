/**
 * 
 */

// Remover alertas lidos
$(document).ready(function() {
	$('#menuAlerta.dropdown').on('hidden.bs.dropdown', function() {
		$("#alertaTopo").remove();
		$("#alertaEsquerda").remove();
		$.ajax({
			url : '/lib/funcoesAjax.php',
			data : {
				alertas : 'alertas'
			},
			type : 'POST',
			success : function(data) {
				// $("#teste").html(data);
				// alert(data);
			}
		});
	});

	// Date-picker
	$(".date-picker").datepicker({
		format : 'dd/mm/yyyy',
		language : 'pt-BR',
		autoclose : true
	});

});
