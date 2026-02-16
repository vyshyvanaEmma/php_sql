<?php
require "connection.php";

$sql_query = "SELECT customerNumber, customerName FROM customers ORDER BY customerName";
$result = mysqli_query($connection, $sql_query);

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Clienti</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-3xl p-6 rounded-lg shadow">

        <h1 class="text-2xl text-center font-bold text-blue-800 mb-2">Elenco dei clienti</h1>
        <p class="text-sm text-gray-600 text-center mb-4">Clicca sul cliente per vedere gli ordini effettuati.</p>

        <form method="GET" action="elenco_ordini.php" class="space-y-4">
            <select name="customer_id" id="cliente" onchange="this.form.submit()" class="block w-full text-center p-3 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="">-- Seleziona un cliente --</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $customerName = htmlspecialchars($row['customerName']);
                    $customerId = htmlspecialchars($row['customerNumber']);
                    echo "<option value=\"{$customerId}\">{$customerName}</option>";
                }
                ?>
            </select>

        </form>

    </div>

</body>

</html>