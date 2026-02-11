<?php
session_start();

require "connection.php";

$sql = "SELECT nome_lista from liste";
$result = mysqli_query($connection, $sql);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['selected_nome_lista'] = $_POST['nome_lista'];
    header("Location: selezione_candidato.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selezione lista</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-blue-50 border border-blue-200 shadow-md w-full max-w-3xl p-6">

        <h1 class="text-2xl font-bold text-blue-800 text-center mb-6">
            Selezione della lista
        </h1>

        <div class="border border-blue-300 bg-white p-4 mb-4 text-gray-700 text-sm leading-relaxed text-center">
            <p>
                La prima fase del voto prevede la selezione della lista elettorale.
            </p>
        </div>

        <div class="border border-blue-300 bg-white p-4 mb-6 text-gray-700 text-sm leading-relaxed text-center">
            <p>
                Scegli la lista a cui assegnare il Suo voto dall'elenco a comparsa qui sotto.
            </p>
            <span class="block mt-2 text-gray-600">
                <span class="text-xs">
                    appena selezionata la lista, Le verrà proposto l'elenco dei candidati per quella lista.
                </span>
            </span>
        </div>



        <div class="border border-green-300 bg-green-50 p-6 mb-6 text-center">
            <label for="lista" class="block text-sm font-semibold text-green-800 mb-2">
                Lista elettorale
            </label>

            <form method="POST">
                <select name="lista_id" onchange="this.form.submit()"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-center">

                    <option value="">-- Seleziona una lista --</option>

                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['nome_lista'] . "'>" . $row['nome_lista'] . "</option>";  
                    }
                    ?>

                </select>
            </form>

        </div>

    </div>

</body>

</html>