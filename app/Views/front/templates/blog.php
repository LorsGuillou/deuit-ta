<?php include_once ('app/Views/front/layout/header.php') ?>

    <main class="container">
        <h1>Blog</h1>
            <div id="blog-page">
            <?php foreach ($blogs as $blog) : ?>
                <article class="blog-layout">
                    <h3 class="blog-title"><?= $blog['titleFR'] ?> <span class="txt-bzh"><?= $blog['titleBZH'] ?></span></h3>
                    <p class="blog-date"><?= $blog['date'] ?></p>
                    <img src="./Public/admin/img/blog/<?= $blog['img'] ?>" alt="<?= $blog['titleFR'] ?>">
                    <p class="blog-layout-excerpt"><?= $blog['excerptFR'] ?></p>
                    <p class="blog-layout-excerpt txt-bzh"><?= $blog['excerptBZH'] ?></p>
                    <a class="link-to-blog" href="blogRead&id=<?= $blog['id'] ?>" title="Lire l'article <?= $blog['titleFR'] ?>">Lire la suite</a>
                </article>
            <?php endforeach; ?>
            </div>
            <?php if ($pages > 1) : ?>
            <nav id="blog-pagination">
                <ul class="pagination">
                    <li class="page-nav <?= ($currentPage == 1) ? "hidden" : "" ?>">
                        <a href="blog&page=<?= $currentPage - 1 ?>" class="page-link" title="Page précédente"><i class="fa-solid fa-left-long"></i></a>
                    </li>
                    <?php for ($page = 1; $page <= $pages; $page++) : ?>
                    <li class="page-nav <?= ($currentPage == $page) ? "active" : "" ?>">
                        <a href="blog&page=<?= $page ?>" class="page-link" title="Page <?= $page ?>"><?= $page ?></a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-nav <?= ($currentPage == $pages) ? "hidden" : "" ?>">
                        <a href="blog&page=<?= $currentPage + 1 ?>" class="page-link" title="Page suivante"><i class="fa-solid fa-right-long"></i></a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>