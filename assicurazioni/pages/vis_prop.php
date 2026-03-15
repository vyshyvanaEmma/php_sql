<?php
require "connection.php";

$query = "SELECT p.codice_fiscale, p.nome, p.cognome, COUNT(ac.id_sinistro) as numero_incidenti  FROM Proprietario p left join Automobile a on p.codice_fiscale = a.cf_proprietario left join AutoCoinvolte ac on ac.targa = a.targa GROUP BY p.codice_fiscale, p.nome, p.cognome";
$result = mysqli_query($connection, $query);

$message = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizzare auto e il numero di incidenti per proprietazio</title>
</head>
<body>
    <h1>Visualizzare auto e il numero di incidenti per proprietazio</h1>
    <table border="1">
        <tr>
            <th>Proprietario</th>
            <th>Numero degli incidenti avuti</th>
        </tr>
        <?php
            while($row = mysqli_fetch_assoc($result)){
                $nome = $row['nome'];
                $cognome = $row['cognome'];
                $numero_incidenti = $row['numero_incidenti'];
                echo "<tr>
                    <td>{$nome} {$cognome}</td>
                    <td>{$numero_incidenti}</td>
                </tr>";
            }
        ?>
    </table>
</body>
</html>