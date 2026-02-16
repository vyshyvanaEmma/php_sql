<?php
session_start();
require "connection.php";

$orderNumber = isset($_SESSION['selected_ordine']) ? intval($_SESSION['selected_ordine']) : null;

?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dettagli Ordine</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

  <div class="bg-white w-full max-w-4xl p-6 rounded-lg shadow">
    <?php if (!$orderNumber): ?>
      <h1 class="text-2xl font-bold text-red-700 mb-4">Nessun ordine selezionato</h1>
      <p class="mb-4">Seleziona prima un ordine da <a href="../index.html" class="text-blue-600 underline">Elenco ordini</a> o <a href="elenco_ordini.php" class="text-blue-600 underline">qui</a>.</p>
      <a href="elenco_ordini.php" class="px-4 py-2 bg-blue-600 text-white rounded">Vai agli ordini</a>
    <?php else: ?>
      <?php
        $q = "SELECT o.orderNumber, o.orderDate, c.customerName, c.contactLastName, c.contactFirstName
          FROM orders o JOIN customers c ON o.customerNumber = c.customerNumber
          WHERE o.orderNumber = {$orderNumber} LIMIT 1";
        $res = mysqli_query($connection, $q);
        $order = $res ? mysqli_fetch_assoc($res) : null;

        $q2 = "SELECT od.orderLineNumber, od.productCode, p.productName, od.quantityOrdered, od.priceEach
          FROM orderdetails od JOIN products p ON od.productCode = p.productCode
          WHERE od.orderNumber = {$orderNumber}
          ORDER BY od.orderLineNumber";
        $items = mysqli_query($connection, $q2);
      ?>

      <div class="mb-4 flex items-start justify-between">
        <div>
          <h1 class="text-2xl font-bold text-blue-800">Dettagli ordine #<?php echo htmlspecialchars($orderNumber); ?></h1>
          <?php if ($order): ?>
            <p class="text-sm text-gray-600">Cliente: <?php echo htmlspecialchars($order['customerName']); ?></p>
            <p class="text-sm text-gray-600">Data ordine: <?php echo htmlspecialchars($order['orderDate']); ?></p>
          <?php endif; ?>
        </div>
        <div class="flex gap-2">
          <a href="aggiunta_prodotto.php" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Aggiungi prodotto</a>
          <a href="elenco_ordini.php" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Torna agli ordini</a>
        </div>
      </div>

      <?php if ($items && mysqli_num_rows($items) > 0): ?>
        <div class="overflow-x-auto">
          <table class="w-full table-auto border-collapse">
            <thead>
              <tr class="text-left text-sm text-gray-600 border-b">
                <th class="py-2">Linea</th>
                <th class="py-2">Prodotto</th>
                <th class="py-2">Quantità</th>
                <th class="py-2">Prezzo unitario</th>
                <th class="py-2">Totale</th>
              </tr>
            </thead>
            <tbody>
              <?php $grand = 0; while ($it = mysqli_fetch_assoc($items)): ?>
                <?php
                  $qty = (int)$it['quantityOrdered'];
                  $price = (float)$it['priceEach'];
                  $lineTotal = $qty * $price;
                  $grand += $lineTotal;
                ?>
                <tr class="border-b">
                  <td class="py-2 text-sm"><?php echo htmlspecialchars($it['orderLineNumber']); ?></td>
                  <td class="py-2 text-sm"><?php echo htmlspecialchars($it['productName']); ?> <span class="text-xs text-gray-500">(<?php echo htmlspecialchars($it['productCode']); ?>)</span></td>
                  <td class="py-2 text-sm"><?php echo $qty; ?></td>
                  <td class="py-2 text-sm">€ <?php echo number_format($price,2,',','.'); ?></td>
                  <td class="py-2 text-sm">€ <?php echo number_format($lineTotal,2,',','.'); ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4" class="text-right font-bold py-3">Totale ordine</td>
                <td class="font-bold py-3">€ <?php echo number_format($grand,2,',','.'); ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      <?php else: ?>
        <div class="p-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded">Nessun prodotto presente per questo ordine.</div>
      <?php endif; ?>

    <?php endif; ?>
  </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order details</title>
</head>
<body>
    <h1>Detagli ordine </h1>
</body>
</html>