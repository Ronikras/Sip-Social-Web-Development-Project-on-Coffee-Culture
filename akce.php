<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sip & Social - Akce">
        <title>Sip & Social - Akce</title>
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
                    <li><a href="akce.phpl">Akce</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="ucet.php">Účet</a></li>
                    <li><a href="logout.php">Odhlásit se</a></li>
                <?php else: ?>
                    <li><a href="vchod.php">Přihlásit se</a></li>
                <?php endif; ?>                    
                </ul>
            </nav>
        </header>

        <main>
            <section id="blog-intro">
                <h2>Naše akce</h2>
                <p>Objevte fascinující svět výběrové kávy. Zjistěte více o jejím původu, zpracování a způsobech přípravy v praxi.</p>
            </section>
            <section id="photo-scrollbar" class="scrollbar-section">
                <div class="scroll-wrapper">
                    <button class="scroll-btn left" onclick="scrollLeft()">&#8249;</button>
                    <div class="scroll-container">
                        <img src="img/10.jpg" alt="Table with smth">
                        <img src="img/11.jpg" alt="Mini show">
                        <img src="img/12.jpg" alt="Exited people">
                        <img src="img/13.jpg" alt="Cupping">
                        <img src="img/14.jpg" alt="Clipping">
                    </div>
                    <button class="scroll-btn right" onclick="scrollRight()">&#8250;</button>
                </div>
                <h3>Fotografie z našich akcí</h3>
            </section>
            <section id="blog-articles">
                <h2>Články</h2>
                <article class="blog-card">
                    <h3>Večírek Latte Artu</h3>
                    <p class="excerpt">Minulý pátek se naše kavárna proměnila v místo, kde se mísí vůně čerstvě připraveného espressa, nadšení pro latte art a radost ze společného tvoření. Večer byl věnován nejen milovníkům kávy, ale i těm, kteří si chtěli vyzkoušet umění kreslení mléčnou pěnou pod vedením našich zkušených baristů.</p>
                    <?php if ($isLoggedIn): ?>
                    <div class="full-article">
                        <p>
                            <strong>Začátek večera</strong><br>
                            Událost jsme zahájili krátkým povídáním o historii latte artu, jeho různých stylech a nejčastějších technikách, které baristé používají. Hosté se dozvěděli, jak správně našlehat mléko a proč je důležité mít dokonale připravený základ v podobě kvalitního espressa.
                            <br><br>
                            <strong>Praktická část</strong><br>
                            Po teorii následovala praktická část, kde si účastníci mohli sami vyzkoušet tvořit. Pod vedením našich baristů se hosté učili vytvořit jednoduché vzory, jako jsou srdíčka nebo tulipány. Pro pokročilejší byly připraveny složitější motivy, například rozety nebo labutě. Atmosféra byla plná smíchu, podpory a radosti z každého povedeného pokusu.
                            <br><br>
                            <strong>Soutěž o nejlepší latte art</strong><br>
                            Vyvrcholením večera byla soutěž o nejlepší latte art, kde účastníci ukázali, co se během večera naučili. Porota, složená z našich baristů a náhodně vybraných hostů, hodnotila preciznost, kreativitu a celkový dojem. Vítěz si odnesl malý dárek – balíček výběrové kávy z naší nabídky a voucher na další kurz zdarma.
                            <br><br>
                            <strong>Nezapomenutelný zážitek</strong><br>
                            Večer byl skvělou příležitostí pro milovníky kávy, aby se dozvěděli více o světě speciality coffee, naučili se něco nového a užili si příjemný čas v naší komunitě. Odcházející hosté se shodli na tom, že to rozhodně nebyl jejich poslední večer v "Sip & Social"
                        </p>
                    </div>
                    <?php endif; ?>
                    <button class="toggle-article" data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>">Číst více</button>
                </article>
                <article class="blog-card">
                    <h3>Workshop: Tajemství alternativních metod přípravy kávy – Jak jsme objevovali nové chutě</h3>
                    <p class="excerpt">Minulou sobotu se naše kavárna "Sip & Social" proměnila v laboratoř plnou nadšených milovníků kávy, kteří se chtěli ponořit do tajů alternativních metod přípravy. Workshop přilákal všechny – od začátečníků až po zkušené kávové nadšence.</p>
                    <?php if ($isLoggedIn): ?>
                    <div class="full-article">
                        <p>
                            <strong>Co jsme zažili?</strong></p><br>
                            <ul>
                                <li><strong>Úvod do alternativních metod</strong><br>Večer začal teoretickou částí, kde jsme účastníkům představili různé způsoby přípravy kávy – Chemex, V60, AeroPress a French Press. Baristé vysvětlili, jak každá metoda dokáže podtrhnout jiné chuťové nuance a jak správný postup ovlivňuje výsledný šálek.</li>
                                <li><strong>Praktická část</strong><br>Praktická část byla plná nadšení a experimentů. Každý účastník si mohl sám připravit kávu metodou podle svého výběru, a to pod vedením našich zkušených baristů. Výsledkem byly šálky kávy, které překvapily svou rozmanitostí chutí – od jemných květinových tónů až po intenzivní čokoládové podtóny.</li>
                                <li><strong>Ochutnávka a párování chutí</strong><br>Největší radost měli hosté při ochutnávce, kde jsme každou připravenou kávu párovali s různými pokrmy. Sladké dezerty, oříšky i jemně slané pečivo skvěle doplňovaly chuť jednotlivých káv. Každý šálek byl malým objevem.</li>
                                <li><strong>Tipy a rady na závěr</strong><br>Na závěr jsme s účastníky sdíleli praktické rady, jak si tyto metody vyzkoušet i doma. Každý si odnesl nejen zážitek, ale také tištěný návod s doporučeními, aby si mohl vytvořit dokonalý šálek i ve své kuchyni</li>
                            </ul>
                            <br><br>
                        <p><strong>Atmosféra, na kterou nezapomeneme</strong>
                            <br>
                            Celý večer se nesl ve znamení sdílení, radosti a společné vášně pro kávu. Účastníci odcházeli nadšení a plní inspirace. Mnozí se svěřili, že si poprvé uvědomili, jak může být příprava kávy zážitkem a uměním zároveň.
                        </p>
                    </div>
                    <?php endif; ?>
                    <button class="toggle-article" data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>">Číst více</button>
                </article>
            </section>
            <div class="pagination">
                <button id="prev-article" disabled>&larr; Předchozí</button>
                <button id="next-article">Další &rarr;</button>
            </div>
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