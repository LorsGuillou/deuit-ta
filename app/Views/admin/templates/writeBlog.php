<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Ecrire un article</h1>
            <form action="blogPublish" method="post" enctype="multipart/form-data">
                <p>
                    <label for="blog-titleFR">Titre français :</label>
                </p>
                <p>
                    <input type="text" id="blog-titleFR" name="blog-titleFR" placeholder="Titre" required>
                </p>
                <p>
                    <label for="blog-titleBZH">Titre breton :</label>
                </p>
                <p>
                    <input type="text" id="blog-titleBZH" name="blog-titleBZH" placeholder="Titre" required>
                </p>
                <p>
                    <label for="blog-excerptFR">Extrait français :</label>
                </p>
                <p>
                    <input type="text" id="blog-excerptFR" name="blog-excerptFR" placeholder="Extrait" required>
                </p>
                <p>
                    <label for="blog-excerptBZH">Extrait breton :</label>
                </p>
                <p>
                    <input type="text" id="blog-excerptBZH" name="blog-excerptBZH" placeholder="Extrait" required>
                </p>
                <p>
                    <label for="image">Image : </label>
                    <input type="file" id="blog-name" name="image" required>
                </p>
                <p>
                    <label for="blog-contentFR">Texte français :</label>
                </p>
                <p>
                    <textarea id="blog-contentFR" name="blog-contentFR" placeholder="Contenu" required></textarea>
                </p>
                <p>
                    <label for="blog-contentBZH">Texte breton :</label>
                </p>
                <p>
                    <textarea id="blog-contentBZH" name="blog-contentBZH" placeholder="Contenu" required></textarea>
                </p>
                <p>
                    <button type="submit" id="blog-submit">Envoyer</button>
                </p>
            </form>
        </section>
    </main>

<?php include_once('app/Views/admin/layout/footer.php') ?>