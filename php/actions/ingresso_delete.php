<?php
// Cambia la directory con la root del progetto
chdir('../../');
require_once("php/config/requires.php");

$_ingresso = new Ingresso();

$_ingresso->delete($_POST["ID"]);
