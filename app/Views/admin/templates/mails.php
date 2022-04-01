<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Mails</h1>
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
                            <td><?= $mail['lastname'] ?></td>
                            <td><?= $mail['firstname'] ?></td>
                            <td><?= $mail['object'] ?></td>
                            <td><?= $mail['created_at'] ?></td>
                            <td class="action-case">
                                <a href="indexAdmin.php?action=viewMail">
                                    <span class="action-view"><i class="fa-solid fa-eye"></i></span>
                                </a>
                                <a href="indexAdmin.php?action=deleteMail&id=<?= $mail['id'] ?>">
                                    <span class="action-delete"><i class="fa-solid fa-trash-can"></i></span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </section>
    </main>