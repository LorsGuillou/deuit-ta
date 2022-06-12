<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Tableau de bord</h1>
            <p class="admin-numbers">Nombre de membres : <?= $nbUsers['0'] ?></p>
            <p class="admin-numbers">Nombre de mails : <?= $nbMails['0'] ?></p>
            <p class="admin-numbers">Nombre d'articles : <?= $nbBlog['0'] ?></p>
            <p class="admin-numbers">Nombre de commentaires : <?= $nbComments['0'] ?></p>
        </div>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>