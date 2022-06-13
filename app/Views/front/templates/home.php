<?php include_once ('app/Views/front/layout/header.php') ?>

    <main>
        <div id="banner">
            <h1>Bienvenue ! <span>Degemer mat !</span></h1>
            <p class="container">Ici, on parle à la fois français et breton ! Deuit 'ta ce veut être un endroit ou on peut découvrir la langue bretonne, ou s'entraîner et la pratiquer à plusieurs ! Que vous soyez débutant ou déjà à l'aise, vous trouverez votre bonheur ! </p> 
            <p class="container">Amañ e vez komzet galleg ha brezhoneg a-gevret ! Gallout a rit dizoleiñ ar yezh brezhoneg, pe pleustriñ ha komz asambles amañ e Deuit 'ta ! Deraouad pe barrek, kavout a reoc'h ho levenez !</p>
        </div>
        <div id="home-page" class="container">
            <section id="home-activities">
                <h2 class="home-titles">Activités à venir <span class="txt-bzh">Oberezhioù da-zont</span></h2>
                <?php if (!empty($_SESSION)) : ?>
                    <p class="txt-visitor">Fonctionnalité à venir !</p>
                    <p class="txt-visitor txt-bzh">Arc'hweladur da-zont !</p>
                <?php else : ?>
                    <p class="txt-visitor">Vous souhaitez voir ou vous inscrire aux activités organisées par nos membres ? <a href="register" title="Crééz un compte">Créez un compte</a> ou <a href="login" title="Connectez-vous">connectez-vous</a> pour parler breton en bonne compagnie !</p>
                    <p class="txt-visitor txt-bzh">C'hoant ho peus da welout pe da enskrivañ ac'hanoc'h war an oberezhioù aozet gant hon izili ? <a href="register" title="Krouit ur c'hont">Krouit ur c'hont</a> pe <a href="login" title="Digerit une dalc'h">digerit un dalc'h</a> evit komz brezhoneg gant tud a-feson !</p>
                <?php endif; ?>
            </section>
            <section id="home-blog">
                <h2 class="home-titles">Derniers articles du blog <span class="txt-bzh">Pennadoù diwezhañ blog</span></h2>
                <?php foreach ($blogs as $blog) : ?>
                    <article class="home-actu">
                        <h3 class="blog-title"><?= $blog['titleFR'] ?> <span class="txt-bzh"><?= $blog['titleBZH'] ?></span></h3>
                        <p class="home-actu-date"><?= $blog['date'] ?></p>
                        <div class="home-actu-body">
                            <figure><img src="./Public/admin/img/blog/<?= $blog['img'] ?>" alt="<?= $blog['titleFR'] ?>"></figure>
                            <p><?= $blog['excerptFR'] ?></p>
                            <p class="txt-bzh"><?= $blog['excerptBZH'] ?></p>
                            <a class="link-to-blog" href="blogRead&id=<?= $blog['id'] ?>" title="Lire l'article <?= $blog['titleFR'] ?>">Voir l'article</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        </div>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>