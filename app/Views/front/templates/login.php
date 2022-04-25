<?php include_once ('app/Views/front/layout/header.php') ?>

    <main id="login" class="container">
        <h1>Se connecter <span class="txt-bzh">Digeriñ un dalc'h</span></h1>
        <section id="login-page" class="input-page">
            <h2>Identifiants <span class="txt-bzh">Anaouderioù</span></h2>
            <?= $error ?>
            <form action="index.php?action=connect" method="post">
                <p>
                    <input type="email" id="login-mail" name="login-mail" placeholder="Email">
                </p>
                <p>
                    <input type="password" id="login-pswd" name="login-pswd" placeholder="Mot de passe">
                </p>
                <p>
                    <button type="submit" id="button-login" class="submit">Connexion</button>
                </p>
            </form>
        </section>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>