<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

// Récupération des variables du dossier .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {

    $adminController = new \Projet\Controllers\AdminController();
    $frontController = new \Projet\Controllers\FrontController();
    $userController = new \Projet\Controllers\UserController();


    // Vérification du statut d'admin
    if (empty($_SESSION) || $_SESSION['role'] != 1) {
        throw new Exception('', 401);
    }

    // Vérification des actions dans l'URL 
    if (isset($_GET['action'])) {

        // Retour au tableau de bord
        if ($_GET['action'] == 'home') {

            $adminController->dashboard();

        // Liste des membres
        } elseif ($_GET['action'] == 'user') {
            
            $adminController->users();

        // Supprimer un utilisateur
        } elseif ($_GET['action'] == 'userDelete') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->deleteUser($id);

        // Liste des messages
        } elseif ($_GET['action'] == 'mail') {

            $adminController->mails();

        // Lire un message
        } elseif ($_GET['action'] == 'mailRead') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->readMail($id);

        // Supprimer un message
        } elseif ($_GET['action'] == 'mailDelete') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->deleteMail($id);
        
        // Liste des articles
        } elseif ($_GET['action'] == 'blog') {

            $adminController->blog();

        // Ecrire un article
        } elseif ($_GET['action'] == 'blogWrite') {

            $adminController->write();

        // Publier un article
        } elseif ($_GET['action'] == 'blogPublish') {

            $imgSize = $_FILES['image']['size'];

            $data = [
                ":titleFR" => htmlspecialchars($_POST['blog-titleFR']),
                ":titleBZH" => htmlspecialchars($_POST['blog-titleBZH']),
                ":excerptFR" => htmlspecialchars($_POST['blog-excerptFR']),
                ":excerptBZH" => htmlspecialchars($_POST['blog-excerptBZH']),
                ":img" => $adminController->getImg('admin', 'blog', $imgSize),
                ":contentFR" => htmlspecialchars($_POST['blog-contentFR']),
                ":contentBZH" => htmlspecialchars($_POST['blog-contentBZH'])
            ];
            $adminController->publish($data);

        // Lire un article
        } elseif ($_GET['action'] == 'blogRead') {

            $id = htmlspecialchars($_GET['id']);
            header('Location: ../blogRead&id=' . $id);
        
        // Modifier un article
        } elseif ($_GET['action'] == 'blogEdit') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->edit($id);

        // Publier la modification
        } elseif ($_GET['action'] == 'blogModify') {

            $imgSize = $_FILES['image']['size'];

            $data = [
                ":id" => $_GET['id'],
                ":titleFR" => htmlspecialchars($_POST['edit-titleFR']),
                ":titleBZH" => htmlspecialchars($_POST['edit-titleBZH']),
                ":excerptFR" => htmlspecialchars($_POST['edit-excerptFR']),
                ":excerptBZH" => htmlspecialchars($_POST['edit-excerptBZH']),
                ":img" => $adminController->getImg('admin', 'blog', $imgSize),
                ":contentFR" => htmlspecialchars($_POST['edit-contentFR']),
                ":contentBZH" => htmlspecialchars($_POST['edit-contentBZH'])
            ];
            $adminController->editBlog($data);

        // Supprimer un article
        } elseif ($_GET['action'] == 'blogDelete') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->deleteBlog($id);

        // Naviguer sur le site
        } elseif ($_GET['action'] == 'navigate') {

            header('Location: ../index.php');

        // Déconnexion
        } elseif ($_GET['action'] == 'logout') {

            session_destroy();
            header('Location: ../index.php');

        } else {

            throw new Exception('Cette action n\'existe pas');

        }

    // Arrivée sur l'administration
    } else {

        $adminController->dashboard();

    }

// Gestion des exceptions et erreurs
} catch (Exception $e) {

    require 'app/Views/admin/errors/error.php';
    
} catch (Error $e) {

    require 'app/Views/admin/errors/error.php';

}