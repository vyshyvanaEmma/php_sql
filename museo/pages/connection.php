<?php
$host="localhost";
$db="compito17_03_25";
$username="root";
$password="";

$connection = mysqli_connect($host, $username, $password, $db);

if(!$connection){
    die("Connessione fallita: " . mysqli_connect_error());
}
?>