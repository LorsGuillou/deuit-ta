<?php include_once ('app/Views/front/layout/header.php') ?>

    <main id="login" class="container">
        <h1>Se connecter <span class="txt-bzh">Digeriñ un dalc'h</span></h1>
        <section id="login-page" class="input-page">
            <h2>Identifiants <span class="txt-bzh">Anaouderioù</span></h2>
            <?= $alert ?>
            <form action="connect" method="post">
                <p>
                    <input type="email" id="login-mail" name="login-mail" placeholder="Email">
                </p>
                <p class="pswdSpace">
                    <input type="password" id="password" name="login-pswd" placeholder="Mot de passe">
                    <i class="fa-solid fa-eye" id="togglePswd"></i>
                </p>
                <p>
                    <button type="submit" id="button-login" class="submit">Connexion</button>
                </p>
            </form>
        </section>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>