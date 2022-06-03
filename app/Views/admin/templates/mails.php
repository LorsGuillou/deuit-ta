<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Mails</h1>
            <?= $alert ?>
            <table id="user-list" class="admin-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Objet</th>
                        <th>Date d'envoi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($mails as $mail) : ?>
                    <tbody>
                        <tr>
                            <td><?= $mail['username'] ?></td>
                            <td><?= $mail['object'] ?></td>
                            <td><?= $mail['date'] ?></td>
                            <td class="action-case">
                                <a href="mailRead&id=<?= $mail['id'] ?>" title="Lire le mail">
                                    <i class="fa-solid fa-eye action-view"></i>
                                </a>
                                <a href="mailDelete&id=<?= $mail['id'] ?>" title="Supprimer le mail">
                                    <i class="fa-solid fa-trash-can action-delete"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </section>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>