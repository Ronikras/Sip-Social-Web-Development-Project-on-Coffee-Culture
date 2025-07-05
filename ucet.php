<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: vchod.php');
    exit;
}

$json_file = __DIR__ . '/data.json';
$users = json_decode(file_get_contents($json_file), true);

$current_user = null;
foreach ($users as $user) {
    if ($user['id'] == $_SESSION['user_id']) {
        $current_user = $user;
        break;
    }
}

if (!$current_user) {
    echo "<script>alert('Uživatel nebyl nalezen.');</script>";
    exit;
}

function respond_with_error($message, $status_code = 400) {
    http_response_code($status_code);
    echo json_encode(['success' => false, 'error' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if ($contentType === "application/json") {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (!isset($data['id'])) {
            respond_with_error('Neplatná data. Chybí ID uživatele.');
        }

        if ($data['id'] != $current_user['id'] && $current_user['role'] !== 'admin') {
            respond_with_error('Access denied.', 403);
        }

        if (!isset($data['id'], $data['username'], $data['email'])) {
            respond_with_error('Neplatná data.');
        }

        if (isset($data['username']) && !empty($data['username'])) {
            if (!preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $data['username'])) {
                respond_with_error('Jméno a přijmení musí obsahovat pouze latinské znaky a být oddělené mezerou.');
            }
        }

        if (isset($data['email']) && !empty($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                respond_with_error('Neplatný email.');
            }
        }

        if (isset($data['password']) && !empty($data['password'])) {
            if (strlen($data['password']) < 8 ||
                !preg_match('/[A-Z]/', $data['password']) ||
                !preg_match('/[a-z]/', $data['password']) ||
                !preg_match('/[0-9]/', $data['password']) ||
                !preg_match('/[!@#$%^&*.,]/', $data['password'])) {
                respond_with_error('Heslo musí obsahovat minimálně 8 znaků, včetně malých a velkých písmen, číslic a speciálních znaků (!@#$%^&*,.).');
            }
        }
        
        foreach ($users as &$user) {
            if ($user['id'] == $data['id']) {
                if (isset($data['username']) && !empty($data['username'])) {
                    $user['username'] = $data['username'];
                    $_SESSION['username'] = $user['username'];
                }
                if (isset($data['email']) && !empty($data['email'])) {
                    $user['email'] = $data['email'];
                    $_SESSION['email'] = $user['email'];
                }
                if (isset($data['password']) && !empty($data['password'])) {
                    $user['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                }

                file_put_contents($json_file, json_encode($users, JSON_PRETTY_PRINT));
        
                echo json_encode([
                    'success' => true,
                    'message' => 'Údaje byly úspěšně aktualizovány.',
                    'updated_user' => [
                        'username' => $user['username'],
                        'email' => $user['email']
                    ]
                ]);
                exit;
            }
        }

        respond_with_error('Uživatel nebyl nalezen.');
    }

    if (isset($_POST['delete_user'])) {
        if ($current_user['role'] !== 'admin') {
            http_response_code(403); 
            echo json_encode(['success' => false, 'error' => 'Přístup zamítnut.']);
            exit;
        }
        $id = $_POST['user_id'];
        $users = array_filter($users, function ($user) use ($id) {
            return $user['id'] != $id;
        });
        $users = array_values($users);
        foreach ($users as $index => &$user) {
            $user['id'] = $index + 1;
        }

        file_put_contents($json_file, json_encode($users, JSON_PRETTY_PRINT));
        echo "<script>
            alert('Uživatel byl úspěšně smazán.');
            window.location.href = 'ucet.php';
          </script>";
        exit;
    } elseif (isset($_POST['update_role'])) {
        if ($current_user['role'] !== 'admin') {
            http_response_code(403); 
            echo json_encode(['success' => false, 'error' => 'Přístup zamítnut.']);
            exit;
        }
        $id = $_POST['user_id'];
        foreach ($users as &$user) {
            if ($user['id'] == $id) {
                $user['role'] = $_POST['role'];
                file_put_contents($json_file, json_encode($users, JSON_PRETTY_PRINT));
                echo "<script>
                    alert('Role byla úspěšně aktualizována.');
                    window.location.href = 'ucet.php';
                  </script>";
                exit;             
            }
        }
        echo json_encode(['success' => false, 'error' => 'Uživatel nebyl nalezen.']);
        exit;
    }

    file_put_contents($json_file, json_encode($users, JSON_PRETTY_PRINT));
    header("Location: ucet.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'fetch_users') {
    if ($current_user['role'] !== 'admin') {
        http_response_code(403); 
        echo json_encode(['success' => false, 'error' => 'Přístup zamítnut.']);
        exit;
    }

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $users_per_page = 5;
    $total_users = count($users);
    $total_pages = ceil($total_users / $users_per_page);

    $start = ($page - 1) * $users_per_page;
    $paged_users = array_slice($users, $start, $users_per_page);

    $safe_users = array_map(function ($user) {
        return [
            'id' => $user['id'],
            'username' => htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'),
            'role' => htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8')
        ];
    }, $paged_users);

    echo json_encode([
        'success' => true,
        'users' => $safe_users,
        'current_page' => $page,
        'total_pages' => $total_pages
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sip & Social - Uživatelský účet">
    <title>Váš účet - Sip & Social</title>
    <link rel="stylesheet" media="screen" href="style.css">
    <link rel="stylesheet" media="print" href="print.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Sip & Social</h1>
            <p class="slogan">Sip the Finest, Share the Best</p>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">O nás</a></li>
                <li><a href="teorie.php">Blog</a></li>
                <li><a href="akce.php">Akce</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="ucet.php" class="active">Účet</a></li>
                    <li><a href="logout.php">Odhlásit se</a></li>
                <?php else: ?>
                    <li><a href="vchod.php">Přihlásit se</a></li>
                <?php endif; ?>                
            </ul>
        </nav>
    </header>
    <main>
        <section id="user-profile">
            <h2>Vítejte, <?php echo htmlspecialchars($current_user['username']); ?>!</h2>
            <div class="profile">
                <img src="<?php echo htmlspecialchars($current_user['profile-photo']); ?>" alt="Profilový obrázek">
                <div class="profile-details">
                    <p><strong>Jméno:</strong> <span id="user-name"><?php echo htmlspecialchars($current_user['username']); ?></span></p>
                    <p><strong>Email:</strong> <span id="user-email"><?php echo htmlspecialchars($current_user['email']); ?></span></p>
                    <p><strong>Telefon:</strong> <?php echo htmlspecialchars($current_user['phone']); ?></p>
                    <p><strong>Datum narození:</strong> <?php echo htmlspecialchars($current_user['birthday']); ?></p>
                </div>
                <button id="edit-profile-btn" class="button-edit">Upravit údaje</button>
            </div>
            <a href="logout.php" class="logout-btn"> Odhlásit se </a>
        </section>
        <section id="edit-profile" class="hidden">
            <h2>Upravit údaje</h2>
            <div id="error-container" class="hidden">
                <ul id="error-messages"></ul>
            </div>

            <form id="edit-profile-form" class="form-edit" action="updateUser.php" method="POST">
                <label for="new-name">Nové jméno:</label>
                <input type="text" id="new-name" name="name"  value="<?php echo htmlspecialchars($current_user['username'] ?? ''); ?>" >

                <label for="new-email">Nový email:</label>
                <input type="email" id="new-email" name="email"  value="<?php echo htmlspecialchars($current_user['email'] ?? ''); ?>" >

                <label for="new-password">Nové heslo:</label>
                <input type="password" id="new-password" name="password">

                <label for="confirm-password">Potvrdit heslo:</label>
                <input type="password" id="confirm-password" name="confirm-password">

                <button type="submit" class="button-save">Uložit změny</button>
                <button type="button" class="button-cancel" id="cancel-edit">Zrušit</button>
            </form>
        </section>
        <button id="back-to-top" onclick="scrollToTop()"></button>
    </main>

    <?php if ($current_user['role'] === 'admin'): ?>
    <section id="admin-panel">
        <h2>Admin Panel</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jméno</th>
                    <th>E-mail</th>
                    <th>Role</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody id="admin-user-list">
            </tbody>
        </table>
        <div id="admin-pagination"></div>   
     </section>
    <?php endif; ?>

    <footer>
        <div class="footer-content">
            <div class="footer-info">
                <h3>Sip & Social</h3>
                <p class="slogan">Sip the Finest, Share the Best</p>
            </div>
            <div class="footer-contact">
                <h4>Kontaktní informace</h4>
                <p><strong>Adresa:</strong> Václavské náměstí 1, Praha</p>
                <p><strong>Telefon:</strong> <a href="tel:+420123456789">+420 123 456 789</a></p>
                <p><strong>E-mail:</strong> <a href="mailto:info@sipandsocial.com">info@sipandsocial.com</a></p>
            </div>
            <div class="footer-hours">
                <h4>Otevírací doba</h4>
                <ul>
                    <li>Pondělí - Pátek: 8:00 - 20:00</li>
                    <li>Sobota: 9:00 - 22:00</li>
                    <li>Neděle: 9:00 - 18:00</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Sip & Social. Všechna práva vyhrazena.</p>
        </div>
    </footer>
    <script src="script.js" defer></script>
</body>
</html>
