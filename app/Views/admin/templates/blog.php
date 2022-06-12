<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Articles</h1>
            <?= $alert ?>
            <a href="blogWrite" id="new-article" title="Ecrire un article"><i class="fa-solid fa-plus"></i> Ecrire un article</a>
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
                            <td><?= $blog['titleFR'] ?></td>
                            <td><?= $blog['excerptFR'] ?></td>
                            <td><?= $blog['date'] ?></td>
                            <td class="action-case">
                                <a href="blogRead&id=<?= $blog['id'] ?>" title="Voir l'article">
                                    <i class="fa-solid fa-eye action-view"></i>
                                </a>
                                <a href="blogEdit&id=<?= $blog['id'] ?>" title="Modifier cet article">
                                    <i class="fa-solid fa-pencil action-edit"></i>
                                </a>
                                <a href="blogDelete&id=<?= $blog['id'] ?>" title="Supprimer cet article">
                                    <i class="fa-solid fa-trash-can action-delete"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </div>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>