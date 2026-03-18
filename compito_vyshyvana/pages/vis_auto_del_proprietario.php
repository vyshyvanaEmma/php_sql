<?php
require "connection.php";

$querryCodFiscProp = "SELECT codice_fiscale FROM Proprietario";
$risCodFiscPropi = mysqli_query($connection, $querryCodFiscProp);

$cod_fisc_selected = false;
$message = "";

if (isset($_POST["submit"])) {
    $codFiscale = $_POST['codFiscale'] ?? '';
    if (!$codFiscale) {
        $message = "ERRORE: Seleziona codice fiscale";
    } else {
        $cod_fisc_selected = true;
        $queryAuto = "SELECT * from Automobile a join Proprietario p on a.cf_proprietario = p.codice_fiscale WHERE cf_proprietario = '$codFiscale'";
        $resQueryAuto = mysqli_query($connection, $queryAuto);
        if (mysqli_num_rows($resQueryAuto) <= 0) {
            $message = "Il proprietario non possiede un automobile";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto di un determinato proprietario</title>
</head>

<body>
    <h1>Scegli il proprietario:</h1>

    <?php if ($message): ?>
        <?php echo $message ?>
    <?php endif; ?>

    <form method="POST">
        <p>Inserisci il codice fiscale del proprietario:</p>
        <select name="codFiscale" id="codFiscale">
            <option value="">--- Seleziona il codice fiscale---</option>
            <?php
            while ($row = mysqli_fetch_assoc($risCodFiscPropi)) {
                $codFiscale = $row['codice_fiscale'];
                echo "<option>{$codFiscale}</option>";
            }
            ?>
        </select>
        <br>
        <button name="submit" type="submit">Seleziona</button>
    </form>

    <br>
    <?php if ($cod_fisc_selected): ?>
        <?php
        while ($row = mysqli_fetch_assoc($resQueryAuto)) {
            $autoList[] = $row;
        }
        ?>
        <label for="">Auto del proprietario: <?php echo $codFiscale; ?></label>
        <ul>
            <?php if (!empty($autoList)): ?>
                <?php foreach ($autoList as $auto): ?>
                    <li><?php echo "Targa: " . $auto['targa'] . " - " . "Marca: " . $auto['marca'] . " - " . "Cilindrata: " . $auto['cilindrata'] . " - " . "Potenza: " . " - " . $auto['potenza']; ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php echo $message; ?>
        </ul>
    <?php endif; ?>
    <br>
    <a href="../index.php">Torna alla home page</a>
</body>

</html>