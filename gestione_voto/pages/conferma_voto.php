<?php
require "connection.php";

session_start();

if (isset($_GET["id_candidato"]) && isset($_GET['selected_id_lista'])) {
    $_SESSION['selected_id_candidato'] = $GET['id_candidato'];
    $_SESSION['selected_id_lista'] = $GET['selected_id_lista'];
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selezione candidato</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-blue-50 border border-blue-200 shadow-md w-full max-w-3xl p-6">

        <h1 class="text-2xl font-bold text-blue-800 text-center mb-6">
            Selezione del candidato
        </h1>

        <div class="border border-blue-300 bg-white p-4 mb-4 text-gray-700 text-sm leading-relaxed text-center">
            <p>
                La seconda fase del voto prevede la selezione del candidato
            </p>
        </div>

        <div class="border border-blue-300 bg-white p-4 mb-6 text-gray-700 text-sm leading-relaxed text-center">
            <p>
                Scegli il candidato a cui assegnare il Suo voto dall'elenco a comparsa qui sotto.
            </p>
            <span class="block mt-2 text-gray-600">
                <span class="text-xs">
                    appena selezionatao il candidato, Le verrà proposta la conferma definitiva del voto.
                </span>
            </span>
        </div>



        <div class="border border-green-300 bg-green-50 p-6 mb-6 text-center">
            <label for="lista" class="block text-sm font-semibold text-green-800 mb-2">
                Lista dei Candidati
            </label>

            <select id="lista"
                class="w-full border border-gray-300 rounded px-3 text-center py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                <option value="">-- Seleziona una lista --</option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['id_candidato'] . "'>" . $row['nome'] . $row['cognome'] . "</option>";
                        $_SESSION['selected_id_candidato'] = $row['id_candidato'];
                    }
                }
                ?>
            </select>
        </div>

    </div>



</body>

</html>