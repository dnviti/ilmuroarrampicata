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
        alert("Ingresso registrato");
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

// Altro javascript Pagina

$("#lov_tipo_incasso").change(function () {
    var newValue = getQueryValue(
        "Select valore from anagrafica_incassi where id = " + $(this).val());
    $("#registro_incassi_Valore").val(newValue["valore"]);
});