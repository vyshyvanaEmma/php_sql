<?php
session_start();
require "connection.php";

$customer_id = isset($_GET['customer_id']) && $_GET['customer_id'] !== '' ? intval($_GET['customer_id']) : null;

if ($customer_id) {
    $sql_query = "SELECT orderNumber, customerName FROM orders o JOIN customers c ON o.customerNumber = c.customerNumber WHERE o.customerNumber = {$customer_id} ORDER BY o.orderNumber";
} else {
    $sql_query = "SELECT orderNumber, customerName FROM orders o JOIN customers c ON o.customerNumber = c.customerNumber ORDER BY o.orderNumber";
}

$result = mysqli_query($connection, $sql_query);

$num_orders = mysqli_num_rows($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ordine_id'])) {
        $_SESSION['selected_ordine'] = intval($_POST['ordine_id']);
    } else {
        unset($_SESSION['selected_ordine']);
    }
    header("Location: aggiunta_prodotto.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Ordini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-3xl p-6 rounded-lg shadow">

        <h1 class="text-2xl text-center font-bold text-blue-800 mb-2">Elenco Ordini</h1>
        <p class="text-sm text-gray-600 text-center mb-4">Clicca sull'ordine per aggiungere un prodotto</p>

        <div class="flex justify-center mb-4 gap-2">
            <a href="../index.html" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Torna alla home</a>
            <?php if ($customer_id): ?>
                <a href="elenco_clienti.php" class="px-4 py-2 bg-white border border-gray-300 text-gray-800 rounded hover:bg-gray-50">Scegli altro cliente</a>
            <?php endif; ?>
        </div>

        <?php if ($num_orders > 0): ?>
            <form method="POST" class="space-y-4">
                <select name="ordine_id" id="ordine" onchange="this.form.submit()" class="block w-full text-center p-3 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option value="">-- Seleziona un ordine --</option>
                    <?php
                    mysqli_data_seek($result, 0); // // Riporta il puntatore del result set alla prima riga (indice 0)
                    while ($row = mysqli_fetch_assoc($result)) {
                        $orderNumber = htmlspecialchars($row['orderNumber']);
                        $customerName = htmlspecialchars($row['customerName']);
                        echo "<option value=\"{$orderNumber}\">Numero dell'ordine: {$orderNumber}, dell'cliente: {$customerName}</option>";
                    }
                    ?>
                </select>

            </form>
        <?php else: ?>
            <div class="p-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded text-center">
                <?php if ($customer_id): ?>
                    Questo cliente non ha effettuato ordini.
                <?php else: ?>
                    Non ci sono ordini da mostrare.
                <?php endif; ?>
            </div>
            <div class="mt-4 flex justify-center">
                <a href="elenco_ordini.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Mostra tutti gli ordini</a>
                <a href="../index.html" class="ml-2 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Torna alla home</a>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>