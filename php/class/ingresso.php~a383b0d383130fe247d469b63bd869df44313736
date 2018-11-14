<?php
class Ingresso
{
    public $id_ingresso;

    public function register($params)
    {
        $conn = $GLOBALS["conn"];
        //var_dump($params);
        $sql = "INSERT INTO registro_incassi (" . implode(",", array_keys($params)) . ") VALUES ('" . implode("','", $params) . "')";

        if ($conn->query($sql) === true) {
            return true;
        } else {
            return "Error: " . $conn->error;
        }
    }
}
