$(document).ready(function () {
    $("#exportar-csv").on("click", function () {
        var order_by = $("#order").val();
        var search = $("#search").val();
        var listagem = false;

        if ($("#listagem").length > 0) {
            listagem = true;
        }

        $(this).after('<br><p id="loader"><i class="fa fa-refresh fa-spin"></i> Exportando CSV...</p>');

        $.ajax({
            type: 'POST',
            url: 'acoes.php',
            data: {
                acao: 'exportar_csv',
                order_by: order_by,
                search: search,
                listagem: listagem
            },
            success: function (data) {
                if (data != 'erro') {
                    var mensagem = '<div class="alert alert-success"> Registros exportados com sucesso. </div>';
                    $("#mensagens").html(mensagem);
                    $("#download").attr("href", data);
                    $("#download span").trigger('click');
                    console.log(data);

                } else {
                    console.log(data);
                    var mensagem = '<div class="alert alert-danger"> Ocorreu um erro ao exportar. </div>';
                    $("#mensagens").html(mensagem);
                }
                $("#loader").remove();
            }
        })
    });

    $("#exportar-relatorio").click(function () {
        $(this).after('<br><p id="loader"><i class="fa fa-refresh fa-spin"></i> Exportando Relatorio Final...</p>');

        $.ajax({
            type: 'POST',
            url: 'acoes.php',
            data: {
                acao: 'exportar_relatorio'
            },
            success: function (data) {
                if (data != 'erro') {
                    var mensagem = '<div class="alert alert-success"> Registros exportados com sucesso. </div>';
                    $("#mensagens").html(mensagem);
                    $("#download").attr("href", data);
                    $("#download span").trigger('click');
                    console.log(data);
                } else {
                    console.log(data);
                    var mensagem = '<div class="alert alert-danger"> As leituras não foram completadas. </div>';
                    $("#mensagens").html(mensagem);
                }
                $("#loader").remove();
            }
        });
    })

});