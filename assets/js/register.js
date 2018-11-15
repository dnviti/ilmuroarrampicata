$("#btn-register").click(function (event) {

    event.preventDefault();

    var options = {};

    // Starto la request di AJAX
    // Variable to hold request
    var request;

    if (request) {
        request.abort();
    }

    var $form = $("#f-register");

    var serializedData = $form.serialize();

    options = {
        theme: "sk-cube-grid",
        message: "Registrazione Utente in corso...",
        backgroundColor: "#ccb300",
        textColor: "black"
    };

    HoldOn.open(options);
    //console.log(serializedData);

    request = $.ajax({
        url: "php/actions/register.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        HoldOn.close();
        alert("Utente registrato con successo");
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

// altro javascript
var userArr = ["", ""];
$("#users_Nome, #users_Cognome").on("keyup", function () {
    
    if ($(this).attr("ID") == "users_Nome") {
        userArr[0] = $(this).val();
    }
    if ($(this).attr("ID") == "users_Cognome") {
        userArr[1] = $(this).val();
    }

    $("#users_Username").val(userArr[0].toLowerCase() + "." + userArr[1].toLowerCase());

});