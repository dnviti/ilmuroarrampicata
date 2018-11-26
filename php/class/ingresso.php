<?php
class Ingresso
{
    public $id_ingresso;

    public function register($params)
    {
        $conn = $GLOBALS["conn"];
        // return(var_dump($params));
        foreach ($params as $key => $value) {
            if ($params[$key] == '') {
                $params[$key] = 'NULL';
            } else {
                if (!is_numeric($params[$key])) {
                    $params[$key] = '\'' . $params[$key] . '\'';
                }
            }
        }
        $sql = "INSERT INTO registro_incassi (" . implode(",", array_keys($params)) . ") VALUES (" . implode(",", $params) . ")";
        //return(var_dump($sql));
        if ($conn->query($sql) === true) {
            return true;
        } else {
            die(header("HTTP/1.0 500 " . $conn->error));
            return "Error: " . $conn->error;
        }
    }

    public function update($id, $params)
    {
        $conn = $GLOBALS["conn"];
        $updVals = [];
        foreach ($params as $key => $value) {
            if ($params[$key] == '') {
                $params[$key] = 'NULL';
            } else {
                if (!is_numeric($params[$key])) {
                    $params[$key] = '\'' . $params[$key] . '\'';
                }
            }
        }
        foreach ($params as $key => $value) {
            array_push($updVals, $key . '=' . $value);
        }
        $sql = "UPDATE registro_incassi SET " . implode(",", $updVals) . " WHERE ID = $id";
        //return(var_dump($sql));
        if ($conn->query($sql) === true) {
            return true;
        } else {
            die(header("HTTP/1.0 500 " . $conn->error));
            return "Error: " . $conn->error;
        }
    }

    public function delete($id)
    {
        $conn = $GLOBALS["conn"];
        $sql = "DELETE FROM registro_incassi WHERE ID = $id";

        if ($conn->query($sql) === true) {
            return true;
        } else {
            die(header("HTTP/1.0 500 " . $conn->error));
            return "Error: " . $conn->error;
        }
    }
}
