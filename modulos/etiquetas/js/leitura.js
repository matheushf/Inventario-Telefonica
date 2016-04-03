$(document).ready(function () {
    id = $("#id").val();

    $("a").attr("style", "width: 150px");

    $("#acessar").on("click", function (event) {
        var localizacao = $("#localizacao").val();
        
        if (localizacao == '' || localizacao == null) {
            alert("Escolha a localizacção.");
            return;
        }
        
        $(this).after('<br><p id="loader"><i class="fa fa-refresh fa-spin"></i> Processando...</p>');
        $.ajax({
            type: 'POST',
            url: 'acoes.php',
            dataType: 'text',
            data: {
                acao: 'consultar_localizacao',
                local: $("select").val()
            },
            success: function (data) {
                console.log(data);

                if (data == 'erro') {
                    alert("Ocorreu um erro, tente novamente.");
                } else {
                    alert(data);
//                    return;
                    window.location.assign('?ident=' + data + '&localizacao=' + localizacao);
                }
                $("#loader").remove();
            }
        })

    })
//            alert(id);
    $("#nova").on("click", function () {
        window.location.assign('?id=' + id + '&nova=1');
    })

    $("#confirmar").on("click", function (event) {
        if ($("#quant_aferida").val() != $("#conf_quant").val()) {
            alert("A quantidade não confere.");
            event.preventDefault();
            return;
        }
    })
})