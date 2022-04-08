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
            $content = htmlspecialchars($_POST['blog-content']);

            $tmpName = $_FILES['blog-img']['tmp_name'];
            $name = $_FILES['blog-img']['name'];
            $size = $_FILES['blog-img']['size'];
            $error = $_FILES['blog-img']['error'];
            $type = $_FILES['blog-img']['type'];

            $getExtension = explode('.', $name);
            $extension = strtolower(end($getExtension));

            $allowedExt = ['jpg', 'jpeg', 'gif', 'png'];
            $maxSize = 400000;

            if (in_array($extension, $allowedExt) && $size <= $maxSize && $error === 0) {

                $uniqueName = uniqid('', true);
                $img = $uniqueName . '.' . $extension;
                move_uploaded_file($tmpName, './Public/front/img/avatars/' . $img);
                $adminController->publish($title, $excerpt, $img, $content);

            } else {

                echo '<script type="text/javascript">alert("Ton image est pas conforme, yo.")</script>';
                $adminController->write();

            }

            

        // Lire un article
        } elseif ($_GET['action'] == 'readBlog') {

            $id = $_GET['id'];
            $adminController->readBlog($id);
        
        // Modifier un article
        } elseif ($_GET['action'] == 'editBlog') {

            $id = $_GET['id'];
            $adminController->edit($id);

        // Publier la modification
        } elseif ($_GET['action'] == 'modify') {

            $id = $_GET['id'];
            $title = htmlspecialchars($_POST['edit-title']);
            $excerpt = htmlspecialchars($_POST['edit-excerpt']);
            $img = 'no-img.png';
            $content = htmlspecialchars($_POST['edit-content']);

            $adminController->editBlog($title, $excerpt, $img, $content, $id);

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