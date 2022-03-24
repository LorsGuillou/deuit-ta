<?php include_once ('app/Views/front/layout/header.php') ?>

<body>
    <main>
        <h1>Créez votre compte ! Krouat ho c'hont !</h1>
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
                <p id="bouton">
                    <button type="submit" id="admin-submit">ENVOYER</button>
                </p>
            </form>
    </main>
</body>

<?php include_once ('app/Views/front/layout/footer.php') ?>