<?php
$lang = 'fr';

if (isset($_GET['lang'])) {
    if ($_GET['lang'] === 'en' || $_GET['lang'] === 'fr') {
        setcookie(
            'lang',
            $_GET['lang'],
            time() + 60 * 60 * 24 * 365,
            '',
            '',
            true,
            true
        );
        $lang = $_GET['lang'];
    }
} else {
    if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] === 'en' || $_COOKIE['lang'] === 'fr')) {
        $lang = $_COOKIE['lang'];
    }
}

if ($lang === 'en') {
    require_once 'assets/php/eng.php';
} else {
    require_once 'assets/php/fr.php';
}
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <link rel="icon" href="assets/css/img/icon.png">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <nav id="navbar">
            <a href="/" title="Retour à la page d'accueil">
                <img src="assets/css/img/home.jpg" alt="Logo" aria-hidden="true" />
            </a>
            <button class="hamburger" aria-label="Toggle Navigation">☰</button>
            <div class="nav-menu">
                <ul>
                <button id="projectsButton"><?= $trad['nav']['projects'] ?></button>
                <button id="contactFormButton"><?= $trad['nav']['c_form'] ?></button>
                <button id="contactsButton"><?= $trad['nav']['contacts'] ?></button>
                <button id="adminButton"><?= $trad['nav']['admin']?></button>
                <button id="languageButton"><?= $trad['nav']['change_lang'] ?></button>
                </ul>
            </div>
        </nav>
    </header>

    <section id='titleSection'>
    <img src="assets/css/img/background.jpg" alt="Background Image"/>
    <div class="overlay-container">
        <img src="assets/css/img/photo_portfolio.jpg" class="overlay-img" alt="Overlay Image"/>
        <div class="portfolio-text">
            <h2><?= $trad['portfolio_title'] ?></h2>
            <p><?= $trad['portfolio_subtitle'] ?></p>
        </div>
        </div>
    </section>

    <main>
        <h1 id="projectsSection"><?= $trad['projects_section'] ?></h1>

        <div class="projects-container">
            <?php
                require_once 'assets/php/database/projects/projects.php';
                $project = new Project();
                $projects = $project->getPaginated(0, 6); 
    
                foreach ($projects as $item): 
            ?>
            <article class="project-article">
                <img src="assets/css/img/projects/<?= htmlspecialchars($item['photo']) ?>" 
                    alt="<?= htmlspecialchars($item['name']) ?> Image">
                <h2><?= htmlspecialchars($item['name']) ?></h2>
            </article>
            <?php endforeach; ?>
        </div>
    
        <button id="moreProjButton"><?= $trad['moreProj'] ?></button>
        
        <h1 id="contactForm"><?= $trad['contact_form'] ?></h1>
        <p id="infoForCustomers"><?= $trad['info'] ?></p>
        <?php include 'assets/php/database/form/form.php'; ?>
    </main>

    <footer id="contactsSection">
        <div class="social-links">
            <a href="https://github.com/iveverita?tab=repositories" target="_blank" rel="noopener noreferrer">
                <img src="assets/css/img/git.jpg" alt="Git Logo">
            </a>
            <a href="https://www.instagram.com/veveritavv/" target="_blank" rel="noopener noreferrer">
                <img src="assets/css/img/inst.jpg" alt="Instagram Logo">
            </a>
            <a href="https://www.linkedin.com/in/iveverita/" target="_blank" rel="noopener noreferrer">
                <img src="assets/css/img/linkedin.jpg" alt="LinkedIn Logo">
            </a>
        </div>
        <p> <?= $trad['phone'] ?>: <a href="phone">+33634969178</a></p>
        <p> <?= $trad['email'] ?>: <a href="mail">iveverita@icloud.com</a></p>
    </footer>
    <script src="assets/js/buttons.js"></script>
    <script src="assets/ajax/more_proj.js"></script>
</body>

</html>