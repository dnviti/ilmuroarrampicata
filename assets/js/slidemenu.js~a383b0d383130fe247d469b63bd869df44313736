$("#slnav-logout").click(function (event) {

    event.preventDefault();

    var options = {};

    // Starto la request di AJAX
    // Variable to hold request
    var request;

    if (request) {
        request.abort();
    }

    options = {
        theme: "sk-cube-grid",
        message: "Uscita in corso...",
        backgroundColor: "#ccb300",
        textColor: "black"
    };

    HoldOn.open(options);
    //alert(serializedData);

    request = $.ajax({
        url: "php/actions/logout.php",
        type: "post",
        data: ""
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        //console.log(response);
        //alert(response);
        location.reload();
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        HoldOn.close(options);
        alert(textStatus);
        //alert("Errore sconosciuto, riprovare");
        // Per debug
        /*console.error(
            "The following error occurred: " +
            textStatus, errorThrown
        );*/
    });

    request.always(function () {

    });

});