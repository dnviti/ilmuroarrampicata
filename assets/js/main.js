$(document).ready(function () {
    $("input[type=date]").each(function () {
        if ($(this).val().length > 0) {
            $(this).addClass("full");
        } else {
            $(this).removeClass("full");
        }
    });
    $("input[type=date]").on("change", function () {
        if ($(this).val().length > 0) {
            $(this).addClass("full");
        } else {
            $(this).removeClass("full");
        }
    });
});

// Cookies
function createCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }

    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function getQueryValue(sql) {
    var jsonRes;
    request = $.ajax({
        url: "php/actions/query.php",
        type: "post",
        dataType: "json",
        data: {
            "QUERY": sql
        },
        cache: false,
        async: false,
    });

    request.done(function (response, textStatus, jqXHR) {
        jsonRes = response;
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error(errorThrown);
    });

    request.always(function () {

    });

    return jsonRes[0];
}