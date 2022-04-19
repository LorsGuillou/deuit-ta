<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css ">
    <link rel="stylesheet" href="Public/admin/css/style.css">
    <title>Deuit 'ta ! - Admin</title>
</head>
<body>
    <header>
        <div id="bandeau" class="container">
            <a href="home"><?= $_SESSION['firstname'] ?> <?= $_SESSION['lastname'] ?></a>
        </div>        
    </header>
    <main>
        <section id="side-menu">
            <nav id="navigation">
                <ul id="admin-menu">
                    <li class="admin-item"><a href="indexAdmin.php?action=users"><i class="fa-solid fa-users"></i> Membres</a></li>
                    <li class="admin-item"><a href="indexAdmin.php?action=mails"><i class="fa-solid fa-envelope"></i> Mails</a></li>
                    <li class="admin-item"><a href="indexAdmin.php?action=blog"><i class="fa-solid fa-newspaper"></i> Articles</a></li>
                    <li class="admin-item"><a href="indexAdmin.php?action=adminactivities"><i class="fa-solid fa-calendar"></i> Activités</a></li>
                    <li class="admin-item"><a href="indexAdmin.php?action=navigate"><i class="fa-solid fa-house"></i> Site</a></li>
                    <li class="admin-item"><a href="indexAdmin.php?action=logout" class="disconnect"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a></li>
                </ul>
            </nav>
        </section>
        <section id="dashboard" class="container">


