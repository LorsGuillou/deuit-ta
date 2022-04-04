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
                                    <span class="action-view"><i class="fa-solid fa-eye"></i></span>
                                </a>
                                <a href="indexAdmin.php?action=editBlog&id=<?= $blog['id'] ?>" title="Modifier cet article">
                                    <span class="action-edit"><i class="fa-solid fa-pencil"></i></i></span>
                                </a>
                                <a href="indexAdmin.php?action=deleteBlog&id=<?= $blog['id'] ?>" title="Supprimer cet article">
                                    <span class="action-delete"><i class="fa-solid fa-trash-can"></i></span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </section>
    </main>