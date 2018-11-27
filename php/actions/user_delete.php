<?php
// Cambia la directory con la root del progetto
chdir('../../');
require_once("php/config/requires.php");

$_user = new User();

$_user->delete($_POST["ID"]);
