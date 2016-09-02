/*
$(function () {

    bobina = $("#bobina");
    material = $("#mate_material");
    quantidade = $("#quantidade");

    $("#bobina label").append('<small><strong> (Separe por #) </strong></small>');

    if ($("#mate_material option:selected").text().match(/bobina/gi)) {
        addBobina(true);
    } else {
        $("#bobina").hide();
    }

    // Caso seja bobina
    quantidade.focusout(function () {

        if ($("#mate_material option:selected").text().match(/bobina/gi) && quantidade.val() != '') {
            addBobina();
            $("#bobina").show();

        } else {
            $("#bobina").hide();
        }
    });

});

function addBobina(popular) {

    var bobinas = (popular) ? $("#bobina_valor").val().split('#') : [];

    bobina.html("<label for='id_bobina" + i + "'> ID's Bobinas </label>");
    for (var i = 1; i <= quantidade.val(); i++) {
        bobina.append("<input type='text' name='id_bobina[]' id='id_bobina" + i + "' class='form-control' value='"
            + (bobinas[i - 1] ? bobinas[i - 1] : '')
            + "'>");
    }
}*/
