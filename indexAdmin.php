<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

try {

    $adminController = new \Projet\Controllers\AdminController();
    $userController = new \Projet\Controllers\UserController();

    if (isset($_GET['action'])) {

        // Retour au tableau de bord
        if ($_GET['action'] == 'home') {

            $adminController->dashboard();

        } elseif ($_GET['action'] == 'users') {
            
            $adminController->users();

        } elseif ($_GET['action'] == 'mails') {

            $adminController->mails();
        
        } elseif ($_GET['action'] == 'meetings') {

            $adminController->meetings();
        
        } elseif ($_GET['action'] == 'blog') {

            $adminController->blog();

        } elseif ($_GET['action'] == 'logout') {

            session_destroy();
            header('Location: index.php');

        }

        

    // Arrivée sur l'administration
    } else {

        $adminController->view('admin', 'dashboard');

    }

} catch (Exception $e) {
    require 'app/Views/front/errors/error.php';
}