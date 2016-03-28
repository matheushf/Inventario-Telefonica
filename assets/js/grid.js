/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    $("#btn-novo").on("click", function () {
        window.location.assign("form.php?operacao=inserir");
    })

    $("#btn-editar").on("click", function () {
        if (!(id = PegarId())) {
            return false;
        }

        window.location.assign("form.php?operacao=atualizar&id=" + id);
    })

    $("#btn-excluir").on("click", function () {

        var modulo = $("#modulo").val();

        if (!confirm("Tem certeza que deseja excluir? ")) {
            return;
        }

        $("input:checked").each(function () {
            var id = $(this).val();

            $.ajax({
                type: 'POST',
                url: '/vivo-inventario/lib/action.php',
                data: {
                    acao: 'excluir',
                    id: id,
                    modulo: modulo
                },
                success: function (data) {
                    if (data == "OK") {
                        $("input:checked").parents("tr").remove();
                        var mensagem = '<div class="alert alert-success"> Registro excluído com sucesso. </div>';
                        $("#mensagens").html(mensagem);
                    } else if (data == "ERRO") {
                        var mensagem = '<div class="alert alert-danger"> Ocorreu um erro ao excluir o registro. </div>';
                        $("#mensagens").html(mensagem);
                    }
                }
            })
        })
    })

    // Buscador
    $("#procurar").click(function (event) {
        event.preventDefault();
        window.location.assign("?busca=" + $("#busca").val());
    })

    // Marcar linha clicada na grid
    var selecionado = null;
    var todos_selecionados = false;
    
    // Selecionar todos checkbox
    $("#check_all").on("change", function () {
        alert('ue');
        if (todos_selecionados) {
            todos_selecionados = false;
        } else {
            todos_selecionados = true;
        }
        
        $("input:checkbox").each(function () {
            if (todos_selecionados) {
                $(this).prop("checked", true);
                
            } else {
                $(this).prop("checked", false);
            }
        })
    })
    
    // pequeno hack para tirar o bug ao selecionar todos
    $("input:checkbox").on("click", function () {
        selecionado = true;
    })

    $("tr").on("click", function () {

        var checkbox = $(this).find(':checkbox');

        if (selecionado) {
            selecionado = false;
            return;
        }

        if (!checkbox.is(':checked')) {
            alert('mas');
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });
})

function PegarId() {
    if ($("input:checked").length == 0) {
        alert("Escolha pelo menos um registro.");
        return false;
    }

    if ($("input:checked").length >= 2) {
        alert('Selecione apenas um registro.');
        return;
    }

    var id = $("input:checked").val();

    return id;
}