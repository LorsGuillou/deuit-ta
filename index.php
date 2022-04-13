<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

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

        // Aller sur Rencontres
        } elseif ($_GET['action'] == 'activities') {

            $frontController->activities();

        // Aller sur Actualités
        } elseif ($_GET['action'] == 'actu') {

            $frontController->actu();

        // Aller sur Contact
        } elseif ($_GET['action'] == 'contact') {

            $frontController->contact();

        // Formulaire de contact
        } elseif ($_GET['action'] == 'contactPost') {

            $data = [
                ":id" => $id = $_SESSION['id'],
                ":object" => htmlspecialchars($_POST['object']),
                ":message" => htmlspecialchars($_POST['message'])
            ];

            if (empty($_POST['object']) && empty($_POST['message'])) {

                throw new \Exception ('Vous ne pouvez pas envoyer un formulaire vide !');
                $frontController->contact();
            
            } elseif (empty($_POST['object'])) {

                throw new \Exception ('Vous devez renseigner l\'objet de votre message !');
                $frontController->contact();
            
            } elseif(empty($_POST['message'])) {

                throw new \Exception ("Votre message est vide !");
                $frontController->contact();

            } else {

                $userController->postMail($data);

            }

        // Aller sur Connexion
        } elseif ($_GET['action'] == 'login') {

            $frontController->login();

        // Se connecter
        } elseif ($_GET['action'] == 'connect') {

            $mail = htmlspecialchars($_POST['login-mail']);
            $pass = $_POST['login-pswd'];

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

            $data = [
                ":lastname" => htmlspecialchars($_POST['lastname']),
                ":firstname" => htmlspecialchars($_POST['firstname']),
                ":mail" => htmlspecialchars($_POST['mail']),
                ":password" => $passHash,
                ":avatar" => 'no-avatar.png'
            ];
            
            if (empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['mail']) || empty($_POST['password'])) {

                echo '<script type="text/javascript">alert("Tout les champs doivent être remplis !")</script>';
                $frontController->newUser();

            } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {

                echo '<script type="text/javascript">alert("Cette adresse e-mail est invalide !")</script>';
                $frontController->newUser();

            } else {

                $userController->createUser($data);

            }

        // Aller sur la page compte
        } elseif ($_GET['action'] == 'account') {

            $frontController->account();

        // Se déconnecter
        } elseif ($_GET['action'] == 'logout') {

            session_destroy();
            header('Location: index.php');

        }

    
    // Arrivée sur le site
    } else {

        $frontController->home();

    }

} catch (Exception $e) {

    $e->getMessage();
    
}

