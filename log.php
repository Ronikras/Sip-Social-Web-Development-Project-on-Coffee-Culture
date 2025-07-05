<?php
session_start();

$json_file = 'data.json';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    if (!file_exists($json_file)) {
        die("Databáze uživatelů neexistuje.");
    }

    $users = json_decode(file_get_contents($json_file), true);
    if (!$users) {
        die("Chyba při čtení databáze uživatelů.");
    }

    $user = null;
    foreach ($users as $u) {
        if ($u['email'] === $email) {
            $user = $u;
            break;
        }
    }

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];
        header('Location: ucet.php');
        exit;
    } else {
        $_SESSION['error'] = 'Nesprávný e-mail nebo heslo.';
        header('Location: vchod.php');
        exit;
    }
}
?>
