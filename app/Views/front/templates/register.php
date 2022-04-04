<?php include_once ('app/Views/front/layout/header.php') ?>


    <main id="register" class="container">
        <h1>Créez votre compte <span class="txt-bzh">Krouat ho kont</span></h1>
        <section id="register-page" class="input-page">
            <h2>Identifiants <span class="txt-bzh">Anaouderioù</span></h2>
            <form action="index.php?action=createUser" method="post">
                <p>
                    <input type="text" id="lastname" name="lastname" placeholder="Nom">
                </p>
                <p>
                    <input type="text" id="firstname" name="firstname" placeholder="Prénom">
                </p>
                <p>
                    <input type="mail" id="mail" name="mail" placeholder="Email">
                </p>
                <p>
                    <input type="password" id="password" name="password" placeholder="Mot de passe">
                </p>
                <p>
                    <button type="submit" id="submit-register" class="submit">Envoyer</button>
                    <button type="reset" id="reset-register" class="reset">Effacer</button>
                </p>
            </form>
        </section>
    </main>


<?php include_once ('app/Views/front/layout/footer.php') ?>