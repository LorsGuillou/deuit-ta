<?php include_once ('app/Views/front/layout/header.php') ?>

    <main class="container">
        <article id="read-blog"> 
               <h1><?= $blog['titleFR'] ?></h1>
                <p><?= $blog['date'] ?></p>
                <img src="./Public/admin/img/blog/<?= $blog['img'] ?>" alt="<?= $blog['titleFR'] ?>">
                <p><?= $blog['contentFR'] ?></p>
        </article>
        <?php if (isset($comments)) : ?>
            <div id="comments">
                <h4>Commentaires (<?= $number['0'] ?>)</h4>
                <?php foreach ($comments as $comment) : ?>
                    <h5><img src="./Public/front/img/avatars/<?= $comment['avatar'] ?>"> <?= $comment['lastname'] ?> <?= $comment['firstname'] ?></h5>
                    <p><?= $comment['date'] ?></p>
                    <p><?= $comment['comment'] ?></p>
                    <?php if (!empty($_SESSION) && $comment['idUser'] === $_SESSION['id'] || !empty($_SESSION) && $_SESSION['role'] === 1) : ?>
                        <a href="index.php?action=deleteComment&id=<?= $comment['id'] ?>&idPage=<?= $blog['id'] ?>">
                            <i class="fa-solid fa-trash-can action-delete"></i>
                        </a>
                    <?php endif; ?>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($_SESSION)) : ?>
            <h4>Laissez un commentaire</h4>
            <form id="commenting" action="index.php?action=comment&id=<?= $blog['id'] ?>" method="post">
                <textarea name="type-comment" maxlength="250" placeholder="..."></textarea>
                <button type="submit" class="submit">Envoyer</button>
            </form>
        <?php else : ?>
            <p>Vous souhaitez commenter sur cet article ? <a href="index.php?action=register">Créez un compte</a> ou <a href="index.php?action=login">connectez-vous</a>.</p>
            <p class="txt-bzh">Vous souhaitez commenter sur cet article ? <a href="index.php?action=register">Créez un compte</a> ou <a href="index.php?action=login">connectez-vous</a>.</p>
        <?php endif; ?>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>