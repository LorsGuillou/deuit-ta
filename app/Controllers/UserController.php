<?php

namespace Projet\Controllers;

class UserController extends Controller {

    public function createUser($data) {
        $userManager = new \Projet\Models\Users();
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $newUser = $userManager->createUser($data);
            require ($this->view('front', 'confirmation'));
        } else {
            header('Location: app/Views/front/errors/error.php');
        }
    }

    public function connect($mail, $password) {
        $userManager = new \Projet\Models\Users();
        $frontController = new \Projet\Controllers\FrontController();
        $connect = $userManager->doesUserExist($mail, $password);

        $userData = $connect->fetch();

        if (!empty($userData)) {
            $passwordCheck = password_verify($password, $userData['password']);
            if ($passwordCheck) {
                $_SESSION['id'] = $userData['id'];
                $_SESSION['lastname'] = $userData['lastname'];
                $_SESSION['firstname'] = $userData['firstname'];
                $_SESSION['mail'] = $userData['mail'];
                $_SESSION['password'] = $userData['password'];
                $_SESSION['avatar'] = $userData['avatar'];
                $_SESSION['role'] = $userData['role'];
                if ($userData['role'] === 1) {
                    header('Location: indexAdmin.php');
                } else {
                    header('Location: account');
                }
            } else {
                $error = '<p class="form-error">Le mot de passe est incorrect !</p>';
                $frontController->login($error);
            }
        } else {
            $error = '<p class="form-error">Cette adresse e-mail ne correspond à aucun de nos utilisateurs !</p>';
            $frontController->login($error);
        } 
    }

    public function editAvatar($data) {
        $userManager = new \Projet\Models\Users();
        $edit = $userManager->editAvatar($data);
        header('Location: index.php?action=account');
    }

    public function editMail($data) {
        $userManager = new \Projet\Models\Users();
        if (filter_var($_POST['edit-mail'], FILTER_VALIDATE_EMAIL)) {
            $edit = $userManager->editMail($data);
            header('Location: index.php?action=account');
        } else {
            header('Location: app/Views/front/errors/error.php');
        }
    }

    public function editPswd($data) {
        $userManager = new \Projet\Models\Users();
        $edit = $userManager->editPswd($data);
        header('Location: account');
    }

    public function comment($data) {
        $commentManager = new \Projet\Models\Comments();
        $comment = $commentManager->comment($data);
        echo "<script type='text/javascript'>alert('Votre message nous a bien été transmis !')</script>";
    }

   public function deleteComment($id) {
       $commentManager = new \Projet\Models\Comments();
       $delete = $commentManager->delete($id);
   }

    public function postMail($data) {
        $contactManager = new \Projet\Models\Contact();
        $mail = $contactManager->postMail($data);
        echo "<script type='text/javascript'>alert('Votre commentaire a été publié !')</script>";
        require ($this->view('front', 'contact'));
    }
}