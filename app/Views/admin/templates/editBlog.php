<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Modifier l'article</h1>
            <form action="blogModify&id=<?= $blog['id'] ?>" method="post" enctype="multipart/form-data">
                <p>
                    <label for="edit-titleFR">Titre français :</label>
                </p>
                <p>
                    <input type="text" id="edit-titleFR" name="edit-titleFR" value="<?php if (isset($blog['titleFR'])) : echo $blog['titleFR']; endif; ?>" required>
                </p>
                <p>
                    <label for="edit-titleBZH">Titre breton :</label>
                </p>
                <p>
                    <input type="text" id="edit-titleBZH" name="edit-titleBZH" value="<?php if (isset($blog['titleBZH'])) : echo $blog['titleBZH']; endif; ?>" required>
                </p>
                <p>
                    <label for="edit-excerptFR">Extrait français :</label>
                </p>
                <p>
                    <input type="text" id="edit-excerptFR" name="edit-excerptFR" value="<?php if (isset($blog['excerptFR'])) : echo $blog['excerptFR']; endif; ?>" required>
                </p>
                <p>
                    <label for="edit-excerptBZH">Extrait breton :</label>
                </p>
                <p>
                    <input type="text" id="edit-excerptBZH" name="edit-excerptBZH" value="<?php if (isset($blog['excerptBZH'])) : echo $blog['excerptBZH']; endif; ?>" required>
                </p>
                <p>
                    <label for="image">Image : </label>
                </p>
                <p>
                    <input type="file" id="edit-image" name="image" required>
                </p>
                <p>
                    <label for="edit-contentFR">Texte français :</label>
                </p>
                <p>
                    <textarea id="edit-contentFR" name="edit-contentFR" required><?php if (isset($blog['contentFR'])) : echo $blog['contentFR']; endif; ?></textarea>
                </p>
                <p>
                    <label for="edit-contentBZH">Texte breton :</label>
                </p>
                <p>
                    <textarea id="edit-contentBZH" name="edit-contentBZH" required><?php if (isset($blog['contentBZH'])) : echo $blog['contentBZH']; endif; ?></textarea>
                </p>
                <p>
                    <button type="submit" id="edit-submit">Envoyer</button>
                </p>
            </form>
        </section>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>