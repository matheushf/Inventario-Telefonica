$(document).ready(function () { 
    $("#leitura").change(function () {
        var leitura_valor = $(this).val();
        
        if ($("input:checked").length == 0) {
            alert("Selecione um depósito.");
            return;
        }
        
        if (confirm("Deseja alterar a leitura?")) {
            $("input:checked").each(function () {
                var id = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'acoes.php',
                    data: {
                        acao: 'alterar_leitura',
                        id: id,
                        leitura: leitura_valor
                    },
                    success: function (data) {
                        if (data == 'OK') {
                            $("td#depo_leitura" + id).html(leitura_valor);
                        }
                    }
                })

            })
        }
    })

})