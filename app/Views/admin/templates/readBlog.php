<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1><?= $blog['title'] ?></h1>
            <?php if ($blog['created_at'] != $blog['updated_at']) : ?>
                <p>Publié le <?= $blog['created_at'] ?></p>
                <p>Edité le <?= $blog['updated_at'] ?></p>
            <?php else : ?>
                <p><?= $blog['created_at'] ?></p>
            <?php endif; ?>
            <p><?= $blog['content'] ?></p>
        </section>
    </main>