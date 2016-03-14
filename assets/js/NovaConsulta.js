/**
 * 
 */

$(document).ready(function(){
	$("#demanda").hide();

});


function carregarDatas(id) {	
	var padrao = "<option value='-1' selected>Selecione.. </option>";
	$.ajax({
		url: '/lib/funcoesAjax.php',
		data: {dataId: id},
		type: 'POST',
		success: function(data) {
//			$("#teste").html(data);
			$("#data").find("option").remove().end();
			if (data == "") {
//				var opcao = "<option value='-1' selected>Nenhuma data disponível. </option>";
//				$("#data").append(opcao);
//				carregarHoras();
				$("#consulta").remove();
				$("#demanda").show();
			} else {
				$("#data").append(data);
				carregarHoras();
			}
		}
	});
}

function carregarHoras() {	
	
	var id = $("#especialidade").val();
	var valor_data = $("#data").val();
	
	$.ajax({
		url: '/lib/funcoesAjax.php',
		data: {horaId: id, data: valor_data},
		type: 'POST',
		success: function(data) {
//			$("#teste").html(data);
			$("#hora").find("option").remove().end();
			if (data == "") {
				var opcao = "<option value='-1' selected>Nenhuma hora disponível. </option>";
				$("#hora").append(opcao);
			} else {
				$("#hora").append(data);
			}
		}
	});
}

function punicao() {
	$("#consulta").remove();
	$("#demanda").show();
}