<?php
    class Query
    {

        function getValidUser($conn){

            $user = $_SESSION["username"];
            $pass = $_SESSION["password"];

            $sql = "SELECT count(*) FROM users WHERE username = '$user'";

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
        
    }

    $_query = new Query();
?>