<?php include_once ('app/Views/front/layout/header.php') ?>


    <main id="register" class="container">
        <h1>Créez votre compte <span class="txt-bzh">Krouat ho kont</span></h1>
        <form action="index.php?action=createUser" method="post">
            <p>
                <input type="text" id="pseudo" name="pseudo" placeholder="Pseudonyme">
            </p>
            <p>
                <input type="mail" id="mail" name="mail" placeholder="Email">
            </p>
            <p>
                <input type="password" id="password" name="password" placeholder="Mot de passe">
            </p>
            <p>
                <button type="submit" id="button-register">Envoyer</button>
            </p>
        </form>
    </main>


<?php include_once ('app/Views/front/layout/footer.php') ?>