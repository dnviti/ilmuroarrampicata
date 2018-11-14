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
<<<<<<< HEAD
        HoldOn.close();
=======
>>>>>>> e5a08dc4f6f9c331ad7d16fd3bc73e918f6d3adf
        alert("Utente registrato con successo");
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
<<<<<<< HEAD
        HoldOn.close();
=======
>>>>>>> e5a08dc4f6f9c331ad7d16fd3bc73e918f6d3adf
        alert("Errore: " + errorThrown);
        console.log(errorThrown);
    });

    request.always(function () {

    });

});