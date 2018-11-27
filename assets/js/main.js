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

    return jsonRes;
}

function getQueryValueAsync(sql, callback) {
    var jsonRes;
    request = $.ajax({
        url: "php/actions/query.php",
        type: "post",
        dataType: "json",
        data: {
            "QUERY": sql
        },
        cache: false,
        async: true,
    });

    request.done(function (response, textStatus, jqXHR) {
        callback(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error(errorThrown);
    });

    request.always(function () {

    });
}

function json2Lov(lovId, jsonDict, nullDisplay) {
    let dropdown = $("#" + lovId);

    dropdown.empty();

    dropdown.append("<option selected disabled>" + nullDisplay + "</option>");
    dropdown.prop("selectedIndex", 0);

    // Populate dropdown with list of provinces
    $(jsonDict).each(function (i, v) {
        dropdown.append($("<option></option>").attr("value", v["r"]).text(v["d"]));
    });

    return dropdown;
}

function json2Table(tableData) {
    var table = $("<table class=\"table table-striped\"></table>");
    var thead = $("<thead></thead>");
    var hrow = $("<tr></tr>");
    var tbody = $("<tbody></tbody>");
    $(tableData).each(function (i, browData) {
        var brow = $("<tr></tr>");
        $.each(browData, function (j, cellData) {
            hrow.append($("<th>" + j + "</th>"));
            brow.append($("<td>" + cellData + "</td>"));
        });
        table.append(thead);
        thead.append(hrow);
        tbody.append(brow);
        table.append(tbody);
    });
    return table;
}

function convertToCSV(objArray) {
    var array = typeof objArray != "object" ? JSON.parse(objArray) : objArray;
    var str = "";

    for (var i = 0; i < array.length; i++) {
        var line = "";
        for (var index in array[i]) {
            if (line != "") line += ";";

            line += array[i][index];
        }

        str += line + "\r\n";
    }

    return str;
}

function exportCSVFile(jsonObject, fileTitle) {

    var csv = this.convertToCSV(jsonObject);

    var exportedFilenmae = fileTitle + ".csv" || "export.csv";

    var blob = new Blob([csv], {
        type: "text/csv;charset=utf-8;"
    });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = "hidden";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}