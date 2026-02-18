<?php
session_start();
require "connection.php";
$message = null;
if(!$_SESSION['loggedIn']){
    $message = 'Utente non è loggatto, quindi non puo inserire il prodotto';
    header('elenco_ordini.php');
}
$orderNumber = isset($_SESSION['selected_ordine']) ? intval($_SESSION['selected_ordine']) : null;
$selected_ordine = $orderNumber ? htmlspecialchars($orderNumber) : null;

$message = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prodotto_id = isset($_POST['prodotto_id']) ? $_POST['prodotto_id'] : '';
    if (!$orderNumber) {
        $error = 'Nessun ordine selezionato.';
    } elseif (empty($prodotto_id)) {
        $error = 'Seleziona un prodotto.';
    } else {
        $prodotto_id_esc = mysqli_real_escape_string($connection, $prodotto_id);

        // ottengo prezzo
        $q = "SELECT buyPrice FROM products WHERE productCode = '{$prodotto_id_esc}' LIMIT 1";
        $r = mysqli_query($connection, $q);
        if ($r && $rowp = mysqli_fetch_assoc($r)) {
            $priceEach = (float)$rowp['buyPrice'];

            // calcolo prossimo orderLineNumber
            $q2 = "SELECT COALESCE(MAX(orderLineNumber),0)+1 AS nextLine FROM orderdetails WHERE orderNumber = {$orderNumber}";
            $r2 = mysqli_query($connection, $q2);
            $nextLine = 1;
            if ($r2 && $row2 = mysqli_fetch_assoc($r2)) {
                $nextLine = intval($row2['nextLine']);
            }

            // inserisco in orderdetails
            $ins = "INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) VALUES ({$orderNumber}, '{$prodotto_id_esc}', 1, {$priceEach}, {$nextLine})";
            if (mysqli_query($connection, $ins)) {
                $message = 'Prodotto aggiunto correttamente all\'ordine.';
            } else {
                $error = 'Errore durante l\'inserimento: ' . mysqli_error($connection);
            }
        } else {
            $error = 'Prodotto non trovato.';
        }
    }
}

$sql_query = "SELECT DISTINCT p.productCode, p.productName FROM products p
    JOIN orderdetails od ON p.productCode = od.productCode
    JOIN orders o ON od.orderNumber = o.orderNumber";
$result = mysqli_query($connection, $sql_query);
if (!$result) {
    $error = $error ? $error : ("Query error: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiunta prodotto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full text-center max-w-3xl p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-blue-800 mb-2">Aggiungi prodotto all'ordine
            <?php echo $selected_ordine ? "#{$selected_ordine}" : "(nessun ordine selezionato)"; ?>
        </h1>

        <p class="text-sm text-gray-600 mb-4">Scegli il prodotto da aggiungere all'ordine corrente.</p>

        <?php if ($message): ?>
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="mb-4 flex justify-center gap-3">
            <a href="show_ordine.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Mostra ordine</a>
            <a href="elenco_ordini.php" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Torna agli ordini</a>
        </div>

        <form method="POST" class="space-y-4">
            <select name="prodotto_id" id="prodotti" onchange="this.form.submit()" class="text-center block w-full p-3 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">

                <option value="">-- Seleziona il prodotto --</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $productCode = htmlspecialchars($row['productCode']);
                    $productName = htmlspecialchars($row['productName']);
                    echo "<option value=\"{$productCode}\">{$productName}</option>";
                }
                ?>
            </select>

            <noscript>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Aggiungi</button>
            </noscript>
        </form>

    </div>

</body>

</html>