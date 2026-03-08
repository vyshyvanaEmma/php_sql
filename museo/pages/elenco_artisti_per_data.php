<?php
require "connection.php";

$query = "SELECT nome_artista, cognome_artista, anno_nascita_artista 
          FROM artista 
          WHERE anno_nascita_artista BETWEEN 1970 AND 1980";

$risultato = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisti nati tra 1970 e 1980</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-2xl">

        <h1 class="text-2xl font-bold text-center mb-6">
            Artisti nati tra il 1970 e il 1980
        </h1>

        <table class="w-full border border-gray-300 rounded-lg overflow-hidden">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Nome</th>
                    <th class="p-3 text-left">Cognome</th>
                    <th class="p-3 text-left">Anno nascita</th>
                </tr>
            </thead>

            <tbody>

                <?php
                while ($row = mysqli_fetch_assoc($risultato)) {

                    $nome = $row['nome_artista'];
                    $cognome = $row['cognome_artista'];
                    $anno = $row['anno_nascita_artista'];

                    echo "<tr class='border-t'>
            <td class='p-3'>$nome</td>
            <td class='p-3'>$cognome</td>
            <td class='p-3'>$anno</td>
          </tr>";
                }
                ?>

            </tbody>

        </table>

        <div class="mt-6 text-center">
            <a href="../index.html"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Torna alla home
            </a>
        </div>

    </div>

</body>

</html>