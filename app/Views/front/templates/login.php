<?php include_once ('app/Views/front/layout/header.php') ?>

    <main id="login" class="container">
        <h1>Se connecter <span class="txt-bzh">Digeriñ un dalc'h</span></h1>
        <form action="index.php?action=connect" method="post">
            <p>
                <input type="email" id="login-mail" name="login-mail" placeholder="Email">
            </p>
            <p>
                <input type="password" id="login-pswd" name="login-pswd" placeholder="Mot de passe">
            </p>
            <p>
                <button type="submit" id="button-login">Se connecter</button>
            </p>
        </form>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>