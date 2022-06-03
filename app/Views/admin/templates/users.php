<?php include_once('app/Views/admin/layout/header.php'); ?>


            <h1>Membres</h1>
            <?= $alert ?>
            <table id="user-list" class="admin-table">
                <thead>
                    <tr>
                        <th>Pseudonyme</th>
                        <th>Adresse e-mail</th>
                        <th>Date d'inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($users as $user) : ?>
                    <tbody>
                        <tr>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['mail'] ?></td>
                            <td><?= $user['date'] ?></td>
                            <td class="action-case">
                                <a href="mailto:<?= $user['mail'] ?>" title="Envoyer un mail">
                                    <i class="fa-solid fa-paper-plane action-mail"></i>
                                </a>
                                <a href="userDelete&id=<?= $user['id'] ?>" title="Supprimer ce compte membre">
                                    <i class="fa-solid fa-ban action-delete"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </section>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>