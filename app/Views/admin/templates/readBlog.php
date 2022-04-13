<?php include_once('app/Views/admin/layout/header.php') ?>


           <article id="readBlog"> 
               <h1><?= $blog['title'] ?></h1>
                <p><?= $blog['created_at'] ?></p>
                <img src="./Public/admin/img/blog/<?= $blog['img'] ?>">
                <p><?= $blog['content'] ?></p>
</article>
        </section>
    </main>