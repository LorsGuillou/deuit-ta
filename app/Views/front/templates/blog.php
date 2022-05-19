<?php include_once ('app/Views/front/layout/header.php') ?>

    <main class="container">
        <h1>Actualités</h1>
            <section id="blog-page">
            <?php foreach ($blogs as $blog) : ?>
                <article class="blog-layout">
                    <h3 class="blog-title"><?= $blog['titleFR'] ?> <span class="txt-bzh"><?= $blog['titleBZH'] ?></span></h3>
                    <p class="blog-date"><?= $blog['date'] ?></p>
                    <img src="./Public/admin/img/blog/<?= $blog['img'] ?>" alt="<?= $blog['titleFR'] ?>">
                    <p class="blog-content"><?= $blog['excerptFR'] ?></p>
                    <p class="blog-content"><?= $blog['excerptBZH'] ?></p>
                    <a href="readBlog&id=<?= $blog['id'] ?>">Lire la suite</a>
                </article>
            <?php endforeach; ?>
            </section>
            <?php if ($pages > 1) : ?>
            <nav id="blog-pagination">
                <ul class="pagination">
                    <li class="page-nav <?= ($currentPage == 1) ? "hidden" : "" ?>">
                        <a href="blog&page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                    </li>
                    <?php for ($page = 1; $page <= $pages; $page++) : ?>
                    <li class="page-nav <?= ($currentPage == $page) ? "active" : "" ?>">
                        <a href="blog&page=<?= $page ?>" class="page-link"><?= $page ?></a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-nav <?= ($currentPage == $pages) ? "hidden" : "" ?>">
                        <a href="blog&page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>