<?php
session_start();
if (!isset($_SESSION["utenti"])) {
    $_SESSION["utenti"] = [];
}

$error = "";
$_SESSION['loggedIn'] = false;
$_SESSION['utente'] = "";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (isset($_SESSION["utenti"][$username])) {
        if (password_verify($password, $_SESSION["utenti"][$username])) {
            $_SESSION["utenti_logato"] = $username;
            $_SESSION['utente'] = $_POST['username'];
            $_SESSION["loggedIn"] = true;
            header("Location: ../index.html");
        } else {
            $error = "Password non valida";
        }
    } else {
        $error = "Nessun utente registrato con questo username";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-50 flex items-center justify-center min-h-screen">

    <div class="bg-white border border-blue-200 shadow-xl w-full max-w-md p-8 rounded-xl">

        <h1 class="text-2xl font-bold text-blue-800 text-center mb-6">
            Login <span class="text-red-600 font-extrabold tracking-wide">CRAZY SHOP</span>
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
                    class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg shadow hover:bg-blue-700 hover:shadow-lg transition transform hover:-translate-y-1">
                    Accedi
                </button>
            </div>

        </form>

        <?php if (!empty($error)): ?>
            <div class="mt-5 text-center">
                <p class="text-red-600 font-semibold"><?php echo $error; ?></p>

                <?php if ($error == "Nessun utente registrato con questo username"): ?>
                    <a href="registrazione.php"
                        class="inline-block mt-3 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition transform hover:-translate-y-1">
                        Registrati
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>