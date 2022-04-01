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

        // Liste des membres
        } elseif ($_GET['action'] == 'users') {
            
            $adminController->users();

        // Supprimer un utilisateur
        } elseif ($_GET['action'] == 'deleteUser') {

            $id = $_GET['id'];
            $adminController->deleteUser($id);

        // Liste des messages
        } elseif ($_GET['action'] == 'mails') {

            $adminController->mails();

        // Supprimer un message
        } elseif ($_GET['action'] == 'deleteMail') {

            $id = $_GET['id'];
            $adminController->deleteMail($id);

        // Liste des rencontres
        } elseif ($_GET['action'] == 'meetings') {

            $adminController->meetings();
        
        // Liste des articles
        } elseif ($_GET['action'] == 'blog') {

            $adminController->blog();
        
        // Déconnexion
        } elseif ($_GET['action'] == 'logout') {

            session_destroy();
            header('Location: index.php');

        }

    // Arrivée sur l'administration
    } else {

        $adminController->dashboard();

    }

} catch (Exception $e) {

    $e->getMessage();

}