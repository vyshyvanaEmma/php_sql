<?php
session_start();
if (!isset($_SESSION["utenti"])) {
    $_SESSION["utenti"] = [];
}

$username = "";
$message = "";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    if (empty($username) || empty($password)) {
        $message = "Inserisci sia username che password";
    } elseif (isset($_SESSION["utenti"][$username])) {
        $message = "Sei già stato registrato";
    } else {
        $_SESSION["utenti"][$username] = password_hash($password, PASSWORD_BCRYPT);
        $username = "";
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-50 flex items-center justify-center min-h-screen">

    <div class="bg-white border border-blue-200 shadow-xl w-full max-w-md p-8 rounded-xl">

        <h1 class="text-2xl font-bold text-blue-800 text-center mb-6">
            Registrazione <span class="text-red-600 font-extrabold tracking-wide">CRAZY SHOP</span>
        </h1>

        <form method="POST" class="space-y-5">

            <div>
                <label for="username" class="block text-sm font-semibold text-blue-700 mb-1">
                    Nome utente
                </label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-blue-700 mb-1">
                    Password
                </label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-green-600 text-white font-bold py-2 rounded-lg shadow hover:bg-green-700 hover:shadow-lg transition transform hover:-translate-y-1">
                    Registrati
                </button>
            </div>

        </form>

        <?php if (!empty($message)): ?>
            <div class="mt-5 text-center">
                <p class="text-red-600 font-semibold">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Hai già un account?
            </p>
            <a href="login.php"
                class="inline-block mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition transform hover:-translate-y-1">
                Accedi
            </a>
        </div>

    </div>

</body>

</html>