<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "lib_db";

$con = mysqli_connect($host, $user, $pass, $dbname);

if (!$con) {
    echo "Error: Mysql Connection Error";
}

?>