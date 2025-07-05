<?php
session_start();

if (!isset($_SESSION['errors'])) {
    header('Location: ucet.php');
    exit();
}

$errors = $_SESSION['errors'];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chyby ve formuláři</title>
</head>
<body>
    <h1>Byly nalezeny chyby ve formuláři:</h1>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="vchod.php">Zpět na formulář</a>
</body>
</html>
