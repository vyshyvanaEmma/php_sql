<?php

$hostname = "localhost";
$username = "root";
$db = "assicurazioni";
$password = "";

$connection = mysqli_connect($hostname, $username, $password, $db);

if (! $connection) {
    die("Errore di connesione" . mysqli_connect_error());
}
