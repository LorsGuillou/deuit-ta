<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {

    $frontController = new \Projet\Controllers\FrontController();
    $userController = new \Projet\Controllers\UserController();
    $noAuthorisation = new Exception ('Vous n\'avez pas l\'autorisation pour cette requête.', 401);

    if (isset($_GET['action'])) {
    
        // Aller à l'accueil
        if ($_GET['action'] == 'home') {

            $frontController->home();

        // Aller sur A propos
        } elseif ($_GET['action'] == 'about') {

            $frontController->about();

        // Aller sur Actualités
        } elseif ($_GET['action'] == 'blog') {

            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $currentPage = (int) strip_tags($_GET['page']);
            } else {
                $currentPage = 1;
            }
            $frontController->blog($currentPage);

        // Lire un article en entier
        } elseif ($_GET['action'] == 'blogRead') {

            $id = htmlspecialchars($_GET['id']);
            $frontController->readBlog($id);

        // Commenter un article
        } elseif ($_GET['action'] == 'blogComment') {

            $data = [
                ':idUser' => htmlspecialchars($_SESSION['id']),
                ':idBlog' => htmlspecialchars($_GET['id']),
                ':comment' => htmlspecialchars($_POST['type-comment'])
            ];          
            $userController->comment($data);

        // Supprimer son commentaire
        } elseif ($_GET['action'] == 'blogDeleteComment') {

            $id = htmlspecialchars($_GET['id']);
            $userController->deleteComment($id);

        // Aller sur Contact
        } elseif ($_GET['action'] == 'contact') {

            if (empty($_SESSION)) {
                throw $noAuthorisation;
            } else {
                $frontController->contact();
            }

        // Formulaire de contact
        } elseif ($_GET['action'] == 'contactPost') {

            if (empty($_SESSION)) {
                throw $noAuthorisation;
            } else {
                $data = [
                    ':id' => htmlspecialchars($_SESSION['id']),
                    ':object' => htmlspecialchars($_POST['object']),
                    ':message' => htmlspecialchars($_POST['message'])
                ];
                $userController->messageAdmin($data);
            }  

        // Aller sur Connexion
        } elseif ($_GET['action'] == 'login') {

            $frontController->login();

        // Se connecter
        } elseif ($_GET['action'] == 'connect') {

            $mail = htmlspecialchars($_POST['login-mail']);
            $password = htmlspecialchars($_POST['login-pswd']);

            $userController->connect($mail, $password);
        
        // Aller sur Créer un compte
        } elseif ($_GET['action'] == 'register') {

            $frontController->newUser();
    
        // Création de compte
        } elseif ($_GET['action'] == 'loginCreateUser') {

            $pass = htmlspecialchars($_POST['password']);
            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $imgSize = $_FILES['image']['size'];

            if (($_FILES['image']['name'] == "")) {
                $avatar = 'blank.jpg';
            } else {
                $avatar = htmlspecialchars($frontController->getImg('front', 'avatars', $imgSize));
            }

            $data = [
                ':username' => htmlspecialchars($_POST['username']),
                ':mail' => htmlspecialchars($_POST['mail']),
                ':password' => $passHash,
                ':avatar' => $avatar
            ];
            $userController->createUser($data);

        // Aller sur la page compte
        } elseif ($_GET['action'] == 'account') {

            if (empty($_SESSION)) {
                throw $noAuthorisation;
            } else {
                $frontController->account();
            }

        // Modifier le pseudonyme
        } elseif ($_GET['action'] == 'accountEditUsername') {

            if (empty($_SESSION)) {
                throw $noAuthorisation;
            } else {
                $newUsername = htmlspecialchars($_POST['edit-username']);
                $data = [
                    ':id' => $_SESSION['id'],
                    ':username' => $newUsername
                ];
                $userController->editUsername($data);
            }

        // Modifier l'avatar
        } elseif ($_GET['action'] == 'accountEditAvatar') {

            if (empty($_SESSION)) {
                throw $noAuthorisation;
            } else {
                $imgSize = $_FILES['image']['size'];

                if (($_FILES['image']['name'] == "")) {
                    $avatar = 'blank.jpg';
                } else {
                    $avatar = htmlspecialchars($frontController->getImg('front', 'avatars', $imgSize));
                }
                $data = [
                    ':id' => $_SESSION['id'],
                    ':avatar' => $avatar
                ];
                $userController->editAvatar($data);
            }

        // Modifier l'adresse mail
        } elseif ($_GET['action'] == 'accountEditMail') {

            if (empty($_SESSION)) {
                throw $noAuthorisation;
            } else {
                $data = [
                    ':id' => $_SESSION['id'],
                    ':mail' => htmlspecialchars($_POST['edit-mail'])
                ];
                $userController->editMail($data);
            }

        // Modifier le mot de passe
        } elseif ($_GET['action'] == 'accountEditPswd') {

            if (empty($_SESSION)) {
                throw $noAuthorisation;
            } else {
                $newPass = htmlspecialchars($_POST['edit-password']);
                $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);

                $data = [
                    ':id' => $_SESSION['id'],
                    ':password' => $newPassHash
                ];
                $userController->editPswd($data);
            }
        
        // Supprimer les commentaires depuis la page Compte
        } elseif ($_GET['action'] == 'accountDeleteComment') {

            if (empty($_SESSION)) {
                throw $noAuthorisation;
            } else {
                $id = htmlspecialchars($_GET['id']);
                $userController->deleteComment($id);
            }

        // Se déconnecter
        } elseif ($_GET['action'] == 'logout') {

            session_unset();
            session_destroy();
            header('Location: index.php');

        // JS désactivé
        } elseif ($_GET['action'] == 'noJSNav') {

            $frontController->noJSNAV();

        } else {

            throw new Exception('Cette action n\'existe pas');

        }
    
    // Arrivée sur le site
    } else {

        $frontController->home();

    }

} catch (Exception $e) {

    require 'app/Views/front/errors/error.php';
    
} catch (Error $e) {

    require 'app/Views/front/errors/error.php';

}