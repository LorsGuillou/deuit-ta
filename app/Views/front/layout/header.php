<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css ">
    <link rel="stylesheet" href="Public/front/css/style.css">
    <title>Deuit 'ta !</title>
</head>
<body>
    <header>
        <div id="bandeau" class="container">
            <div id="logo">
                <p id="titre">Projet final</p>
                <p id="sous-titre">La dère des dères</p>
            </div>
            <div id="links">
                <div id="user-space">
                    <ul id="user-menu">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 0) : ?>
                        <li class="user-item">
                            <a class="user-link" href="index.php?action=account">Mon compte <i class="fa-solid fa-user"></i></a>
                        </li>
                        <li class="user-item">
                            <a class="user-link" href="index.php?action=logout">Déconnexion <i class="fa-solid fa-right-from-bracket"></i></i></a>
                        </li>
                    <?php else : ?>
                        <li class="user-item">
                            <a class="user-link" href="index.php?action=login">Connexion <i class="fa-solid fa-user-check"></i></a>
                        </li>
                        <li class="user-item">
                            <a class="user-link" href="index.php?action=register">Créer un compte <i class="fa-solid fa-user-plus"></i></a>
                        </li>
                    <?php endif; ?>
                    </ul>
                </div>
                <nav id="navigation">
                    <ul class="nav-menu" id="nav-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=home">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=about">A propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=rencontres">Rencontres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=actu">Actualités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=contact">Contact</a>
                        </li>
                    </ul>
                </nav>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </div>
    </header>