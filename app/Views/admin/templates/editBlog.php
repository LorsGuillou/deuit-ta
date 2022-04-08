<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Modifier l'article</h1>
            <form action="indexAdmin.php?action=modify&id=<?= $blog['id'] ?>" method="post">
                <p>
                    <input type="text" id="edit-title" name="edit-title" value="<?php if (isset($blog['title'])) : echo $blog['title']; endif; ?>">
                </p>
                <p>
                    <input type="text" id="edit-excerpt" name="edit-excerpt" value="<?php if (isset($blog['excerpt'])) : echo $blog['excerpt']; endif; ?>">
                </p>
                <p>
                    <label for="image">Image : </label>
                    <input type="file" name="image" value="<?php if (isset($blog['img'])) : echo $blog['img']; endif; ?>">
                </p>
                <p>
                    <textarea id="edit-content" name="edit-content"><?php if (isset($blog['content'])) : echo $blog['content']; endif; ?></textarea>
                </p>
                <p>
                    <button type="submit" id="edit-submit">Envoyer</button>
                </p>
            </form>
        </section>
    </main>