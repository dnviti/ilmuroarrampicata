<?php
// Cambia la directory con la root del progetto
chdir('../../');
require_once("php/config/requires.php");

$_ingresso = new Ingresso();

if (!isset($_POST["ID"]) || $_POST["ID"] == "" || $_POST["ID"] == " ") {
    $params = array(
        "ID_USER" => $_POST["ID_USER"],
        "ID_TIPO" => $_POST["ID_TIPO"],
        "VALORE" => $_POST["VALORE"],
        "DATA" => $_POST["DATA"],
        "NOTE" => $_POST["NOTE"],
        "ID_USERRE" => $_POST["ID_USERRE"]
    );
    return($_ingresso->register($params));
} else {
    $params = array(
        "ID_USER" => $_POST["ID_USER"],
        "ID_TIPO" => $_POST["ID_TIPO"],
        "VALORE" => $_POST["VALORE"],
        "DATA" => $_POST["DATA"],
        "NOTE" => $_POST["NOTE"]//,
        // "ID_USERRE" => $_POST["ID_USERRE"]
    );
    
    return($_ingresso->update($_POST["ID"], $params));
}
