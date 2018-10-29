<?php
session_start();
// Cambia la directory con la root del progetto
chdir('../../');
require_once("php/config/requires.php");

$_user = new User();

/*
if (!isset($_COOKIE["USER"])) {
    $_SESSION["USER"] = new User();
    $_user = $_SESSION["USER"];
} else {
    $_user = $_COOKIE["USER"];
}
 */

if ($_user->login($GLOBALS["conn"], $_POST["USERNAME"], 'a')) {

    $_SESSION["USERNAME"] = $_user->username;
    $_SESSION["IS_ADMIN"] = $_user->isAdmin($GLOBALS["conn"], $_POST["USERNAME"]);
    //$_SESSION["PAGE"] = 1;
    die($_user->username);

} else {
    session_abort();
    //die(header("HTTP/1.0 404 Not Found"));
    die(header("HTTP/1.0 404 Dati Errati"));
}

?>