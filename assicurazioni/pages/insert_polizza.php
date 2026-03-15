<?php
require "connection.php";

// Recupera codici assicurazione
$query = "SELECT codice FROM Assicurazione ORDER BY codice ASC";
$result = mysqli_query($connection, $query);

$message = "";

if (isset($_POST['submit'])) {
    $assicurazione_id = $_POST['assicurazione_id'] ?? '';
    $data_scadenza = $_POST['data_scadenza'] ?? '';

    if ($assicurazione_id && $data_scadenza) {
        // controllo polizza esistente
        $checkQ = "SELECT * FROM Polizza WHERE codice_assicurazione = $assicurazione_id";
        $checkRes = mysqli_query($connection, $checkQ);

        if (mysqli_num_rows($checkRes) > 0) {
            $message = "Errore: polizza già presente per questa assicurazione e data.";
        } else {
            // inserimento polizza
            $insertQ = "INSERT INTO Polizza (data_scadenza, codice_assicurazione) VALUES ('$data_scadenza', $assicurazione_id)";
            if (mysqli_query($connection, $insertQ)) {
                $message = "Polizza inserita correttamente!";
            } else {
                $message = "Errore durante l'inserimento: " . mysqli_error($connection);
            }
        }
    } else {
        $message = "Seleziona un'assicurazione e inserisci la data di scadenza";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento della polizza</title>
</head>
<body>
    <h1>Inserisci polizza</h1>

    <?php if ($message): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label for="assicurazione">Seleziona assicurazione:</label>
        <select name="assicurazione_id" id="assicurazione">
            <option value="">--- seleziona un codice d'assicurazione ---</option>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $cod = $row['codice'];
                echo "<option value='$cod'>$cod</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="data_scadenza">Data di scadenza:</label>
        <input type="date" id="data_scadenza" name="data_scadenza">
        <br><br>
        <button type="submit" name="submit">Inserisci polizza</button>
    </form>
</body>
</html>