<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "db_todolist";


$db = mysqli_connect($hostname, $username, $password, $database_name);

if ($db->connect_error) {
    echo "Database Putus...";
    die();
}

// echo "Koneksi Nyambung";
?>