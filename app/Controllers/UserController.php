<?php

namespace Projet\Controllers;

class UserController extends Controller {

    public function createUser($lastname, $firstname, $mail, $pass, $avatar) {
        $userManager = new \Projet\Models\User();
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $newUser = $userManager->createUser($lastname, $firstname, $mail, $pass, $avatar);
            require ($this->view('front', 'confirmation'));
        } else {
            header('Location: app/Views/front/errors/error.php');
        }
    }

    public function connect($mail, $pass) {
        $userManager = new \Projet\Models\User();
        $connect = $userManager->getPassword($mail, $pass);

        $res = $connect->fetch();

        $passwordCheck = password_verify($pass, $res['password']);

        $_SESSION['id'] = $res['id'];
        $_SESSION['lastname'] = $res['lastname'];
        $_SESSION['firstname'] = $res['firstname'];
        $_SESSION['mail'] = $res['mail'];
        $_SESSION['password'] = $res['password'];
        $_SESSION['role'] = $res['role'];

        if ($passwordCheck && $res['role'] === 1) {
            header('Location: indexAdmin.php');
        } elseif ($passwordCheck) {
            require ($this->view('front', 'account'));
        } else {
            throw new \Exception ('Le mot de passe est incorrect !');
        }
    }

    public function nbUsers() {
        $userManager = new \Projet\Models\User();
        $users = $userManager->nbUsers();
        return $users;
    }

    public function postMail($id, $object, $message) {
        $contactManager = new \Projet\Models\Contact();
        $mail = $contactManager->postMail($id, $object, $message);
        echo "<script type'text/javascript'>alert('Votre message nous a bien été transmis !')</script>";
        require ($this->view('front', 'contact'));
    }
}