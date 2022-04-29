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
        $connect = $userManager->getPassword($mail, $password);

        $res = $connect->fetch();

        $passwordCheck = password_verify($password, $res['password']);

        if (!empty($res)) {
            if ($passwordCheck) {
                $_SESSION['id'] = $res['id'];
                $_SESSION['lastname'] = $res['lastname'];
                $_SESSION['firstname'] = $res['firstname'];
                $_SESSION['mail'] = $res['mail'];
                $_SESSION['password'] = $res['password'];
                $_SESSION['avatar'] = $res['avatar'];
                $_SESSION['role'] = $res['role'];
                if ($res['role'] === 1) {
                    header('Location: indexAdmin.php');
                } else {
                    require ($this->view('front', 'account'));
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

    public function editUser($data) {
        $userManager = new \Projet\Models\Users();
        $edit = $userManager->editUser($data);
        header('Location: index.php?action=account');
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