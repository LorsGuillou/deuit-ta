<?php include_once ('app/Views/front/layout/header.php') ?>

<main class="container account-page">
    <h1>Bonjour, <?= $_SESSION['username'] ?> ! <span class="txt-bzh">Demat deoc'h, <?= $_SESSION['username'] ?>
            !</span></h1>
    <div class="alerts">
        <?= $alert ?>
    </div>
    <h2>Vos commentaires</h2>
    <div id="all-comments">
        <?php if (empty($comments)) : ?>
        <p>Vous n'avez pas écrit de commentaire.</p>
        <?php else : foreach ($comments as $comment) : ?>
        <div class="one-comment">
            <h4>Sur l'article <?= $comment['titleFR'] ?> écrit le <?= $comment['date'] ?> :</h4>
            <p><?= $comment['comment'] ?></p>
            <div class="one-comment-actions">
                <a class="back-to-blog" href="blogRead&id=<?= $comment['link'] ?>" title="Aller sur l'article <?= $comment['titleFR'] ?>">
                    <i class="fa-solid fa-reply"></i>
                </a>
                <a class="delete-comment" href="accountDeleteComment&id=<?= $comment['id'] ?>"
                    title="Effacer le commentaire">
                    <i class="fa-solid fa-trash-can action-delete"></i>
                </a>
            </div>
        </div>
        <?php endforeach; endif; ?>
    </div>

    <form action="accounteditUsername" method="post" class="input-page">
        <h2>Changer votre pseudonyme</h2>
        <p>
            <input type="text" id="edit-username" name="edit-username" placeholder="Nouveau pseudonyme">
        </p>
        <p>
            <button type="submit" id="submit-editUsername" class="submit">Envoyer</button>
        </p>
    </form>

    <form action="accountEditAvatar" method="post" enctype="multipart/form-data" class="input-page">
        <h2>Changer votre image de profil</h2>
        <p>
            <input type="file" id="edit-avatar" name="image">
        </p>
        <p>
            <button type="submit" id="submit-editAvatar" class="submit">Envoyer</button>
        </p>
    </form>

    <form action="accountEditMail" method="post" class="input-page">
        <h2>Changer votre adresse e-mail</h2>
        <p>
            <input type="email" id="edit-mail" name="edit-mail" placeholder="Nouvelle adresse e-mail">
        </p>
        <p>
            <button type="submit" id="submit-editMail" class="submit">Envoyer</button>
        </p>
    </form>

    <form action="accountEditPswd" method="post" class="input-page">
        <h2>Changer votre mot de passe</h2>
        <p class="pswdSpace">
            <input type="password" id="password" name="edit-password" placeholder="Nouveau mot de passe"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Le mot de passe doit contenir au moins 8 caractères, 1 chiffre, 1 lettre majuscule et 1 lettre minuscule.">
            <i class="fa-solid fa-eye" id="togglePswd"></i>
        </p>
        <div id="pswdMessage">
            <p>Le mot de passe doit contenir :</p>
            <p id="pswdLength" class="invalid">Au moins 8 caractères</p>
            <p id="pswdNumber" class="invalid">Un chiffre</p>
            <p id="pswdUpper" class="invalid">Une lettre majuscule</p>
            <p id="pswdLower" class="invalid">Une lettre minuscule</p>
        </div>
        <p class="pswdSpace">
            <input type="password" id="confirmPswd" name="edit-confirmPswd"
                placeholder="Confirmer le nouveau mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            <i class="fa-solid fa-eye" id="toggleConfirm"></i>
        </p>
        <p>
            <button type="submit" id="submit-editPswd" class="submit">Envoyer</button>
        </p>
    </form>
</main>

<?php include_once ('app/Views/front/layout/footer.php') ?>