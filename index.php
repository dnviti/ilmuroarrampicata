<?php
session_start();
// Define what is necessary in requires.php file
require_once("php/config/requires.php");

//_SESSION["USER"] = new User();
//$_SESSION["USERNAME"] = '';
//$_SESSION["USERNAME"] = null;

//$_SESSION["IS_ADMIN"] = $_user->isAdmin($GLOBALS["conn"], $_SESSION["USERNAME"]);
    // pages object

$_pages = new Page();


    // Prints the cached page

//var_dump($_SESSION["USERNAME"]);

//if (!$_SESSION["USER"]->isValidUser($conn, $_SESSION["USERNAME"])) {
if (isset($_SESSION["USERNAME"]) || isset($_COOKIE["USERNAME"])) {
    // Caricamento pagine
    $_pages->getPage($_GET["p"]);
    // switch ($_GET["p"]) {
    //     case 7:
    //         echo $_pages->register(7);
    //         break;
    //     case 1:
    //         echo $_pages->home(1);
    // }

} else {
    echo $_pages->login();
}

?>