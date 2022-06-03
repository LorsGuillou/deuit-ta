<?php

namespace Projet\Controllers;

class UserController extends Controller {

    public function createUser($userData) {
        $userManager = new \Projet\Models\Users();
        $frontController = new \Projet\Controllers\FrontController();
        $uniqueNameCheck = $userManager->doesNameExists($_POST['username']);

        if ($uniqueNameCheck) {
            $alert = '<p class="form-error">Ce pseudonyme est déjà utilisé par l\'un de nos membres.</p>';
            $frontController->newUser($alert);
        } else if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $newUser = $userManager->createUser($userData);
            $success = '<p class="form-success">Votre compte a bien été créé ! Vous pouvez désormais vous connecter !</p>';
            $frontController->login($success);
        } else {
            header('Location: app/Views/front/errors/error.php');
        }
    }

    public function connect($mail, $password) {
        $userManager = new \Projet\Models\Users();
        $frontController = new \Projet\Controllers\FrontController();
        $connect = $userManager->loginCheck($mail, $password);

        $userData = $connect->fetch();

        if (!empty($userData)) {
            $passwordCheck = password_verify($password, $userData['password']);
            if ($passwordCheck) {
                $_SESSION['id'] = $userData['id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['mail'] = $userData['mail'];
                $_SESSION['password'] = $userData['password'];
                $_SESSION['avatar'] = $userData['avatar'];
                $_SESSION['role'] = $userData['role'];
                if ($userData['role'] === 1) {
                    header('Location: admin/home');
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

    public function editUsername($data) {
        $userManager = new \Projet\Models\Users();
        $edit = $userManager->editUsername($data);
    }

    public function editAvatar($data) {
        $userManager = new \Projet\Models\Users();
        $edit = $userManager->editAvatar($data);
    }

    public function editMail($data) {
        $userManager = new \Projet\Models\Users();
        if (filter_var($_POST['edit-mail'], FILTER_VALIDATE_EMAIL)) {
            $edit = $userManager->editMail($data);

        } else {
            header('Location: app/Views/front/errors/error.php');
        }
    }

    public function editPswd($data) {
        $userManager = new \Projet\Models\Users();
        $edit = $userManager->editPswd($data);
    }

    public function comment($data) {
        $commentManager = new \Projet\Models\Comments();
        $comment = $commentManager->comment($data);
    }

   public function deleteComment($id) {
       $commentManager = new \Projet\Models\Comments();
       $delete = $commentManager->delete($id);
   }

    public function postMail($data) {
        $contactManager = new \Projet\Models\Contact();
        $mail = $contactManager->postMail($data);
    }
}