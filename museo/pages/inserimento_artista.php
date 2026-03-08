<?php
require "connection.php";

$messaggio = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome_artista"];
    $cognome = $_POST["cognome_artista"];
    $anno = $_POST["anno_nascita_artista"];

    $queryControllo = "SELECT * FROM artista WHERE nome_artista='$nome' AND cognome_artista='$cognome'";
    $risultato = mysqli_query($connection, $queryControllo);

    if (mysqli_num_rows($risultato) > 0) {
        $messaggio = "artista già presente in db";
    } else {

        $queryInsert = "INSERT INTO artista(nome_artista, cognome_artista, anno_nascita_artista)
                        VALUES('$nome','$cognome','$anno')";

        mysqli_query($connection, $queryInsert);

        $messaggio = "artista inserito ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento artista</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">

        <h1 class="text-2xl font-bold text-center mb-6">Inserisci nuovo artista</h1>

        <form method="POST" class="space-y-4">

            <div>
                <label class="block font-medium mb-1">Nome artista</label>
                <input type="text" name="nome_artista" required
                    class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-medium mb-1">Cognome artista</label>
                <input type="text" name="cognome_artista" required
                    class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-medium mb-1">Anno di nascita</label>
                <input type="text" name="anno_nascita_artista" required
                    class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                Inserisci artista
            </button>

        </form>

        <?php if ($messaggio != "") { ?>

            <p class="mt-4 text-center font-medium">
                <?php echo $messaggio; ?>
            </p>

        <?php } ?>

        <div class="mt-6 text-center">
            <a href="../index.html"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Torna alla home
            </a>
        </div>

    </div>

</body>

</html>