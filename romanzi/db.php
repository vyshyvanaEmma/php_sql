<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "romanzi";

    $conn = mysqli_connect($host, $user, $pass, $db);   
    if (mysqli_connect_errno()) {   
        echo "Errore di connessione: " . mysqli_connect_error();
        exit();
    }
?>



