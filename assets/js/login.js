$("#btn-login").click(function (event) {

    event.preventDefault();

    var options = {};

    // Starto la request di AJAX
    // Variable to hold request
    var request;

    if (request) {
        request.abort();
    }

    var $form = $("#f-login");

    var serializedData = $form.serialize();

    options = {
        theme: "sk-cube-grid",
        message: "Login in corso...",
        backgroundColor: "#ccb300",
        textColor: "black"
    };

    HoldOn.open(options);
    //alert(serializedData);

    request = $.ajax({
        url: "php/actions/login.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
        // Log a message to the console
        options = {
            theme: "sk-cube-grid",
            message: "Login effettuato. Caricamento della Home...",
            backgroundColor: "#ccb300",
            textColor: "black"
        };

        HoldOn.open(options);

        // setting cookies
        if ($("#cookiesOnBtn").attr("aria-pressed") == "true") {
            document.cookie = "USERNAME=" + $("#USERNAME").val();
        }

        console.log(response);
        //alert(response);
        location.href = "?p=1";
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        HoldOn.close();

        options = {
            theme: "custom",
            content: "", //Image
            message: "<img src=\"assets/img/login-error.png\"><br><span style=\"font-weight: bolder\">" + errorThrown + "<br><button type=\"submit\" id=\"btn-close-holdon\" class=\"btn btn-dark\" style=\"margin-top: 10px;font-weight: bolder\" onclick=\"HoldOn.close()\">Torna al Login</button>",
            backgroundColor: "#c82333",
            textColor: "white"
        };

        HoldOn.open(options);



        //HoldOn.close();
        //alert(textStatus);
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

$("#cookiesOnBtn").on("click", function (e) {

    var cookies = "false";

    //if ($(this).attr("aria-pressed") == "false") {
    if ($(this).hasClass("btn-danger")) {
        if (confirm("Confermando questa impostazione verranno utilizzati i cookies per memorizzare il nome utente, continuare?")) {
            $(this).html("Ricordami: Sì");
            $(this).removeClass("btn-danger");
            $(this).addClass("btn-success");
            $(this).css("font-weight", "500");
            //$(this).attr("aria-pressed", "true");
            $(this).button("toggle");
            cookies = "true";
        } else {
            $(this).html("Ricordami: No");
            $(this).removeClass("btn-success");
            $(this).addClass("btn-danger");
            $(this).css("font-weight", "");
            //$(this).attr("aria-pressed", "true");
            $(this).button("toggle");
        }
    } else {
        $(this).html("Ricordami: No");
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).css("font-weight", "");
        //$(this).attr("aria-pressed", "true");
        $(this).button("toggle");
    }

    $("#cookiesOn").val(cookies);

    createCookie("COOKIES", cookies, 30);
    //document.cookie = "COOKIES=" + cookies;

});

$(document).ready(function () {
    var cookies = "false";

    if (readCookie("COOKIES") == "true") {
        $("#cookiesOnBtn").html("Ricordami: Sì");
        $("#cookiesOnBtn").removeClass("btn-danger");
        $("#cookiesOnBtn").addClass("btn-success");
        $("#cookiesOnBtn").css("font-weight", "500");
        //$("#cookiesOnBtn").attr("aria-pressed", "false");
        cookies = "true";
    } else {
        $(this).html("Ricordami: No");
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).css("font-weight", "");
        //$(this).attr("aria-pressed", "false");
    }

    $("#cookiesOn").val(cookies);

    createCookie("COOKIES", cookies, 30);
});

$("#change-pass").click(function () {
    console.log("changing password");
});