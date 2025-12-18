<?php
session_start();
$username = "demo";
$password = "password123";

$error = "";
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: authentification.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    if ($input_username === $username && $input_password === $password) {
        $_SESSION["user"] = $input_username;
    } else {
        $error = "Identifiant ou mot de passe incorrect.";
    }
}
if (isset($_SESSION["user"])) {
    echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Bienvenue</title>
</head>
<body>
    <h1>Bienvenue, " . htmlspecialchars($_SESSION["user"]) . " !</h1>
    <a href='?action=logout'>Se déconnecter</a>
</body>
</html>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page de connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="authentification.php">
        <label for="username">Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>