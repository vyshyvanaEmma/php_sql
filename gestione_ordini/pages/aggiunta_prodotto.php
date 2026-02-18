<?php
session_start();
require "connection.php";

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    $_SESSION['message'] = 'Utente non è loggato, quindi non può inserire il prodotto';
    header('Location: login.php');
    exit();
}

$selected_ordine = $_SESSION['selected_ordine'];

$message = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prodotto_id = $_POST['prodotto_id'] ?? '';

    if (!$selected_ordine) {
        $error = 'Nessun ordine selezionato.';
    } elseif (empty($prodotto_id)) {
        $error = 'Seleziona un prodotto.';
    } else {
        // Prendo prezzo
        $q = "SELECT buyPrice FROM products WHERE productCode = '$prodotto_id'";
        $res = mysqli_query($connection, $q);
        $priceEach = 0;
        if ($res && $row = mysqli_fetch_assoc($res)) {
            $priceEach = (float)$row['buyPrice'];
        }

        $check_ordine_gia_presente = "SELECT * FROM orderdetails WHERE orderNumber = $selected_ordine AND productCode = '$prodotto_id'";
        $res_check = mysqli_query($connection, $check_ordine_gia_presente);

        if (mysqli_num_rows($res_check) > 0) {
            //caso in cui il prodotto c'e' gia in ordine
            $row_check = mysqli_fetch_assoc($res_check);
            $nuovaQuantita = $row_check['quantityOrdered'] + 1;
            $orderLine = $row_check['orderLineNumber'];

            $upd = "UPDATE orderdetails SET quantityOrdered = $nuovaQuantita, priceEach = $priceEach WHERE orderNumber = $selected_ordine AND productCode = '$prodotto_id'";
            if (mysqli_query($connection, $upd)) {
                $message = "Prodotto già presente, quantita presente aumentata";
            } else {
                $error = "errore aggiornamento quantita " . mysqli_error($connection);
            }
        } else {

            // calc orderLineNumber
            $q2 = mysqli_query($connection, "SELECT MAX(orderLineNumber) FROM orderdetails WHERE orderNumber = $selected_ordine");
            $row2 = mysqli_fetch_row($q2);  // prende un array numerico
            $nextLine = ($row2[0] !== null) ? $row2[0] + 1 : 1;

            // inserimento prodotto
            $ins = "INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber)
                    VALUES ($selected_ordine, '$prodotto_id', 1, $priceEach, $nextLine)";
            if (mysqli_query($connection, $ins)) {
                $message = "Prodotto è stato aggiunto ";
            } else {
                $error = "Errore inserimento: " . mysqli_error($connection);
            }
        }
    }
}

// lista prodotti
$sql_query = "SELECT productCode, productName FROM products ORDER BY productName";
$result = mysqli_query($connection, $sql_query);
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

            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Aggiungi</button>
            </div>
        </form>

    </div>

</body>

</html>