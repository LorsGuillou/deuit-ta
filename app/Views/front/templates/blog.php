<?php include_once ('app/Views/front/layout/header.php') ?>

    <main class="container">
        <h1>Actualités</h1>
            <div id="blog-page">
                <?php foreach ($blogs as $blog) : ?>
                <article class="blog-layout">
                    <h3><?= $blog['title'] ?></h3>
                    <p><?= $blog['created_at'] ?></p>
                    <img src="./Public/admin/img/blog/<?= $blog['img'] ?>" alt="<?= $blog['title'] ?>">
                    <p><?= $blog['excerpt'] ?></p>
                    <a href="readBlog&id=<?= $blog['id'] ?>">Lire la suite</a>
                </article>
                <?php endforeach; ?>
            </div>
        <nav>
            <ul class="pagination">
                <li class="page-nav <?= ($currentPage == 1) ? "hide" : "" ?>">
                    <a href="blog&page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                </li>
                <?php for ($page = 1; $page <= $pages; $page++) : ?>
                <li class="page-nav <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="blog&page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-nav <?= ($currentPage == $pages) ? "hide" : "" ?>">
                    <a href="blog&page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                </li>
            </ul>
        </nav>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>