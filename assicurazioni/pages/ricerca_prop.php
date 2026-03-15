<?php
require "connection.php";
$query = "SELECT DISTINCT codice_fiscale FROM Proprietario";
$result = mysqli_query($connection, $query);

$message = "";
$codFiscSelected = false;

if (isset($_POST["submit"])) {
    $codFiscale = $_POST['codFiscale'] ?? '';
    if (!$codFiscale) {
        $message = "ERRORE: Seleziona codice fiscale";
    } else {
        $codFiscSelected = true;
        $queryAuto = "SELECT targa, marca from Automobile a join Proprietario p on a.cf_proprietario = p.codice_fiscale WHERE cf_proprietario = '$codFiscale'";
        $resQueryAuto = mysqli_query($connection, $queryAuto);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca del proprietario</title>
</head>

<body>
    <h1>Ricerca del proprietario</h1>

    <?php if ($message): ?>
        <?php echo $message ?>
    <?php endif; ?>

    <form method="POST">
        <label for="codFiscale">Inserisci il codice fiscale del proprietario:</label>
        <select name="codFiscale" id="codFiscale">
            <option value="">---Seleziona un codicfe fiscale---</option>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $codFiscale = $row['codice_fiscale'];
                echo "<option>{$codFiscale}</option>";
            }
            ?>
        </select>
        <br>
        <button name="submit" type="submit">Seleziona</button>
    </form>
    <br>
    <?php if ($codFiscSelected): ?>
        <?php
        while ($row = mysqli_fetch_assoc($resQueryAuto)) {
            $autoList[] = $row;
        }
        ?>
        <label for="">Auto del proprietario: <?php echo $codFiscale; ?></label>
        <ul>
            <?php foreach ($autoList as $auto): ?>
                <li><?php echo "Targa: " . $auto['targa'] . " - " . "Marca: " . $auto['marca']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>

</html>