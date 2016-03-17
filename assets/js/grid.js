/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    $("#btn-novo").on("click", function () {
        window.location.assign("form.php?operacao=inserir");
    })

    $("#editar").on("click", function () {
        // TODO implementar editar pegando id
    })

    // Marcar linha clicada na grid
    var selecionado = null;

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
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });
})