<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

try {

    $frontController = new \Projet\Controllers\FrontController();
    $userController = new \Projet\Controllers\UserController();

    if (isset($_GET['action'])) {
        
        if ($_GET['action'] == 'home') {

            $frontController->home();

        } elseif ($_GET['action'] == 'rencontres') {

            $frontController->rencontres();

        } elseif ($_GET['action'] == 'actu') {

            $frontController->actu();

        } elseif ($_GET['action'] == 'contact') {

            $frontController->contact();

        } elseif ($_GET['action'] == 'login') {

            $userController->login();

        } elseif ($_GET['action'] == 'register') {

            $userController->newUser();
    
        } elseif ($_GET['action'] == 'createUser') {

            $pseudo = $_POST['pseudo'];
            $mail = $_POST['mail'];
            $pass = $_POST['password'];
            $mdp = password_hash($pass, PASSWORD_DEFAULT);

            if (empty($pseudo) || empty($mail) || empty($pass)) {

                echo "<script type='text/javascript'>alert('Tout les champs doivent être remplis !')</script>";
                $userController->newUser();

            } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                echo "<script type='text/javascript'>alert('Cette adresse mail est invalide !')</script>";
                $userController->newUser();

            } elseif ($userController->pseudoCheck($pseudo)) {

                echo "<script type='text/javascript'>alert('Ce pseudonyme existe déjà !')</script>";
                $userController->newUser();

            } else {

                $userController->createUser($pseudo, $mail, $mdp);

            }
        } elseif ($_GET['action'] == 'about') {

            $frontController->about();

        }
    } else {
        $frontController->home();
    }

} catch (Exception $e) {
    require 'app/Views/front/error.php';
}

