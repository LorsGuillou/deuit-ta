<?php include_once('app/Views/admin/layout/header.php') ?>

           <article id="readBlog"> 
               <h1><?= $blog['titleFR'] ?></h1>
                <p><?= $blog['date'] ?></p>
                <img src="./Public/admin/img/blog/<?= $blog['img'] ?>">
                <p><?= $blog['contentFR'] ?></p>
            </article>
        </section>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>