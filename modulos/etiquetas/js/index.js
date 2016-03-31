$(document).ready(function () {
    $("#gerar-qr").on("click", function () {

//                    $.ajax({
//                        type: 'POST',
//                        url: 'acoes.php',
//                        async: false,
//                        data: {
//                            acao: 'gerar_qr'
//                        },
//                        success: function (data) {
//                            if (data == 'erro') {
//                                alert("Ocorreu um erro, tente novamente.");
//                            } else {
//                                nome_pasta = data;
//                            }
//                        }
//                    })


//                    $.ajax({
//                        type: 'POST',
//                        url: 'acoes.php',
//                        async: false,
//                        data: {
//                            acao: 'diretorio_image'
//                        },
//                        success: function (data) {
//                            if (data == 'erro') {
//                                alert("Ocorreu um erro, tente novamente.");
//                            } else {
//                                nome_pasta = data;
//                            }
//                        }
//                    })

        var i = 0;
        ArrayCodMaterial = [];
        ArrayNomeMaterial = [];
        ArrayUnidadeMedida = [];
        ArrayCentro = [];
        ArrayQtdEtiquetas = [];
        ArrayId = [];

        $("input:checked").not("#check_all").each(function () {

            var CodigoMaterial = $(this).parentsUntil("tr").nextAll().find("input:hidden.mate_codigo").val();
            var NomeMaterial = $(this).parentsUntil("tr").nextAll().find("input:hidden.mate_nome").val();
            var UnidadeMedida = $(this).parentsUntil("tr").nextAll().find("input:hidden.unidade_medida").val();
            var Centro = $(this).parentsUntil("tr").nextAll().find("input:hidden.depo_centro").val();
            var QtdEtiquetas = $(this).parentsUntil("tr").nextAll().find("input:hidden.qtde_etiqueta").val();
            var Id = $(this).val();

            ArrayCodMaterial[i] = CodigoMaterial;
            ArrayNomeMaterial[i] = NomeMaterial;
            ArrayUnidadeMedida[i] = UnidadeMedida;
            ArrayCentro[i] = Centro;
            ArrayQtdEtiquetas[i] = QtdEtiquetas;
            ArrayId[i] = Id;

            i = i + 1;
        })

        $.ajax({
            type: 'POST',
            url: 'acoes.php',
//                            async: false,
            data: {
                acao: 'gerar_qr',
                id: ArrayId,
                cod_mate: ArrayCodMaterial,
                nome_mate: ArrayNomeMaterial,
                unidade_medida: ArrayUnidadeMedida,
                centro: ArrayCentro,
                qtde_etq: ArrayQtdEtiquetas,
//                            folder: nome_pasta
            },
            success: function (data) {
                nome_pdf = data;
                
                $("#download").attr("href", data);
                $("#download span").trigger('click');
                console.log(data);
            }
        })




        // Gerar PDF
//                    $.ajax({
//                        type: 'POST',
//                        url: 'acoes.php',
//                        async: false,
//                        data: {
//                            acao: 'gerar_pdf_etiqueta',
//                            folder: nome_pasta
//                        },
//                        success: function (data) {
//                            $("#download").attr("href", data);
//                            $("#download span").trigger('click');
//
//                            nome_pdf = data;
//                        }
//                    })
//                    

//        $("#download span").on("click", function () {
//
//alert(nome_pdf);
//            // Deletar PDF
//            $.ajax({
//                type: 'POST',
//                url: 'acoes.php',
//                async: false,
//                data: {
//                    acao: 'deletar_pdf',
//                    arquivo: nome_pdf
//                },
//                success: function (data) {
//                }
//            })
//        })

    })
})