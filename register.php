<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonFile = __DIR__ . '/data.json';
    $users = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

    $name = $_POST['username'];
    $date = $_POST['birthday'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['password-confirm'];

    $errors = [];

    $username_pattern = '/^[A-Za-z]+\s[A-Za-z]+$/';
    $phone_pattern = '/^\+420\d{3}\d{3}\d{3}$/';
    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*.,])[A-Za-z\d!@#$%^&*.,]{8,20}$/';

    if (!preg_match($username_pattern, $name)) {
        $errors[] ='Jméno a přijmení musí obsahovat pouze latinské znaky a být oddělené mezerou.';
    }

    $minDate = '1945-01-01';
    $maxDate = '2008-12-31';

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        $errors[] = 'Datum narození musí být ve formátu YYYY-MM-DD.';
    }

    try {
        $birthDate = new DateTime($date);
        $minDateTime = new DateTime($minDate);
        $maxDateTime = new DateTime($maxDate);

        if ($birthDate < $minDateTime || $birthDate > $maxDateTime) {
            $errors[] = 'Datum narození musí být mezi ' . $minDate . ' a ' . $maxDate . '.';
        }
    } catch (Exception $e) {
        $errors[] = 'Neplatné datum narození.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] ='Neplatná e-mailová adresa.';
    }

    if (!preg_match($phone_pattern, $phone)) {
        $errors[] = 'Nesprávný formát telefonního čísla. Použijte fórmat: +420123456789';
    }

    if (!preg_match($password_pattern, $password)) {
        $errors[] = 'Heslo musí obsahovat min. 8 znaků, včetně malých a velkých písmen, číslic a speciálních znaků.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Hesla se neshodují. Zkuste to znovu.';
    }
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (isset($_FILES['profile-photo']) && $_FILES['profile-photo']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['profile-photo']['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = "Profilový obrázek musí být ve formátu JPEG, PNG nebo GIF.";
        }

        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid() . "_" . basename($_FILES['profile-photo']['name']);
        $filePath = $uploadDir . $fileName;

        function resizeImage($file, $destination, $maxWidth, $maxHeight) {
            list($width, $height, $type) = getimagesize($file);

            $src = null;
            switch ($type) {
                case IMAGETYPE_JPEG:
                    $src = imagecreatefromjpeg($file);
                    break;
                case IMAGETYPE_PNG:
                    $src = imagecreatefrompng($file);
                    break;
                case IMAGETYPE_GIF:
                    $src = imagecreatefromgif($file);
                    break;
                default:
                    return false;
            }

            $ratio = min($maxWidth / $width, $maxHeight / $height);
            $newWidth = (int)($width * $ratio);
            $newHeight = (int)($height * $ratio);

            $dst = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            $success = imagejpeg($dst, $destination, 90);
            imagedestroy($src);
            imagedestroy($dst);

            return $success;
        }

        if (resizeImage($_FILES['profile-photo']['tmp_name'], $filePath, 500, 500)) {
            $profilePhoto = $filePath;
        } else {
           $errors[] = "Chyba při nahrávání souboru.";
        }
    } else {
        $errors[] = "Profilový obrázek je nutností.";
    }

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $errors[] = "Uživatel s tímto e-mailem již existuje.";
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: errorPage.php');
        exit();
    }

    $newUser = [
        'id' => count($users) + 1,
        'username' => $name,
        'birthday' => $date,
        'profile-photo' => $profilePhoto,
        'phone' => $phone,
        'email' => $email,
        'password' => $password,
        'role' => 'user'
    ];

    $users[] = $newUser;

    file_put_contents($jsonFile, json_encode($users, JSON_PRETTY_PRINT));
    $_SESSION['user_id'] = $newUser['id'];
    $_SESSION['username'] = $newUser['username'];
    header('Location: ucet.php');
    exit();
}
?>
