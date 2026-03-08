<?php
session_start();
require "connection.php";

$querryArtista = "SELECT id_artista, nome_artista, cognome_artista FROM artista";
$risultato1 = mysqli_query($connection, $querryArtista);

$id_artista = $_GET['id_artista'] ?? null;
$_SESSION['id_artista'] = $id_artista;

$nome_artista_selezionato = "";
$cognome_artista_selezionato = "";

if ($id_artista) {
    $querryOperePerArtista = "SELECT nome_opera 
                              FROM opera 
                              JOIN artista ON opera.id_artista = artista.id_artista 
                              WHERE opera.id_artista = {$id_artista}";
    $risultato2 = mysqli_query($connection, $querryOperePerArtista);

    $queryArtista = "SELECT nome_artista, cognome_artista 
                     FROM artista 
                     WHERE id_artista = $id_artista";

    $risultato3 = mysqli_query($connection, $queryArtista);
    $artista = mysqli_fetch_assoc($risultato3);

    $nome_artista_selezionato = $artista['nome_artista'];
    $cognome_artista_selezionato = $artista['cognome_artista'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista opere di un artista</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">

        <h1 class="text-2xl font-bold text-center mb-6">Opere per artista</h1>

        <p class="mb-2 font-medium">Scegli un artista</p>

        <form method="GET">
            <select name="id_artista"
                class="w-full border rounded-lg p-2 mb-6 focus:outline-none focus:ring-2 focus:ring-blue-400"
                onchange="this.form.submit()">

                <option value="">--- SELEZIONA UN ARTISTA ---</option>

                <?php
                while ($row = mysqli_fetch_assoc($risultato1)) {
                    $id = $row['id_artista'];
                    $nome_artista = $row['nome_artista'];
                    $cognome_artista = $row['cognome_artista'];

                    echo "<option value='$id'>$nome_artista $cognome_artista</option>";
                }
                ?>

            </select>
        </form>

        <div>

            <h2 class="text-lg font-semibold mb-3">
                Lista opere per <?php echo $nome_artista_selezionato . " " . $cognome_artista_selezionato; ?>
            </h2>

            <ul class="list-disc pl-5 space-y-1">

                <?php
                if (isset($risultato2)) {
                    while ($row = mysqli_fetch_assoc($risultato2)) {
                        $nome_opera = $row['nome_opera'];
                        echo "<li>$nome_opera</li>";
                    }
                }
                ?>

            </ul>

        </div>

        <div class="mt-6 text-center">
            <a href="../index.html"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Torna alla home
            </a>
        </div>

    </div>

</body>

</html>