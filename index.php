<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

try {

    $frontController = new \Projet\Controllers\FrontController();
    $userController = new \Projet\Controllers\UserController();

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'register') {

            $userController->newUser();

        } elseif ($_GET['action'] == 'home') {

            $frontController->home();

        } elseif ($_GET['action'] == 'rencontres') {

            $frontController->rencontres();

        } elseif ($_GET['action'] == 'actu') {

            $frontController->actu();

        } elseif ($_GET['action'] == 'contact') {

            $frontController->contact();
            
        } elseif ($_GET['action'] == 'createUser') {

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $mail = $_POST['mail'];
            $pass = $_POST['password'];
            $mdp = password_hash($pass, PASSWORD_DEFAULT);
            $adminController->createAdmin($firstname, $lastname, $mail, $mdp);

        } elseif ($_GET['action'] == 'about') {

            $frontController->about();

        }
    } else {
        $frontController->home();
    }

} catch (Exception $e) {
    require 'app/Views/front/error.php';
}

