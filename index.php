<?php
session_start();

$host = "localhost";
$dbname = "budgetteren";
$username = "aniez";
$password = "aniez";    

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];

$melding = "";
$inlog = "";
function inloggen($pdo, $gebruikersnaam, $wachtwoord) {
    $stmt = $pdo->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = ?");
    $stmt->execute([$gebruikersnaam]);
    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($gebruiker && $wachtwoord  === $gebruiker["wachtwoord"]) {
        $_SESSION['gebruiker_id'] = $gebruiker['id'];

        header("Location: home.php");
        exit;
    } else {
    
        echo "je wachtwoord of e-mail is verkeerd";
    }
}
    $inlog = inloggen($pdo, $gebruikersnaam, $wachtwoord);
}
    var_dump($gebruikersnaam);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<div class="inloggentekstbackground">
    <div class="inloggentekst">
        <h1>Inloggen</h1>
    </div>

<form method="POST" action="">
    <div class="inlogbalk">
  

        <div class="e-mail">
            <h2>gebruikersnaam</h2>
        <input type="text" name="gebruikersnaam" id="gebruikersnaam" required>           
    </div>

        <div class="wachtwoord">
            <h2>wachtwoord</h2>
            <input type="password" name="wachtwoord" placeholder="wachtwoord" required>
        </div>

        <div class="inloggenknop">
            <button type="submit" name="inloggen">inloggen</button>
        </div>
    </div>

</form>
</body>
</html>