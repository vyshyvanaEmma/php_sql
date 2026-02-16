<?php
$host = "localhost";
$db = "classicmodels";
$user = "root";
$password = "";

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    die("Errore di connessione: " . mysqli_connect_error());
}
?>