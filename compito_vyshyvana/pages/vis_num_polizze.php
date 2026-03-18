<?php
require "connection.php";

$query = "SELECT a.codice, a.sede, COUNT(p.codice) as numero_polizze  FROM Polizza p left join Assicurazione a on p.codice_assicurazione = a.codice WHERE a.sede = 'Milano' GROUP BY a.codice, a.sede";
$result = mysqli_query($connection, $query);

$message = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numero polizze per ogni assicurazione con sede a Milano</title>
</head>

<body>
    <h1>Numero polizze per ogni assicurazione con sede a Milano</h1>
    <table border="1">
        <tr>
            <th>Sede</th>
            <th>Numero polizze per sede</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $sede = $row['sede'];
            $numero_polizze = $row['numero_polizze'];
            echo "<tr>
                    <td>{$sede}</td>
                    <td>{$numero_polizze}</td>
                </tr>";
        }
        ?>
    </table>
    <br>
    <a href="../index.php">Torna alla home page</a>
</body>

</html>