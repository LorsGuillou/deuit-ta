<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css ">
    <link rel="icon" type="image/x-icon" href="Public/front/img/front/favicon.jpg">
    <link rel="stylesheet" href="Public/front/css/style.css">
    <title>Deuit 'ta !</title>
</head>

<body>
    <header>
        <div id="headband" class="container">
            <div id="logo">
                <a href="home" title="Deuit 'ta !">
                    <img src="Public/front/img/front/logo.png" alt="Logo Deuit 'ta !">
                </a>
            </div>
            <?php if (!empty($_SESSION)) : ?>
            <figure id="avatar">
                <img src="./Public/front/img/avatars/<?= $_SESSION['avatar'] ?>" alt="Votre image de profil">
            </figure>
            <?php endif; ?>
            <nav id="navigation">
                <ul class="nav-menu" id="nav-menu">
                    <li class="nav-item">
                        <a class="nav-link active" href="home" title="Accueil"><i class="fa-solid fa-house"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about" title="A propos"><i class="fa-solid fa-id-card"></i> A propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog" title="Blog"><i class="fa-solid fa-newspaper"></i> Blog</a>
                    </li>
                    <?php if (!empty($_SESSION)) : ?>
                    <!-- Fonction à venir -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="activities"><i class="fa-solid fa-calendar"> </i>Activités</a>
                    </li> -->
                    <?php if (!empty($_SESSION) && $_SESSION['role'] != 1) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="contact" title="Contact"><i class="fa-solid fa-envelope"></i> Contact</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="account" title="Mon compte"><i class="fa-solid fa-user"></i> Mon compte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout" title="Déconnexion"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
                    </li>
                    <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login" title="Connexion"><i class="fa-solid fa-user-check"></i> Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register" title="Créer un compte"><i class="fa-solid fa-user-plus"></i>Créer un compte</a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION) && $_SESSION['role'] === 1) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/home" title="Administration"><i class="fa-solid fa-gear"></i></i>Administration</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <a href="noJSNav" class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>

        </div>
    </header>