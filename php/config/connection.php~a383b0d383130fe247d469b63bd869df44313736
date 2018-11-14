<?php

$_mysql = $_config["mysql"];

    // Create connection
$conn = new mysqli($_mysql["servername"], $_mysql["username"], $_mysql["password"], $_mysql["database"]);

$GLOBALS["conn"] = $conn;

    // Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>