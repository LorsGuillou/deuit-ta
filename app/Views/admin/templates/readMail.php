<?php include_once('app/Views/admin/layout/header.php'); ?>

            <h1 id="title-mail">De : <?= $mail['lastname'] ?> <?= $mail['firstname'] ?></h1>
                <div class="read-mail">
                    <h3>Objet : <?= $mail['object'] ?></h3>
                        <p><?= $mail['message'] ?></p>
                </div>
        </section>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>