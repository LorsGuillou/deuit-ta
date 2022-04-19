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

    public function connect($mail, $pass) {
        $userManager = new \Projet\Models\Users();
        $connect = $userManager->getPassword($mail, $pass);

        $res = $connect->fetch();

        $passwordCheck = password_verify($pass, $res['password']);

        $_SESSION['id'] = $res['id'];
        $_SESSION['lastname'] = $res['lastname'];
        $_SESSION['firstname'] = $res['firstname'];
        $_SESSION['mail'] = $res['mail'];
        $_SESSION['password'] = $res['password'];
        $_SESSION['avatar'] = $res['avatar'];
        $_SESSION['role'] = $res['role'];

        if ($passwordCheck && $res['role'] === 1) {
            header('Location: indexAdmin.php');
        } elseif ($passwordCheck) {
            require ($this->view('front', 'account'));
        } else {
            throw new \Exception ('Le mot de passe est incorrect !');
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