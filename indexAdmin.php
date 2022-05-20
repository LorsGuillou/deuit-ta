<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {

    $adminController = new \Projet\Controllers\AdminController();
    $frontController = new \Projet\Controllers\FrontController();
    $userController = new \Projet\Controllers\UserController();

    if (empty($_SESSION)) {
        throw new Exception('Vous n\'avez pas l\'autorisation d\'être là !', 401);
    }

    if (isset($_GET['action'])) {

        // Retour au tableau de bord
        if ($_GET['action'] == 'home') {

            $adminController->dashboard();

        // Liste des membres
        } elseif ($_GET['action'] == 'users') {
            
            $adminController->users();

        // Supprimer un utilisateur
        } elseif ($_GET['action'] == 'deleteUser') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->deleteUser($id);

        // Liste des messages
        } elseif ($_GET['action'] == 'mails') {

            $adminController->mails();

        // Lire un message
        } elseif ($_GET['action'] == 'readMail') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->readMail($id);

        // Supprimer un message
        } elseif ($_GET['action'] == 'deleteMail') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->deleteMail($id);

        // Liste des activités
        } elseif ($_GET['action'] == 'adminactivities') {

            $adminController->activities();
        
        // Liste des articles
        } elseif ($_GET['action'] == 'blog') {

            $adminController->blog();

        // Ecrire un article
        } elseif ($_GET['action'] == 'write') {

            $adminController->write();

        // Publier un article
        } elseif ($_GET['action'] == 'publish') {

            $data = [
                ":titleFR" => htmlspecialchars($_POST['blog-titleFR']),
                ":titleBZH" => htmlspecialchars($_POST['blog-titleBZH']),
                ":excerptFR" => htmlspecialchars($_POST['blog-excerptFR']),
                ":excerptBZH" => htmlspecialchars($_POST['blog-excerptBZH']),
                ":img" => $adminController->getImg('admin', 'blog', 400000),
                ":contentFR" => htmlspecialchars($_POST['blog-contentFR']),
                ":contentBZH" => htmlspecialchars($_POST['blog-contentBZH'])
            ];

            $adminController->publish($data);

        // Lire un article
        } elseif ($_GET['action'] == 'readBlog') {

            $id = htmlspecialchars($_GET['id']);
            $frontController->readBlog($id);
        
        // Modifier un article
        } elseif ($_GET['action'] == 'editBlog') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->edit($id);

        // Publier la modification
        } elseif ($_GET['action'] == 'modify') {

            $data = [
                ":id" => $_GET['id'],
                ":titleFR" => htmlspecialchars($_POST['edit-titleFR']),
                ":titleBZH" => htmlspecialchars($_POST['edit-titleBZH']),
                ":excerptFR" => htmlspecialchars($_POST['edit-excerptFR']),
                ":excerptBZH" => htmlspecialchars($_POST['edit-excerptBZH']),
                ":img" => $adminController->getImg('admin', 'blog', 400000),
                ":contentFR" => htmlspecialchars($_POST['edit-contentFR']),
                ":contentBZH" => htmlspecialchars($_POST['edit-contentBZH'])
            ];

            $adminController->editBlog($data);

        // Supprimer un article
        } elseif ($_GET['action'] == 'deleteBlog') {

            $id = htmlspecialchars($_GET['id']);
            $adminController->deleteBlog($id);

        // Naviguer sur le site
        } elseif ($_GET['action'] == 'navigate') {

            $frontController->home();

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

    echo $e->getMessage();

}