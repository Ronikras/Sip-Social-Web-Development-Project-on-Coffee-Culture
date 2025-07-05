<?php
session_start();
$error_message = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sip & Social - Registrace uživatele">
        <title>Registrace - Sip & Social</title>
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
                    <li><a href="ucet.php">Účet</a></li>
                    <li><a href="logout.php">Odhlásit se</a></li>
                    <?php else: ?>
                    <li><a href="vchod.php"  class="active">Přihlásit se</a></li>
                    <?php endif; ?>                   
                </ul>
            </nav>
        </header>
        <main>
            <section id="login">
                <h2 class="login">Přihlášení</h2>
                <?php if ($error_message): ?>
                    <script>
                        alert('<?php echo addslashes($error_message); ?>');
                    </script>
                <?php endif; ?>
                <form id="login-form" action="log.php" method="post">
                    <div class="form-group">
                        <label for="login-email">E-mail:</label>
                        <input type="email" id="login-email" name="login-email" placeholder="např. uživatel@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="login-password">Heslo:</label>
                        <input type="password" id="login-password" name="login-password" placeholder="Zadejte heslo" required>
                    </div>
                    <button type="submit" class="btn">Přihlásit se</button>
                <p class="switch-link">Nemáte účet? <a href="#" id="switch-to-register">Zaregistrujte se</a></p>
                </form>
            </section>

            <section id="registration">
                <h2 class="registration">Registrace</h2>
                <form id="registration-form"  action="register.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Jméno a přijmení:</label>
                        <input type="text" id="username" name="username"  placeholder="např. Barbora Smutná" required>
                    </div>
                    <div class="form-group">
                        <label for="profile-photo"> Nahrajte fotografii profilu:</label>
                        <input type="file" id="profile-photo" name="profile-photo" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Datum narození:</label>
                        <input type="date" id="birthday" name="birthday" min="1945-01-01" max="2008-12-31"  required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" placeholder="např. smutna@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefonní číslo:</label>
                        <input type="tel" id="phone" name="phone" placeholder="+420258902138" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Heslo:</label>
                        <input type="password" id="password" name="password" placeholder="Zadejte heslo" minlength="8" required>
                        <small id="password-hint" class="hint">
                            Heslo musí obsahovat minimálně 8 znaků, včetně malých a velkých písmen, číslic a speciálních znaků (!@#$%^&*.,).
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Potvrzení hesla:</label>
                        <input type="password" id="password-confirm" name="password-confirm" placeholder="Potvrďte heslo" required>
                    </div>
                    <button type="submit" class="btn">Potvrdit</button>
                    <p class="switch-link">Již máte účet?<a href="#" id="switch-to-login">Přihlaste se zde</a></p>
                </form>
            </section>
            <button id="back-to-top" onclick="scrollToTop()"></button>
        </main>

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

        <script src="script.js"></script>
    </body>
</html>