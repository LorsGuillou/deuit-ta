<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function eCatcher($e) {
    if($_ENV["APP_ENV"] === "dev") {
        $whoops = new \Whoops\Run;
        $whoops->allowQuit(false);
        $whoops->writeToOutput(false);
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $html = $whoops->handleException($e);
    
        require './app/Views/admin/errors/error.php';
    }
}

try {

    $frontController = new \Projet\Controllers\FrontController();
    $userController = new \Projet\Controllers\UserController();

    if (isset($_GET['action'])) {
    
        // Aller à l'accueil
        if ($_GET['action'] == 'home') {

            $frontController->home();

        // Aller sur A propos
        } elseif ($_GET['action'] == 'about') {

            $frontController->about();

        // Aller sur Actualités
        } elseif ($_GET['action'] == 'actu') {

            $frontController->actu();

        // Lire un article en entier
        } elseif ($_GET['action'] == 'readActu') {

            $id = htmlspecialchars($_GET['id']);
            $frontController->readActu($id);

        // Commenter un article
        } elseif ($_GET['action'] == 'comment') {

            $data = [
                ":idUser" => htmlspecialchars($_SESSION['id']),
                ":idArticle" => htmlspecialchars($_GET['id']),
                ":comment" => htmlspecialchars($_POST['type-comment'])
            ];

            $userController->comment($data);
            $frontController->readActu($_GET['id']);

        // Supprimer son commentaire
        } elseif ($_GET['action'] == 'deleteComment') {

            $id = htmlspecialchars($_GET['id']);
            $idPage = htmlspecialchars($_GET['idPage']);
            $userController->deleteComment($id);
            $frontController->readActu($idPage);

        // Aller sur Rencontres
        } elseif ($_GET['action'] == 'activities') {

            $frontController->activities();

        // Aller sur Contact
        } elseif ($_GET['action'] == 'contact') {

            $frontController->contact();

        // Formulaire de contact
        } elseif ($_GET['action'] == 'contactPost') {

            $data = [
                ":id" => htmlspecialchars($_SESSION['id']),
                ":object" => htmlspecialchars($_POST['object']),
                ":message" => htmlspecialchars($_POST['message'])
            ];

            if (empty(($_POST['object'])) || empty($_POST['message'])) {

                $error = '<p class="form-error">Tout les champs doivent être remplis !</p>';
                $frontController->contact($error);
            
            } else {

                $userController->postMail($data);

            }

        // Aller sur Connexion
        } elseif ($_GET['action'] == 'login') {

            $frontController->login();

        // Se connecter
        } elseif ($_GET['action'] == 'connect') {

            $mail = htmlspecialchars($_POST['login-mail']);
            $password = htmlspecialchars($_POST['login-pswd']);

            if (empty($mail) || empty($password)) {

                $error = '<p class="form-error">Tout les champs doivent être remplis !</p>';
                $frontController->login($error);

            } else {

                $userController->connect($mail, $password);

            }
        
        // Aller sur Créer un compte
        } elseif ($_GET['action'] == 'register') {

            $frontController->newUser();
    
        // Création de compte
        } elseif ($_GET['action'] == 'createUser') {

            $pass = htmlspecialchars($_POST['password']);
            $passCheck = htmlspecialchars($_POST['confirmPswd']);
            $passHash = password_hash($pass, PASSWORD_DEFAULT);

            if (($_FILES['image']['name'] == "")) {

                $avatar = 'blank.jpg';

            } else {

                $avatar = htmlspecialchars($frontController->getImg('front', 'avatars', 100000));

            }

            $data = [
                ":lastname" => htmlspecialchars($_POST['lastname']),
                ":firstname" => htmlspecialchars($_POST['firstname']),
                ":mail" => htmlspecialchars($_POST['mail']),
                ":password" => $passHash,
                ":avatar" => $avatar
            ];
            
            if (empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['mail']) || empty($_POST['password']) || empty($_POST['confirmPswd'])) {

                $error = '<p class="form-error">Tout les champs doivent être remplis !</p>';
                $frontController->newUser($error);

            } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {

                $error = '<p class="form-error">Cette adresse mail est invalide !</p>';
                $frontController->newUser($error);

            } elseif ($passCheck != $pass) {
            
                $error = '<p class="form-error">Les mots de passes ne correspondent pas !</p>';
                $frontController->newUser($error);

            } elseif (!isset($_POST['rgpd'])) {

                $error = '<p class="form-error">Vous devez cocher la case pour continuer !</p>';
                $frontController->newUser($error);

            } else {

                $userController->createUser($data);

            }

        // Aller sur la page compte
        } elseif ($_GET['action'] == 'account') {

            $id = $_SESSION['id'];
            $frontController->account($id);

        // Modifier le compte
        } elseif ($_GET['action'] == 'editAccount') {
            
            $data = [
                ":id" => $_SESSION['id'],
                ":avatar" => $userController->getImg('front', 'avatars', 100000)
            ];

            $_SESSION['avatar'] = $data[':avatar'];
            $userController->editUser($data);
        
        // Supprimer les commentaires depuis la page Compte
        } elseif ($_GET['action'] == 'deleteCommFromAcc') {

            $id = htmlspecialchars($_GET['id']);
            $userController->deleteComment($id);
            $frontController->account($_SESSION['id']);

        // Se déconnecter
        } elseif ($_GET['action'] == 'logout') {

            session_destroy();
            header('Location: index.php');

        } else {

            throw new Exception("Cette action n'existe pas", 404);

        }
    
    // Arrivée sur le site
    } else {

        $frontController->home();

    }

} catch (Exception $e) {

    eCatcher($e);
    if ($e->getCode() === 404) {
        require "app/Views/front/errors/404.php";
    } else {
        require "app/Views/front/errors/error.php";
    }
    
} catch (Error $e) {

    eCatcher($e);
    require "app/Views/front/errors/error.php";

}