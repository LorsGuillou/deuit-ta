<?php include_once('app/Views/admin/layout/header.php'); ?>


            <h1>Membres</h1>
            <table id="user-list" class="admin-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse e-mail</th>
                        <th>Date d'inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($users as $user) : ?>
                    <tbody>
                        <tr>
                            <td><?= $user['lastname'] ?></td>
                            <td><?= $user['firstname'] ?></td>
                            <td><?= $user['mail'] ?></td>
                            <td><?= $user['date'] ?></td>
                            <td class="action-case">
                                <a href="deleteUser&id=<?= $user['id'] ?>" title="Supprimer ce compte membre">
                                    <span class="action-delete"><i class="fa-solid fa-ban"></i></span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </section>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>