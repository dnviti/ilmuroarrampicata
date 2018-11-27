$(document).ready(function () {
    $("#table_utenti").DataTable({
        "paging": true,
        "pagingType": "simple",
        "pageLength": 25,
        "lengthChange": true
    });
});