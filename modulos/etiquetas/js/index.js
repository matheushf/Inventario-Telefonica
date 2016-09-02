$(document).ready(function () {
    $("#gerar-qr").on("click", function () {
        $(this).after('<br><p id="loader"><i class="fa fa-refresh fa-spin"></i> Gerando PDF...</p>');

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
        });

        $.ajax({
            type: 'POST',
            url: 'acoes.php',
            data: {
                acao: 'gerar_qr',
                id: ArrayId,
                cod_mate: ArrayCodMaterial,
                nome_mate: ArrayNomeMaterial,
                unidade_medida: ArrayUnidadeMedida,
                centro: ArrayCentro,
                qtde_etq: ArrayQtdEtiquetas,
            },
            success: function (data) {
                nome_pdf = data;
                $("#download").attr("href", data);
                $("#download span").trigger('click');
                console.log(data);

                $("#loader").remove();
            }
        })

    })

    $("#btn-leitura").click(function () {
        if (!(id = PegarId())) {
            return false;
        }

        window.location.assign("mleitura.php?id=" + id);
    })

});