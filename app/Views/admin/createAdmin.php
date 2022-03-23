<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Projet final - admin</title>
</head>

<body>
    <main>
        <h1>Créer un profil administrateur</h1>
            <form action="indexAdmin.php?action=createAdmin" method="post">
                <p>
                    <input type="text" id="firstname" name="firstname" placeholder="Prénom">
                </p>
                <p>
                    <input type="text" id="lastname" name="lastname" placeholder="Nom">
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
