<?php
class User
{
    public $username;

    function register()
    {
        $sql = "INSERT INTO users (" . implode(",", array_keys($params)) . ") VALUES (" . implode("','", $params) . ")";
        return $sql;
        if ($conn->query($sql) === true) {
            return true;
        } else {
            return "Error: " . $conn->error;
        }
    }

    function login($conn, $user, $pass)
    {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "SELECT username FROM users WHERE upper(username) = upper('$user') and password is not null";

        $userRow = $conn->query($sql);

        if ($userRow->num_rows > 0) {
            $this->username = $user;
            return true;
        } else {
            return false;
        }
    }

    function isValid($conn, $user)
    {
        $sql = "SELECT 1 FROM users WHERE upper(username) = upper('$user')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function isAdmin($conn, $user = null)
    {
        $sql = "SELECT 1 FROM users WHERE upper(username) = upper('$user') and id_role = 2";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>