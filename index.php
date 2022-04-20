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

            $userController->postMail($data);

        // Aller sur Connexion
        } elseif ($_GET['action'] == 'login') {

            $frontController->login();

        // Se connecter
        } elseif ($_GET['action'] == 'connect') {

            $mail = htmlspecialchars($_POST['login-mail']);
            $pass = htmlspecialchars($_POST['login-pswd']);

            if (!empty($mail) && !empty($pass)) {

                $userController->connect($mail, $pass);

            } else {

                throw new \Exception ('Renseignez vos identifiants pour vous connecter !');
                $frontController->login();

            }
        
        // Aller sur Créer un compte
        } elseif ($_GET['action'] == 'register') {

            $frontController->newUser();
    
        // Création de compte
        } elseif ($_GET['action'] == 'createUser') {

            $pass = htmlspecialchars($_POST['password']);

            $passHash = password_hash($pass, PASSWORD_DEFAULT);

            if (($_FILES['image']['name'] == "")) {

                $avatar = 'blank.jpg';

            } else {

                $avatar = $frontController->getImg('front', 'avatars', 100000);

            }

            $data = [
                ":lastname" => htmlspecialchars($_POST['lastname']),
                ":firstname" => htmlspecialchars($_POST['firstname']),
                ":mail" => htmlspecialchars($_POST['mail']),
                ":password" => $passHash,
                ":avatar" => $avatar
            ];
            
            if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {

                echo '<script type="text/javascript">alert("Cette adresse e-mail est invalide !")</script>';
                $frontController->newUser();

            } else {

                $userController->createUser($data);

            }

        // Aller sur la page compte
        } elseif ($_GET['action'] == 'account') {

            $frontController->account();

        } elseif ($_GET['action'] == 'editAccount') {

            
            $data = [
                ":id" => $_SESSION['id'],
                ":avatar" => $userController->getImg('front', 'avatars', 100000)
            ];

            $_SESSION['avatar'] = $data[':avatar'];
            $userController->editUser($data);

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