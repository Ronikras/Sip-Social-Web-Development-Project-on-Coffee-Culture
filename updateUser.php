<?php
header('Content-Type: application/json');
session_start();

$dataFile = 'data.json';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Povolena je pouze metoda POST.']);
    exit;
}

if (!file_exists($dataFile)) {
    echo json_encode(['success' => false, 'message' => 'Databázový soubor nebyl nalezen.']);
    exit;
}

$data = json_decode(file_get_contents($dataFile), true);
if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Nepodařilo se načíst data.']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'ID uživatele chybí v relaci.']);
    exit;
}

$currentUserId = $_SESSION['user_id'];

$user = null;

foreach ($data as $key => $value) {
    if ($value['id'] == $currentUserId) {
        $user = &$data[$key]; 
        break;
    }
}

if ($user === null) {
    echo json_encode(['success' => false, 'message' => 'Uživatel nebyl nalezen.']);
    exit;
}

$requestData = json_decode(file_get_contents('php://input'), true);
if (!$requestData || !isset($requestData['username'], $requestData['email'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Chybí požadovaná data.']);
    exit;
}

$errors = [];

$username = trim($requestData['username']);
$email = trim($requestData['email']);
$password = $requestData['password'] ?? '';
$confirm_password = $requestData['confirm_password'] ?? '';

if (!preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $username)) {
    $errors[] = 'Jméno a příjmení musí obsahovat pouze latinské znaky a být oddělené mezerou.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Neplatná e-mailová adresa.';
}

if (!empty($password)) {
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*.,])[A-Za-z\d!@#$%^&*.,]{8,20}$/', $password)) {
        $errors[] = 'Heslo musí obsahovat min. 8 znaků, včetně malých и velkých písmen, číslic и speciálních znaků.';
    }
    if ($password !== $confirm_password) {
        $errors[] = 'Hesla se neshodují.';
    }
    $user['password'] = password_hash($password, PASSWORD_BCRYPT);
}

if (!empty($errors)) {
    header('Content-Type: application/json');
    echo json_encode([
        "success" => false,
        "errors" => $errors
    ]);
    exit();
}

$user['username'] = $username;
$user['email'] = $email;

if (file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'Data byla úspěšně aktualizována.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Chyba při ukládání dat.']);
}
?>
