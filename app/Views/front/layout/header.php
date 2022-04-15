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
        <div id="headband" class="container">
            <div id="logo">
                <img src="Public/front/img/app/logo.png" alt="Logo Deuit 'ta !">
            </div>
            <div id="links">
                <div id="user-space">
                    <ul id="user-menu">
                    <?php if (!empty($_SESSION)) : ?>
                        <li class="user-item">
                            <a class="user-link" href="account"><i class="fa-solid fa-user"></i> Mon compte</a>
                        </li>
                        <li class="user-item">
                            <a class="user-link" href="logout"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</i></a>
                        </li>
                    <?php else : ?>
                        <li class="user-item">
                            <a class="user-link" href="login"><i class="fa-solid fa-user-check"></i> Connexion</a>
                        </li>
                        <li class="user-item">
                            <a class="user-link" href="register"><i class="fa-solid fa-user-plus"></i>Créer un compte</a>
                        </li>
                    <?php endif; ?>
                    </ul>
                </div>
                <nav id="navigation">
                    <ul class="nav-menu" id="nav-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="home">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about">A propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="actu">Actualités</a>
                        </li>
                        <?php if (!empty($_SESSION)) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="activities">Activités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact">Contact</a>
                        </li>
                        <?php endif; ?>
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