<?php include_once ('app/Views/front/layout/header.php') ?>

<main class="container">
    <nav id="emergency-navigation">
        <ul class="nav-menu">
            <li class="nav-item">
                <a class="nav-link link-to-blog" href="home" title="Accueil"><i class="fa-solid fa-house"></i> Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-to-blog" href="about" title="A propos"><i class="fa-solid fa-id-card"></i> A propos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-to-blog" href="blog" title="Blog"><i class="fa-solid fa-newspaper"></i> Blog</a>
            </li>
            <?php if (!empty($_SESSION)) : ?>
            <!-- Fonction à venir -->
            <!-- <li class="nav-item">
                        <a class="nav-link link-to-blog" href="activities"><i class="fa-solid fa-calendar"> </i>Activités</a>
                    </li> -->
            <li class="nav-item">
                <a class="nav-link link-to-blog" href="contact" title="Contact"><i class="fa-solid fa-envelope"></i> Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-to-blog" href="account" title="Mon compte"><i class="fa-solid fa-user"></i> Mon compte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-to-blog" href="logout" title="Déconnexion"><i class="fa-solid fa-right-from-bracket"></i>
                    Déconnexion</a>
            </li>
            <?php else : ?>
            <li class="nav-item">
                <a class="nav-link link-to-blog" href="login" title="Connexion"><i class="fa-solid fa-user-check"></i> Connexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-to-blog" href="register" title="Créer un compte"><i class="fa-solid fa-user-plus"></i>Créer
                    un
                    compte</a>
            </li>
            <?php endif; ?>
            <?php if (!empty($_SESSION) && $_SESSION['role'] === 1) : ?>
            <li class="nav-item">
                <a class="nav-link link-to-blog" href="admin/home" title="Administration"><i
                        class="fa-solid fa-gear"></i></i>Administration</a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</main>

<?php include_once ('app/Views/front/layout/footer.php') ?>