<?php
require "connection.php";

$messaggio = "";

if(isset($_POST["submit"])){
    $codice_fiscale = $_POST['codice_fiscale'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $cognome = $_POST['cognome'] ?? '';
    $residenza = $_POST['residenza'] ?? '';

    if ($codice_fiscale) {
        $querryControlloPresenza = "SELECT * FROM Proprietario WHERE codice_fiscale = '$codice_fiscale'";
        $checkRes = mysqli_query($connection, $querryControlloPresenza);

        if (mysqli_num_rows($checkRes) > 0) {
            $message = "Errore: il proprietario gia' presente";
        } else {
            $insertQ = "INSERT INTO Proprietario (codice_fiscale, cognome, nome, residenza) VALUES ('$codice_fiscale', '$cognome', '$nome', '$residenza')";
            if (mysqli_query($connection, $insertQ)) {
                $message = "Proprietario inserito";
            } else {
                $message = "Errore durante l'inserimento: " . mysqli_error($connection);
            }
        }
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento del proprietario</title>
</head>
<body>

    <h1>Inserisci i dati del proprietario da inserire</h1>

    <?php if ($message): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label for="codice_fiscale">Codice fiscale: </label>
        <input type="text" name="codice_fiscale">
        <br>
        <label for="cognome">Cognome:</label>
        <input type="text" name="cognome">
        <br>
        <label for="nome">Nome:</label>
        <input type="text" name="nome">
        <br>
        <label for="residenza">Residenza:</label>
        <input type="text" name="residenza">
        <br>
        <button type="submit" name="submit">Inserisci</button>
    </form>
    <br>
    <a href="../index.php">Torna alla home page</a>
</body>
</html>