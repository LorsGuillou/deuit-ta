<?php include_once('app/Views/admin/layout/header.php'); ?>
<?php $list = new \Projet\Models\User(); 
    $users = $list->userList(); ?>

            <h1>Membres</h1>
            <table>
                <thead>
                    <tr>
                        <th>Pseudonyme</th>
                        <th>Adresse e-mail</th>
                        <th>Avatar</th>
                        <th>Date d'inscription</th>
                    </tr>
                </thead>
                <?php foreach ($users as $user) : ?>
                    <h3><?= $user['pseudo'] ?></h3>
                    <p><?= $user['mail'] ?></p>
                <?php endforeach ?>
            </table>
        </section>
    </main>