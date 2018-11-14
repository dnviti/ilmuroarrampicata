<?php
// Cambia la directory con la root del progetto
chdir('../../');
require_once("php/config/requires.php");

$_user = new User();

$params = array(
    "USERNAME" => $_POST["USERNAME"],
    "PASSWORD" => password_hash($_POST["PASSWORD"], PASSWORD_DEFAULT),
    "EMAIL" => $_POST["EMAIL"],
    "ID_ROLE" => $_POST["ID_ROLE"],
    "NOME" => $_POST["NOME"],
    "COGNOME" => $_POST["COGNOME"],
    "TESSERA_CAI" => $_POST["TESSERA_CAI"],
    "SEZ_TESSERA" => $_POST["SEZ_TESSERA"],
    "DATA_NASCITA" => $_POST["DATA_NASCITA"],
    "NOTE" => $_POST["NOTE"],
    "ANNO_TESSERA" => $_POST["ANNO_TESSERA"],
    "ID_USERRE" => $_POST["ID_USERRE"]
);

$_user->register($params);
