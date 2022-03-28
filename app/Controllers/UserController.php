<?php

namespace Projet\Controllers;

class UserController extends Controller {

    public function login() {
        return $this->frontView('login');
    }

    public function newUser() {
        return $this->frontView('register');
    }

    public function createUser($pseudo, $mail, $mdp) {
        $userManager = new \Projet\Models\User();
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $newUser = $userManager->createUser($pseudo, $mail, $mdp);
            return $this->frontView('confirmation');
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
        $_SESSION['pseudo'] = $res['pseudo'];
        $_SESSION['mail'] = $res['mail'];
        $_SESSION['password'] = $res['password'];
        $_SESSION['role'] = $res['role'];

        if ($passwordCheck && $res['role'] === 1) {
            header('Location: indexAdmin.php');
        } elseif ($passwordCheck) {
            return $this->frontView('account');
        } else {
            echo "<script type='text/javascript'>alert('Le mot de passe est incorrect !')</script>";
            return $this->frontView('login');
        }
    }

    public function pseudoCheck($pseudo) {
        $userManager = new \Projet\Models\User();
        return $userManager->pseudoCheck($pseudo);
    }
}