$("#btn-create-ingresso").click(function (event) {
    event.preventDefault();

    var options = {};

    // Starto la request di AJAX
    // Variable to hold request
    var request;

    if (request) {
        request.abort();
    }

    var $form = $("#f-ingresso");

    var serializedData = $form.serialize();

    options = {
        theme: "sk-cube-grid",
        message: "Registrazione Utente in corso...",
        backgroundColor: "#ccb300",
        textColor: "black"
    };

    HoldOn.open(options);
    // console.log(serializedData);

    request = $.ajax({
        url: "php/actions/save_ingresso.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        HoldOn.close();
        alert("Ingresso registrato");
<<<<<<< HEAD
        // location.href = "?p=1";
=======
        location.href = "?p=1";
>>>>>>> 550e05968cc389ee0f75b0f66b27174a6843a8f2
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        HoldOn.close();
        alert("Errore: " + errorThrown);
        console.log(errorThrown);
    });

    request.always(function () {

    });
<<<<<<< HEAD
});

$("#btn-save-ingresso").click(function (event) {
    event.preventDefault();

    var options = {};

    // Starto la request di AJAX
    // Variable to hold request
    var request;

    if (request) {
        request.abort();
    }

    var $form = $("#f-ingresso");

    var serializedData = $form.serialize();

    options = {
        theme: "sk-cube-grid",
        message: "Registrazione Utente in corso...",
        backgroundColor: "#ccb300",
        textColor: "black"
    };

    HoldOn.open(options);
    // console.log(serializedData);

    request = $.ajax({
        url: "php/actions/save_ingresso.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        HoldOn.close();
        alert("Ingresso salvato");
        location.href = "?p=1";
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        HoldOn.close();
        alert("Errore: " + errorThrown);
        console.log(errorThrown);
    });

    request.always(function () {

    });
});

$("#btn-delete-ingresso").click(function (event) {
    event.preventDefault();

    var options = {};

    // Starto la request di AJAX
    // Variable to hold request
    var request;

    if (request) {
        request.abort();
    }

    var $form = $("#f-ingresso");

    var serializedData = $form.serialize();

    options = {
        theme: "sk-cube-grid",
        message: "Registrazione Utente in corso...",
        backgroundColor: "#ccb300",
        textColor: "black"
    };

    HoldOn.open(options);
    // console.log(serializedData);

    request = $.ajax({
        url: "php/actions/delete_ingresso.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        HoldOn.close();
        alert("Ingresso salvato");
        location.href = "?p=1";
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        HoldOn.close();
        alert("Errore: " + errorThrown);
        console.log(errorThrown);
    });

    request.always(function () {

    });
=======
>>>>>>> 550e05968cc389ee0f75b0f66b27174a6843a8f2
});

// Altro javascript Pagina

$("#lov_tipo_incasso").change(function () {
    getQueryValueAsync("Select valore from anagrafica_incassi where id = " + $(this).val(), function (json) {
        $("#registro_incassi_Valore").val(json[0]["valore"]);
    });
});

$("#lov_users").on("change", function () {
    var idUser = $(this).val();
    if (idUser > 0) {
        // impostazione del tipo ingresso
        getQueryValueAsync("SELECT count(*) as num_free FROM registro_incassi WHERE id_user = " + idUser + " and id_tipo = 1", function (json) {
            isExpiredFree = json[0]["num_free"] >= 2 ? true : false;
            if (isExpiredFree) {
                getQueryValueAsync("SELECT tipo d, id r FROM anagrafica_incassi where id != 1", function (json) {
                    json2Lov("lov_tipo_incasso", json, "Tipo Ingresso");
                    $("#lov_tipo_incasso").prop("disabled", false);
                });
            } else {
                getQueryValueAsync("SELECT tipo d, id r FROM anagrafica_incassi", function (json) {
                    json2Lov("lov_tipo_incasso", json, "Tipo Ingresso");
                    $("#lov_tipo_incasso").prop("disabled", false);
                });
            }
        });
        // mostrare i dati della tessera cai
        getQueryValueAsync("SELECT Tessera_CAI as \"Tessera CAI\", anno_tessera as \"Anno Tessera\" FROM users WHERE id = " + idUser, function (json) {
            $("#dettTesseraCai").empty();
            $("#dettTesseraCai").append(json2Table(json[0]));
        });
    } else {
        $("#lov_tipo_incasso").prop("disabled", true);
    }
});