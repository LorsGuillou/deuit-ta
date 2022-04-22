<?php include_once ('app/Views/front/layout/header.php') ?>

<main class="container">
    <h1>Bonjour, <?= $_SESSION['firstname'] ?> ! <span class="txt-bzh">Demat deoc'h, <?= $_SESSION['firstname'] ?>
            !</span></h1>
    <h2>Vos commentaires</h2>
    <?php if (empty($comments)) : ?>
        <p>Vous n'avez pas écrit de commentaire.</p>
    <?php else : foreach ($comments as $comment) : ?>
    <h4>Sur l'article <?= $comment['title'] ?> écrit le <?= $comment['created_at'] ?> :</h4>
    <p><?= $comment['comment'] ?></p>
    <a href="index.php?action=deleteCommFromAcc&id=<?= $comment['id'] ?>">
        <i class="fa-solid fa-trash-can action-delete"></i>
    </a>
    <?php endforeach; endif; ?>
    <h2>Changer votre image de profil</h2>
    <form action="editAccount" method="post" enctype="multipart/form-data">
        <p>
            <input type="file" id="edit-avatar" name="image">
        </p>
        <p>
            <button type="submit" id="submit-edit" class="submit">Envoyer</button>
        </p>
    </form>
</main>

<?php include_once ('app/Views/front/layout/footer.php') ?>