<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// function eCatcher($e) {
//     if($_ENV["APP_ENV"] === "dev") {
//         $whoops = new \Whoops\Run;
//         $whoops->allowQuit(false);
//         $whoops->writeToOutput(false);
//         $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//         $html = $whoops->handleException($e);
    
//         require './app/Views/admin/errors/error.php';
//     }
// }

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
                ':idArticle' => htmlspecialchars($_GET['id']),
                ':comment' => htmlspecialchars($_POST['type-comment'])
            ];
            
            $userController->comment($data);
            $alert = '<p class="success">Votre commentaire a bien été publié !</p>';
            $frontController->readBlog($_GET['id'], $alert);

        // Supprimer son commentaire
        } elseif ($_GET['action'] == 'blogDeleteComment') {

            $id = htmlspecialchars($_GET['id']);
            $idPage = htmlspecialchars($_GET['idPage']);
            $userController->deleteComment($id);
            $alert = '<p class="success">Votre commentaire a bien été supprimé !</p>';
            $frontController->readBlog($idPage, $alert);

        // Aller sur Rencontres
        } elseif ($_GET['action'] == 'activities') {

            $frontController->activities();

        // Aller sur Contact
        } elseif ($_GET['action'] == 'contact') {

            $frontController->contact();

        // Formulaire de contact
        } elseif ($_GET['action'] == 'contactPost') {

            $data = [
                ':id' => htmlspecialchars($_SESSION['id']),
                ':object' => htmlspecialchars($_POST['object']),
                ':message' => htmlspecialchars($_POST['message'])
            ];

            if (empty($_POST['object'])) {

                $alert = '<p class="form-error">Veuillez précisez l\'objet de votre message</p>';
                $frontController->contact($alert);

            } elseif (empty($_POST['message'])) {

                $alert = '<p class="form-error">Votre message est vide</p>';
                $frontController->contact($alert);

            } elseif (empty($_POST['object']) && empty($_POST['message'])) {

                $alert = '<p class="form-error">Vous ne pouvez pas envoyer un message vide.</p>';
                $frontController->contact($alert);
            
            } else {

                $alert = '<p class="form-success">Votre message nous a bien été transmis !</p>';
                $frontController->contact($alert);
                $userController->postMail($data);
                // $frontController->setUrl('http://localhost/deuit-ta/contact');
            }

        // Aller sur Connexion
        } elseif ($_GET['action'] == 'login') {

            $frontController->login();

        // Se connecter
        } elseif ($_GET['action'] == 'connect') {

            $mail = htmlspecialchars($_POST['login-mail']);
            $password = htmlspecialchars($_POST['login-pswd']);

            if (empty($mail) || empty($password)) {

                $alert = '<p class="form-error">Tout les champs doivent être remplis !</p>';
                $frontController->login($alert);

            } else {

                $userController->connect($mail, $password);

            }
        
        // Aller sur Créer un compte
        } elseif ($_GET['action'] == 'register') {

            $frontController->newUser();
    
        // Création de compte
        } elseif ($_GET['action'] == 'loginCreateUser') {

            $pass = htmlspecialchars($_POST['password']);
            $passCheck = htmlspecialchars($_POST['confirmPswd']);
            $passHash = password_hash($pass, PASSWORD_DEFAULT);

            if (($_FILES['image']['name'] == "")) {

                $avatar = 'blank.jpg';

            } else {

                $avatar = htmlspecialchars($frontController->getImg('front', 'avatars', 100000));

            }

            $data = [
                ':lastname' => htmlspecialchars($_POST['lastname']),
                ':firstname' => htmlspecialchars($_POST['firstname']),
                ':mail' => htmlspecialchars($_POST['mail']),
                ':password' => $passHash,
                ':avatar' => $avatar
            ];
            
            if (empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['mail']) || empty($_POST['password']) || empty($_POST['confirmPswd'])) {

                $alert = '<p class="form-error">Tout les champs doivent être remplis !</p>';
                $frontController->newUser($alert);

            } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {

                $alert = '<p class="form-error">Cette adresse mail est invalide !</p>';
                $frontController->newUser($alert);

            } elseif ($passCheck != $pass) {
            
                $alert = '<p class="form-error">Les mots de passes ne correspondent pas !</p>';
                $frontController->newUser($alert);

            } elseif (!isset($_POST['rgpd'])) {

                $alert = '<p class="form-error">Vous devez cocher la case pour continuer !</p>';
                $frontController->newUser($alert);

            } else {

                $userController->createUser($data);

            }

        // Aller sur la page compte
        } elseif ($_GET['action'] == 'account') {


                $frontController->account();

        // Modifier l'avatar
        } elseif ($_GET['action'] == 'accountEditAvatar') {
            
            $data = [
                ':id' => $_SESSION['id'],
                ':avatar' => $userController->getImg('front', 'avatars', 100000)
            ];

            $_SESSION['avatar'] = $data[':avatar'];
            $userController->editAvatar($data);
            $alert = '<p class="success">L\'avatar a été modifié avec succès !</p>';
            $frontController->account($alert);

        // Modifier l'adresse mail
        } elseif ($_GET['action'] == 'accountEditMail') {
            
            $data = [
                ':id' => $_SESSION['id'],
                ':mail' => htmlspecialchars($_POST['edit-mail'])
            ];

            if (!filter_var($_POST['edit-mail'], FILTER_VALIDATE_EMAIL)) {

                $alert = '<p class="error">Cette adresse mail est invalide !</p>';
                $frontController->account($alert);

            } else {

                $_SESSION['mail'] = $data[':mail'];
                $userController->editMail($data);
                $alert = '<p class="success">L\'adresse mail a été modifié avec succès !</p>';
                $frontController->account($alert);

            }

        // Modifier le mot de passe
        } elseif ($_GET['action'] == 'accountEditPswd') {
            
            $passEdit = htmlspecialchars($_POST['edit-password']);
            $editCheck = htmlspecialchars($_POST['edit-confirmPswd']);
            $editHash = password_hash($passEdit, PASSWORD_DEFAULT);

            $data = [
                ':id' => $_SESSION['id'],
                ':password' => $editHash
            ];

            if ($passEdit != $editCheck) {

                $alert = '<p class="error">Les mots de passes ne correspondent pas !</p>';
                $frontController->account($alert);

            } else {

                $_SESSION['password'] = $data[':password'];
                $userController->editPswd($data);
                $alert = '<p class="success">Le mot de passe a été modifié avec succès !</p>';
                $frontController->account($alert);
            
            }
        
        // Supprimer les commentaires depuis la page Compte
        } elseif ($_GET['action'] == 'accountDeleteComment') {

            $id = htmlspecialchars($_GET['id']);
            $userController->deleteComment($id);
            $alert = '<p class="success">Votre commentaire a bien été supprimé !</p>';
            $frontController->account($alert);

        // Se déconnecter
        } elseif ($_GET['action'] == 'logout') {

            session_destroy();
            header('Location: index.php');

        // JS désactivé
        } elseif ($_GET['action'] == 'noJSNav') {

            $frontController->noJSNAV();

        } else {

            throw new Exception('Cette action n\'existe pas', 500);

        }
    
    // Arrivée sur le site
    } else {

        $frontController->home();

    }

} catch (Exception $e) {

    if ($e->getCode() === 401) {
        require 'app/Views/front/errors/401.php';
    } elseif ($e->getCode() === 404) {
        require 'app/Views/front/errors/404.php';
    } else {
        // eCatcher($e);
        require 'app/Views/front/errors/error.php';
    }
    
} catch (Error $e) {

    // eCatcher($e);
    require 'app/Views/front/errors/error.php';

}