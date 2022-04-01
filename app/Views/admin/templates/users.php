<?php include_once('app/Views/admin/layout/header.php'); ?>


            <h1>Membres</h1>
            <table id="user-list" class="admin-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse e-mail</th>
                        <th>Avatar</th>
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
                            <td><?= $user['avatar'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td class="action-case">
                                <a href="indexAdmin.php?action=deleteUser&id=<?= $user['id'] ?>">
                                    <span class="action-delete"><i class="fa-solid fa-trash-can"></i></span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </section>
    </main>