$("#btn-register").click(function (event) {

    // controlli sui campi obbligatori

    var err = 0;
    $("input, select, textarea").each(function () {
        // tipo valore nullo
        switch ($(this).attr("aria-nullable")) {
            case "NO":
                if ($(this).val() == "" && $(this).attr("NAME") != "ID") {
                    $(this).css("border", "red solid 2px");
                    console.log($(this).attr("ID") + " --> " + $(this).val());
                    err++;
                } else {
                    $(this).css("border", "");
                }
                break;
            case "YES":
                $(this).val() == "" ? $(this).css("border", "") : null;
                break;
        }
        // controlli sui valori specifici (email, regole password, regole username...)
        // ...
    });

    if (err > 0) {
        alert("Informazioni Mancanti!");
    } else {


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

        console.log(serializedData);

        options = {
            theme: "sk-cube-grid",
            message: "Registrazione Utente in corso...",
            backgroundColor: "#ccb300",
            textColor: "black"
        };

        HoldOn.open(options);
        // console.log(serializedData);

        request = $.ajax({
            url: "php/actions/user_register.php",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            HoldOn.close();
            alert("Utente registrato con successo");
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
    }
});

$("#btn-save").click(function (event) {
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
        message: "Salvataggio Utente in corso...",
        backgroundColor: "#ccb300",
        textColor: "black"
    };

    HoldOn.open(options);
    // console.log(serializedData);

    request = $.ajax({
        url: "php/actions/user_register.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        HoldOn.close();
        alert("Salvataggio Completato");
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

$("#btn-delete").click(function (event) {
    event.preventDefault();

    if (confirm("Eliminare questo utente?")) {
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
            message: "Cancellazione Utente in corso...",
            backgroundColor: "#ccb300",
            textColor: "black"
        };

        HoldOn.open(options);
        // console.log(serializedData);

        request = $.ajax({
            url: "php/actions/user_delete.php",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            HoldOn.close();
            alert("Utente Cancellato");
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
    }
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

    $("#users_Username")
        .val(userArr[0].toLowerCase() + "." + userArr[1].toLowerCase());
});