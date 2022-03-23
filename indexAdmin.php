<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

try {
    $adminController = new \Projet\Controllers\AdminController();

    if (isset($_GET['action'])) {
        // if ($_GET['action'] == 'newAdmin') {
        //     $adminController->newAdmin();
        // } elseif ($_GET['action'] == 'createAdmin') {
        //     $firstname = $_POST['firstname'];
        //     $lastname = $_POST['lastname'];
        //     $mail = $_POST['mail'];
        //     $pass = $_POST['password'];
        //     $mdp = password_hash($pass, PASSWORD_DEFAULT);
        //     $adminController->createAdmin($firstname, $lastname, $mail, $mdp);
        }
    } else {
        $adminController->login();
    }

} catch (Exception $e) {
    require 'app/Views/front/errors/error.php';
}