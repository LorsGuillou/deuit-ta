<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Modifier l'article</h1>
            <form action="indexAdmin.php?action=modify&id=<?= $blog['id'] ?>" method="post">
                <p>
                    <input type="text" id="edit-title" name="edit-title" placeholder="<?= $blog['title'] ?>">
                </p>
                <p>
                    <input type="text" id="edit-excerpt" name="edit-excerpt" placeholder="<?= $blog['excerpt'] ?>">
                </p>
                <!-- <p>
                    <input type="file">
                </p> -->
                <p>
                    <textarea id="edit-content" name="edit-content" placeholder="<?= $blog['content'] ?>"></textarea>
                </p>
                <p>
                    <button type="submit" id="edit-submit">Envoyer</button>
                </p>
            </form>
        </section>
    </main>