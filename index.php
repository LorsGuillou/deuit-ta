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

        // Aller sur Rencontres
        } elseif ($_GET['action'] == 'rencontres') {

            $frontController->rencontres();

        // Aller sur Actualités
        } elseif ($_GET['action'] == 'actu') {

            $frontController->actu();

        // Aller sur Contact
        } elseif ($_GET['action'] == 'contact') {

            $frontController->contact();

        // Aller sur Connexion
        } elseif ($_GET['action'] == 'login') {

            $userController->login();

        // Se connecter
        } elseif ($_GET['action'] == 'connect') {

            $mail = htmlspecialchars($_POST['login-mail']);
            $pass = $_POST['login-pswd'];

            if (!empty($mail) && !empty($pass)) {

                $userController->connect($mail, $pass);

            } else {

                // throw new Exception('Renseignez vos identifiants pour vous connecter !');
                echo "<script type'text/javascript'>alert('Renseignez vos identifiants pour vous connecter !')</script>";
                $userController->login();

            }
        
        // Aller sur Créer un compte
        } elseif ($_GET['action'] == 'register') {

            $userController->newUser();
    
        // Création de compte
        } elseif ($_GET['action'] == 'createUser') {

            $pseudo = $_POST['pseudo'];
            $mail = $_POST['mail'];
            $pass = $_POST['password'];
            $mdp = password_hash($pass, PASSWORD_DEFAULT);

            if (empty($pseudo) || empty($mail) || empty($pass)) {

                // throw new Exception('Tout les champs doivent être remplis !');
                echo "<script type'text/javascript'>alert('Tout les champs doivent être remplis')</script>";
                $userController->newUser();

            } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                // throw new Exception('Cette adresse mail est invalide !');
                echo "<script type'text/javascript'>alert('Cette adresse mail est invalide !')</script>";
                $userController->newUser();

            } elseif ($userController->pseudoCheck($pseudo)) {

                // throw new Exception('Ce pseudonyme existe déjà !');
                echo "<script type'text/javascript'>alert('Ce pseudonyme existe déjà !')</script>";
                $userController->newUser();

            } else {

                $userController->createUser($pseudo, $mail, $mdp);

            }

        // Aller sur A propos
        } elseif ($_GET['action'] == 'about') {

            $frontController->about();

        }
    
    // Arrivée sur le site
    } else {
        $frontController->home();
    }

} catch (Exception $e) {
    require 'app/Views/front/errors/error.php';
}

