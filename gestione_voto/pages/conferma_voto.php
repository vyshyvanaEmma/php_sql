<?php
require "connection.php";
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferma del voto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-blue-50 border border-blue-200 shadow-md w-full max-w-3xl p-6">

        <h1 class="text-2xl font-bold text-blue-800 text-center mb-6">
            Conferma del voto
        </h1>

        <div class="border border-blue-300 bg-white p-4 mb-4 text-gray-700 text-sm leading-relaxed text-center">
            <p>
                La terza fase ed ultima del voto consiste nella conferma della selezione
            </p>
        </div>

        <div class="border border-blue-300 bg-white p-4 mb-6 text-gray-700 text-sm leading-relaxed text-center">
            <p>
                Qui sotto è riepilogata la Sua scelta di voto.
            </p>
            <span class="block mt-2 text-gray-600">
                <span class="text-xs">
                    Confermando questa scelta Lei esprime in modo definitivo il Suo voto
                </span>
            </span>
        </div>

        <div class="border border-green-300 bg-green-50 p-6 rounded-lg text-center shadow-lg max-w-md mx-auto">
            <p class="text-gray-700 mb-3">
                <span class="font-semibold">Lista selezionata:</span> <?= $_SESSION["selected_nome_lista"] ?>
            </p>

            <p class="text-gray-700 mb-6">
                <span class="font-semibold">Candidato selezionato:</span> <?= $SESSION["selected_nome_candidato"] ?>
            </p>

            <div class="flex justify-center gap-4">
                <form action="registrazione_effetuata.php" method="POST">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg shadow transition duration-200">
                        Conferma
                    </button>
                </form>

                <a href="../index.html"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg shadow transition duration-200">
                    Annulla
                </a>
            </div>
        </div>



    </div>



</body>

</html>