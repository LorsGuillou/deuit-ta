<?php include_once('app/Views/admin/layout/header.php'); ?>

            <h1 id="title-mail">De : <?= $mail['username'] ?></h1>
                <div class="read-mail">
                    <h3>Objet : <?= $mail['object'] ?></h3>
                        <p><?= $mail['message'] ?></p>
                        <a href="mailto:<?= $mail['mail'] ?>" title="Répondre au mail"><i class="fa-solid fa-reply action-mail"></i></a>
                </div>
            </div>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>