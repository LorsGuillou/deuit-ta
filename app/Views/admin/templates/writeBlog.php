<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Ecrire un article</h1>
            <form action="indexAdmin.php?action=publish" method="post" enctype="multipart/form-data">
                <p>
                    <input type="text" id="blog-title" name="blog-title" placeholder="Titre" required>
                </p>
                <p>
                    <input type="text" id="blog-excerpt" name="blog-excerpt" placeholder="Extrait" required>
                </p>
                <p>
                    <label for ="image">Image : </label>
                    <input type="file" name="image" required>
                </p>
                <p>
                    <textarea id="blog-content" name="blog-content" placeholder="Contenu" required></textarea>
                </p>
                <p>
                    <button type="submit" id="blog-submit">Envoyer</button>
                </p>
            </form>
        </section>
    </main>