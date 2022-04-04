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

        // Lire un message
        } elseif ($_GET['action'] == 'readMail') {

            $id = $_GET['id'];
            $adminController->readMail($id);

        // Supprimer un message
        } elseif ($_GET['action'] == 'deleteMail') {

            $id = $_GET['id'];
            $adminController->deleteMail($id);

        // Liste des activités
        } elseif ($_GET['action'] == 'activities') {

            $adminController->activities();
        
        // Liste des articles
        } elseif ($_GET['action'] == 'blog') {

            $adminController->blog();

        // Ecrire un article
        } elseif ($_GET['action'] == 'write') {

            $adminController->write();

        // Publier un article
        } elseif ($_GET['action'] == 'publish') {

            $title = htmlspecialchars($_POST['blog-title']);
            $excerpt = htmlspecialchars($_POST['blog-excerpt']);
            $img = 'no-img.png';
            $content = htmlspecialchars($_POST['blog-content']);
            $date = date('Y-m-d');

            if (empty($title) || empty($excerpt) || empty($img) || empty($content) || empty($date)) {

                echo '<script type="text/javascript">alert("Tout les champs doivent être remplis.")</script>';
                $adminController->write();

            } else {

                $adminController->publish($title, $excerpt, $img, $content, $date);

            }

        // Supprimer un article
        } elseif ($_GET['action'] == 'deleteBlog') {

            $id = $_GET['id'];
            $adminController->deleteBlog($id);

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