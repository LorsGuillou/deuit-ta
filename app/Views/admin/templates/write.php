<?php include_once('app/Views/admin/layout/header.php') ?>


            <h1>Ecrire un article</h1>
            <form action="indexAdmin.php?action=publish" method="post">
                <p>
                    <input type="text" id="blog-title" name="blog-title" placeholder="Titre">
                </p>
                <p>
                    <input type="text" id="blog-excerpt" name="blog-excerpt" placeholder="Extrait">
                </p>
                <!-- <p>
                    <input type="file">
                </p> -->
                <p>
                    <textarea id="blog-content" name="blog-content" placeholder="Contenu"></textarea>
                </p>
                <p>
                    <button type="submit" id="blog-submit">Envoyer</button>
                </p>
            </form>
        </section>
    </main>