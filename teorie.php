<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sip & Social - Blog">
        <title>Sip & Social - Blog</title>
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
                    <li><a href="teorie.php" class="active">Blog</a></li> 
                    <li><a href="akce.php">Akce</a></li>
                    <?php if ($isLoggedIn): ?>
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
                <h2>Náš blog</h2>
                <p>Objevte fascinující svět výběrové kávy. Zjistěte více o jejím původu, zpracování a způsobech přípravy. Nechte se inspirovat našimi příběhy a tipy.</p>
            </section>
            <section id="blog-articles">
                <h2>Články</h2>
                <article class="blog-card" data-article="1">
                    <h3>Coffee Brew Control Chart</h3>
                    <p class="excerpt">Kontrolní diagram přípravy kávy je užitečný nástroj pro každého, kdo chce dosáhnout dokonalé chuti svého šálku...</p>
                    <?php if ($isLoggedIn): ?>
                        <div class="full-article">
                            <p> Klíčové pojmy: </p>
                                <ul>
                                        <li><strong>TDS (Total Dissolved Solids)</strong>: Množství rozpuštěných látek v kávě (měřeno v %)</li>
                                        <li><strong>Extrakce</strong>: Procento látek extrahovaných ze zrn během přípravy (ideální rozmezí: 18–22 %).</li>
                                </ul>
                                    <br><br>
                            <p>Optimální varná zóna: </p>
                                <ul>
                                    <li><strong>Podextrahováno</strong>: Chuť je kyselá a slabá (méně než 18 %).</li>
                                    <li><strong>Přeextrahováno</strong>: Chuť je hořká a nepříjemná (více než 22 %).</li>
                                    <li><strong>Ideální zóna</strong>: Vyvážená sladkost, kyselost a hořkost (18–22 % extrakce, TDS 1,15–1,35 %).</li>
                                </ul>
                                <br><br>
                            <p> Jak dosáhnout dokonalé kávy? </p>
                                <ul>
                                    <li><strong>Správné mletí</strong>: Jemnější mletí zvyšuje extrakci, hrubší ji snižuje.</li>
                                    <li><strong>Teplota vody</strong>: Používejte vodu o teplotě 90-96°C. Příliš horká voda vede k přehnané extrakci, příliš studená k nedostatečné.</li>
                                    <li><strong>Doba přípravy</strong>: Kratší doba vede k slabší extrakci, delší zvyšuje intenzitu chuti.</li>
                                    <li><strong>Poměr kávy a vody</strong>: Ideální je pooměr 1:15 až 1:17.</li>
                                </ul>
                                <br>
                            <p><strong>Tip navíc</strong>: Použijte refraktometr, který vám přesně změří TDS, a posuňte svou přípravu kávy na další úroveň.</p>
                        </div>
                    <?php endif; ?>
                    <button class="toggle-article" data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>">Číst více</button>
               </article>
                <article class="blog-card" data-article="2">
                    <h3>Cupping: Ochutnávka kávy</h3>
                    <p class="excerpt">Při cuppingu ochutnáváme různé kávy, abychom porovnali jejich vlastnosti...</p>
                    <?php if ($isLoggedIn): ?>
                        <div class="full-article">
                            <p>
                                Cupping je proces degustace kávy, který umožňuje porovnat různé druhy zrn a pochopit jejich vlastnosti.<br> Při ochutnávce se zaměřujeme na vůni, chuť, kyselost a tělo kávy.<br> Proces zahrnuje přípravu mletých zrn, zalití horkou vodou, rozbití vytvořené krusty a postupnou degustaci. Je to ideální způsob, jak identifikovat rozdíly mezi výběrovou kávou a méně kvalitními druhy. </p>
                                <br><br>
                            <p> Natsavení: </p>
                                <ul>
                                    <li><strong>Vybavení</strong><br> Vezměte si misky nebo malé šálky, lžičky, mlýnek, čerstvě upražená kávová zrna, váhu, horkou vodu (těsně před varem) a formulář na poznámky.</li>
                                    <li><strong>Příprava zrn</strong><br> Namelte kávová zrna na hrubou konzistenci, podobnou strouhance, a dbejte na to, aby byl každý druh kávy namletý zvlášť. (po předchozím mletí je třeba předem namlít trochu následujícího zrna, abyste se zbavili zbytků v mlýnku);
                                    <br> Na jeden šálek použijte přibližně 8-10 gramů kávy.</li>
                                </ul>
                                <br><br>
                            <p> Cupping process: </p>
                                <ul>
                                    <li><strong>Suchá kávová drť</strong><br>Udělejte si chvilku času a přivoňte si k suché kávové sedlině. Před přidáním vody si všimněte všech výrazných vůní.</li>
                                    <li><strong>Voda</strong><br>Horkou vodou (cca 93 °C) rovnoměrně navlhčete kávovou sedlinu a zajistěte, aby byla všechna sedlina nasáklá. Nechte na povrchu vytvořit krustu tím, že ji necháte asi 4 minuty odstát.</li>
                                    <li><strong>Rozbití krusty</strong><br>Po 4 minutách pomocí lžičky jemně rozbijte krustu tím, že odstrčíte kávovou sedlinu a zhluboka vdechnete uvolněné aroma. Zaznamenejte si vůně, které zjistíte. </li>
                                    <li><strong>Ochutnávka</strong><br>Po rozlomení kůry odstraňte všechny zbytky usazenin na povrchu.
                                    <br>Pomocí lžičky kávu ochutnejte. Naberte si malou lžičku, hlasitě zamlaskejte (tím se káva provzdušní a rozprostře po celém patře) a nechte ji pokrýt celá ústa.
                                    <br>Všímejte si chuti, kyselosti, obsahu a dochuti. Pokuste se identifikovat specifické chutě nebo vlastnosti.
                                    <br>Všimněte si, že se snižující se teplotou se profil kávy otevírá. </li>
                                    <li><strong>Zaznamenávání pozorování</strong> (nepovinné)<br>Vyplňte <a href="img/cuppingForm.pdf" target="_blank">cuppingový formulář</a> a u každého ochutnaného šálku zaznamenejte původ kávy, její vůni, chuť, kyselost, tělo a dochuť.
                                    <br>Porovnejte různé kávy vedle sebe, abyste zjistili jejich jedinečné vlastnosti.</li>
                                    <li><strong>Diskuse</strong><br>Podpořte diskusi mezi účastníky. Diskutujte o tom, co kdo zažil z hlediska vůně, chuti a celkového profilu.</li>
                                </ul>                        
                        </div>
                    <?php endif; ?>
                    <button class="toggle-article" data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>">Číst více</button>
                </article>
                <article class="blog-card hidden" data-article="3">
                    <h3>Příprava kávy s V60: Dokonalý šálek ve 8 krocích</h3>
                    <p class="excerpt">Objevte kouzlo přípravy kávy s V60! Tento jednoduchý, ale efektivní způsob přípravy zvýrazní všechny jemné chutě a vůně vašeho oblíbeného zrna. S naším rychlým průvodcem zvládnete perfektní šálek kávy i doma – stačí pár základních pomůcek a trocha trpělivosti.</p>
                    <?php if ($isLoggedIn): ?>
                    <div class="full-article hidden">
                        <p>
                            <strong>Co budete potřebovat?</strong> </p>
                            <ul>
                                <li>V60 dripper</li>
                                <li>Filtry pro V60</li>
                                <li>Mlýnek na kávu</li>
                                <li>Čerstvá kávová zrna</li>
                                <li>Konvice</li>
                                <li>Váha</li>
                                <li>Stopky</li>
                                <li>Hrnek nebo karafa</li>
                            </ul>
                            <br><br>
                        <p> Postup přípravy kávy V60: </p>
                            <ul>
                                <li><strong>Zahřejte vodu</strong>: Zahřejte vodu na <strong>95 °C</strong>. Pokud nemáte teploměr, počkejte po varu <strong>30 sekund</strong>, než začnete nalévat</li>
                                <li><strong>Namelte kávu</strong>: Mezitím namelete kávu na středně jemnou hrubost, podobnou kuchyňské soli. Potřebujete cca <strong>30 gramů kávy na 475 ml vody</strong> (poměr 1:16).</li>
                                <li><strong>Připravte V60 a filtr</strong>: Položte V60 na hrnek nebo karafu, vložte filtr a propláchněte ho horkou vodou. Tím odstraníte papírovou pachuť a zároveň předehřejete nádobu. Nezapomeňte vodu z proplachování vylít!</li>
                                <li><strong>Nasypte kávu</strong>: Do filtru nasypte namletou kávu a lehce s dripperem zatřeste, aby se káva vyrovnala.</li>
                                <li><strong>Blooming</strong>: Nalijte jen tolik vody, aby všechny kávové zrníčka zvlhla, a nechte kávu <strong>30 sekund "rozkvést"</strong>. Tím se uvolní plyny a zlepší se extrakce chutí.</li>
                                <li><strong>Postupné zalévání</strong>: Po blooming pokračujte pomalým a rovnoměrným zaléváním vody spirálovitým pohybem – začněte od středu a postupně se posouvejte k okrajům. Celé nalévání by mělo trvat <strong>asi 2 minuty</strong>.</li>
                                <li><strong>Dokapáván</strong>: Po nalití vody počkejte, až káva dokape, což zabere další <strong>30 sekund až 1 minutu</strong>.</li>
                                <li><strong>Vychutnejte si kávu</strong>: Použitou kávu a filtr vyhoďte, zamíchejte hotovou kávu a vychutnejte si svůj dokonalý šálek!</li>
                            </ul>
                            <br>
                            <p><strong>Tip navíc</strong>: Příprava kávy s V60 je kombinací vědy a umění. Experimentujte s množstvím kávy, hrubostí mletí a technikou nalévání, abyste našli chuť, která vám nejvíce vyhovuje.</p>
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
