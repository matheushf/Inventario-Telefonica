/**
 * 
 */

function carregarQuadra(id) {	
	var padrao = "<option value='' selected>Selecione.. </option>";
	var quadra = $("#quadraId").val();
	$.ajax({
		url: '/lib/funcoesAjax.php',
		data: {BairroId: id},
		type: 'POST',
		success: function(data) {
			$("#quadra").find("option").remove().end();
			$("#quadra").append(padrao);
			$("#quadra").append(data);

			if(($("#quadra option[value='" + quadra + "'").val()) != null) {
				$("#quadra").val(quadra);
			}						
		}
	});
}

$(document).ready(function() {
	//Carregar a quadra e o bairro
	var bairro = $("#bairroId").val();
	$("#bairro").val(bairro);
	carregarQuadra(bairro);
	
    jQuery(function($){
		$("#altura").mask("9.99");
    });	
});



//Validar extensão no input do formulário
function valida(arquivo) {
	var myFile = document.getElementById('imagem');
	var tamanho_max = 1024 * 5000;
	
	if (myFile.files[0].size > tamanho_max) {
		alert("Escolha um arquivo com tamanho menor que 4mb.");
		$("#imagem").val("");
		return false;
	}

	var ext = arquivo.split(".");
	ext = ext[ext.length - 1].toLowerCase();

	var arrayExtensoes = [ "jpg", "jpeg", "png", "bmp", "gif" ];

	if (ext == "") {
		return false;
	}

	if (arrayExtensoes.lastIndexOf(ext) == -1) {
		alert("Insira uma extensão válida.");
		$("#imagem").val("");
		return false;
	}	
}