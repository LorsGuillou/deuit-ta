<?php include_once ('app/Views/front/layout/header.php') ?>

    <main>
        <div id="banner">
            <h1>Bienvenue ! <span>Degemer mat !</span></h1>
            <p class="container">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos dolor voluptate obcaecati facilis delectus enim harum nisi sapiente et deserunt. <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias enim molestiae consequuntur culpa dignissimos error cumque nulla repellat delectus quidem!</span></p>
        </div>
        <div id="home-page" class="container">
            <h2 class="home-titles">Les prochaines activités</h2>
            <section id="home-activities">
                <?php if (!empty($_SESSION)) : ?>
                    <p>Un texte bouche trou</p>
                <?php else : ?>
                    <p class="txt-visitor">Vous souhaitez voir ou vous inscrire aux activités organisées par nos membres ? <a href="register">Créez un compte</a> ou <a href="login">connectez-vous</a> pour parler breton en bonne compagnie !</p>
                    <p class="txt-visitor txt-bzh">Vous souhaitez voir ou vous inscrire aux activités organisées par nos membres ? <a href="register">Créez un compte</a> ou <a href="login">connectez-vous</a> pour parler breton en bonne compagnie !</p>
                <?php endif; ?>
            </section>
            <h2 class="home-titles">Les dernières actualités</h2>
            <section id="home-blog">
                <?php foreach ($blogs as $blog) : ?>
                    <article class="home-actu">
                        <h3><?= $blog['title'] ?> <?= $blog['created_at'] ?></h3>
                        <div class="home-actu-body">
                            <figure><img src="./Public/admin/img/blog/<?= $blog['img'] ?>"></figure>
                            <p><?= $blog['excerpt'] ?></p>
                            <a href="readActu&id=<?= $blog['id'] ?>">Voir l'article</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        </div>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>