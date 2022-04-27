<?php include_once ('app/Views/front/layout/header.php') ?>

    <main class="container">
        <h1>Actualités</h1>
        <?php foreach ($blogs as $blog) : ?>
            <h3><?= $blog['title'] ?></h3>
            <p><?= $blog['created_at'] ?></p>
            <img src="./Public/admin/img/blog/<?= $blog['img'] ?>" alt="<?= $blog['title'] ?>">
            <p><?= $blog['excerpt'] ?></p>
        <?php endforeach; ?>
        <nav>
            <ul class="pagination">
                <li class="page-nav <?= ($currentPage == 1) ? "hide" : "" ?>">
                    <a href="actu&page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                </li>
                <?php for ($page = 1; $page <= $pages; $page++) : ?>
                <li class="page-nav <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="actu&page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-nav <?= ($currentPage == $pages) ? "hide" : "" ?>">
                    <a href="actu&page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                </li>
            </ul>
        </nav>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>