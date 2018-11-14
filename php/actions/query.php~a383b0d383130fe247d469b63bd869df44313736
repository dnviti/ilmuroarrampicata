<?php
// Cambia la directory con la root del progetto
chdir('../../');
require_once("php/config/requires.php");

$_component = new Component();

$sql = $_POST["QUERY"];

$jsonRes = $_component->valueFromQuery($sql);

// var_dump($jsonRes);
//$return = $_POST;

//$return = $jsonRes;
echo $jsonRes;

// return $jsonRes;
