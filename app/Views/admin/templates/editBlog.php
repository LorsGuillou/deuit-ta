<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Modifier l'article</h1>
            <form action="indexAdmin.php?action=modify&id=<?= $blog['id'] ?>" method="post" enctype="multipart/form-data">
                <p>
                    <input type="text" id="edit-title" name="edit-title" value="<?php if (isset($blog['title'])) : echo $blog['title']; endif; ?>" required>
                </p>
                <p>
                    <input type="text" id="edit-excerpt" name="edit-excerpt" value="<?php if (isset($blog['excerpt'])) : echo $blog['excerpt']; endif; ?>" required>
                </p>
                <p>
                    <label for="image">Image : </label>
                    <input type="file" id="edit-name" name="image" required>
                </p>
                <p>
                    <textarea id="edit-content" name="edit-content" required><?php if (isset($blog['content'])) : echo $blog['content']; endif; ?></textarea>
                </p>
                <p>
                    <button type="submit" id="edit-submit">Envoyer</button>
                </p>
            </form>
        </section>
    </main>