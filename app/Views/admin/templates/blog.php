<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Articles</h1>
            <a href="indexAdmin.php?action=write">Ecrire un article</a>
            <table id="blog-list" class="admin-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Extrait</th>
                        <th>Date de publication</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($blogs as $blog) : ?>
                    <tbody>
                        <tr>
                            <td><?= $blog['title'] ?></td>
                            <td><?= $blog['excerpt'] ?></td>
                            <td><?= $blog['created_at'] ?></td>
                            <td class="action-case">
                                <a href="indexAdmin.php?action=readBlog&id=<?= $blog['id'] ?>" title="Voir l'article">
                                    <i class="fa-solid fa-eye action-view"></i>
                                </a>
                                <a href="indexAdmin.php?action=editBlog&id=<?= $blog['id'] ?>" title="Modifier cet article">
                                    <i class="fa-solid fa-pencil action-edit"></i>
                                </a>
                                <a href="indexAdmin.php?action=deleteBlog&id=<?= $blog['id'] ?>" title="Supprimer cet article">
                                    <i class="fa-solid fa-trash-can action-delete"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </section>
    </main>