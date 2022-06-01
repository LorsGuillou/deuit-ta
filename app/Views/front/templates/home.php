<?php include_once ('app/Views/front/layout/header.php') ?>

    <main>
        <div id="banner">
            <h1>Bienvenue ! <span>Degemer mat !</span></h1>
            <p class="container">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos dolor voluptate obcaecati facilis delectus enim harum nisi sapiente et deserunt.</p> 
            <p class="container">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias enim molestiae consequuntur culpa dignissimos error cumque nulla repellat delectus quidem!</p>
        </div>
        <div id="home-page" class="container">
            <h2 class="home-titles">Les prochaines activités</h2>
            <section id="home-activities">
                <?php if (!empty($_SESSION)) : ?>
                    <p>Un texte bouche trou</p>
                <?php else : ?>
                    <p class="txt-visitor">Vous souhaitez voir ou vous inscrire aux activités organisées par nos membres ? <a href="register">Créez un compte</a> ou <a href="login">connectez-vous</a> pour parler breton en bonne compagnie !</p>
                    <p class="txt-visitor txt-bzh">C'hoant ho peus da welout pe da enskrivañ ac'hanoc'h war an oberezhioù aozet gant hon izili ? <a href="register">Krouit ur c'hont</a> pe <a href="login">digerit un dalc'h</a> evit komz brezhoneg gant tud a-feson !</p>
                <?php endif; ?>
            </section>
            <h2 class="home-titles">Les dernières actualités</h2>
            <section id="home-blog">
                <?php foreach ($blogs as $blog) : ?>
                    <article class="home-actu">
                        <h3><?= $blog['titleFR'] ?> <span class="txt-bzh"><?= $blog['titleBZH'] ?></span></h3>
                        <p class="home-actu-date"><?= $blog['date'] ?></p>
                        <div class="home-actu-body">
                            <figure><img src="./Public/admin/img/blog/<?= $blog['img'] ?>" alt="<?= $blog['titleFR'] ?>"></figure>
                            <p><?= $blog['excerptFR'] ?></p>
                            <p class="txt-bzh"><?= $blog['excerptBZH'] ?></p>
                            <a class="link-to-blog" href="blogRead&id=<?= $blog['id'] ?>">Voir l'article</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        </div>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>