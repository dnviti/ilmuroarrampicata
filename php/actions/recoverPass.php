<?php
// Cambia la directory con la root del progetto
chdir('../../');
require_once("php/config/requires.php");

$_user = new User();

if ($_POST["NEW_PASSWORD"] === $_POST["OLD_PASSWORD"]) {
    $params = array(
        "USERNAME" => $_POST["USERNAME"],
        "OLD_PASSWORD" => $_POST["OLD_PASSWORD"],
        "NEW_PASSWORD" => password_hash($_POST["NEW_PASSWORD"], PASSWORD_DEFAULT)
    );

    $_user->recoverPass($params);
} else {
    die(header("HTTP/1.0 404 Le password non corrispondono"));
}
