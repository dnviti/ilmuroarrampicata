<?php
class User
{
    public $username;
    public $user_id;

    public function register($params)
    {
        $conn = $GLOBALS["conn"];
        //var_dump($params);
        $sql = "INSERT INTO users (" . implode(",", array_keys($params)) . ") VALUES ('" . implode("','", $params) . "')";
        if ($conn->query($sql) === true) {
            return true;
        } else {
            return "Error: " . $conn->error;
        }
    }

    public function recoverPass($params)
    {
        $newPass = $params[2];
        $username = $params[0];
        $conn = $GLOBALS["conn"];
        //var_dump($params);
        $sql = "UPDATE users set password = '$newPass' where upper(username) = upper('$username')";
        if ($conn->query($sql) === true) {
            return true;
        } else {
            return "Error: " . $conn->error;
        }
    }

    public function login($conn, $user, $pass)
    {
        $sql = "SELECT password, id FROM users WHERE upper(username) = upper('$user')";

        //var_dump($sql);

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $queryRes = $result->fetch_array();
            $passHash = $queryRes[0];
            
            $userid = $queryRes[1];

            $pass = password_verify($pass, $passHash);
            if ($pass) {
                $this->username = $user;
                $this->user_id = $userid;

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isValid($conn, $user)
    {
        $sql = "SELECT 1 FROM users WHERE upper(username) = upper('$user')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin($conn, $user = null)
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
