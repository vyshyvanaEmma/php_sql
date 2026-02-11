<?php
session_start();

require "connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['selected_nome_candidato'] = $_POST['nome_completo'];
    header("Location: selezione_candidato.php");
    exit();
}

$sql = "SELECT id_candidato, nome, cognome from candidati";
$result = mysqli_query($connection, $sql);

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

            <form method="POST">
                <select name="id_candidato" id="lista" onchange="this.form.submit()"
                    class="w-full border border-gray-300 rounded px-3 text-center py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                    <option value="">-- Seleziona una lista --</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $nome_completo = $row['nome'] . " " . $row['cognome'];
                            echo "<option value='" . $nome_completo . "'>" . $row['nome'] . " " . $row['cognome'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </form>
        </div>

    </div>



</body>

</html>