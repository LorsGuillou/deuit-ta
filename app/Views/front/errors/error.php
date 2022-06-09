<?php include_once ('app/Views/front/layout/header.php') ?>

<main class="container">
    <h1 class="alerts"><span class="error">Erreur : <?= $e->getMessage() ?></span></h1>
</main>

<?php include_once ('app/Views/front/layout/footer.php') ?>