<?php
session_start();
?>
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sip & Social - výběrová káva, informace o kávových zrnech a výrobě.">
        <title>Sip & Social</title>
        <link rel="stylesheet" href="style.css">
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
                    <li><a href="index.php" class="active">O nás</a></li>
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
            <section id="about">
                <h2>O nás</h2>
                <p>Vítejte v <strong>Sip & Social</strong>, místě, kde se setkávají milovníci kávy a odborníci na výběrovou kávu. Naše mise je jednoduchá: přinést vám nezapomenutelný zážitek z každého šálku kávy.</p>
            </section>

            <section id="photo-scrollbar" class="scrollbar-section">
                <div class="scroll-wrapper">
                    <button class="scroll-btn left" onclick="scrollLeft()">&#8249;</button>
                    <div class="scroll-container">
                        <img src="img/1.jpg" alt="Bar v kavárně">
                        <img src="img/2.jpg" alt="Hand brew">
                        <img src="img/3.jpg" alt="Hand brew za barem">
                        <img src="img/4.jpg" alt="Kavárna">
                        <img src="img/5.jpg" alt="Stůl s kávou">
                    </div>
                    <button class="scroll-btn right" onclick="scrollRight()">&#8250;</button>
                </div>
            </section>

            <section id="history">
                <h2>Naše historie</h2>
                <p>Naše cesta začala v roce 2010 jako malý pop-up stánek na místním trhu. Chtěli jsme ukázat lidem, jak chutná opravdová výběrová káva. Díky pozitivnímu ohlasu jsme otevřeli první kavárnu v centru Prahy v roce 2012.</p>
                <p>Od té doby jsme se rozrostli a nyní nabízíme nejen vynikající kávu, ale také prostor pro sdílení znalostí a zkušeností prostřednictvím našeho fóra. V roce 2018 jsme zahájili sérii mistrovských kurzů, včetně latte artu, které si rychle získaly oblibu mezi našimi zákazníky.</p>
                <p>Naším cílem je vytvořit komunitu, kde si každý může najít své místo — ať už jste nováček nebo zkušený barista.</p>
            </section>

            <section id="values">
                <h2>Naše hodnoty</h2>
                <ul>
                    <li><strong>Kvalita:</strong> Používáme pouze nejlepší kávová zrna, pečlivě vybraná a pražená.</li>
                    <li><strong>Komunita:</strong> Vytváříme prostor pro setkávání a sdílení zážitků.</li>
                    <li><strong>Udržitelnost:</strong> Podporujeme ekologické metody pěstování.</li>
                    <li><strong>Inovace:</strong> Neustále hledáme nové způsoby, jak zlepšit zážitek z kávy.</li>
                </ul>
            </section>
        </main>

        <button id="back-to-top" onclick="scrollToTop()"></button>

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
