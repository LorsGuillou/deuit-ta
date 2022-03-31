<?php include_once('app/Views/admin/layout/header.php'); ?>


            <h1>Membres</h1>
            <table id="user-list" class="">
                <thead>
                    <tr>
                        <th>Pseudonyme</th>
                        <th>Adresse e-mail</th>
                        <th>Avatar</th>
                        <th>Date d'inscription</th>
                    </tr>
                </thead>
                <?php foreach ($users as $user) : ?>
                    <tbody>
                        <tr>
                            <td><?= $user['pseudo'] ?></td>
                            <td><?= $user['mail'] ?></td>
                            <td><?= $user['avatar'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td><a href="indexAdmin?action=ban"><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </section>
    </main>