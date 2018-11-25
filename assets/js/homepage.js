$(document).ready(function () {
    $("#table_ing_oggi").DataTable({
        "paging": true,
        "pagingType": "simple",
        "pageLength": 25,
        "lengthChange": true,
        "order": [
            [2, "asc"]
        ]
    });
});