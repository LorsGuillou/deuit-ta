<?php

namespace Projet\Controllers;

class UserController extends Controller {

    public function login() {
        return $this->view('login');
    }

    public function newUser() {
        return $this->view('register');
    }

    public function createUser($pseudo, $mail, $mdp) {
        $userManager = new \Projet\Models\UserModel();
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $newUser = $userManager->createUser($pseudo, $mail, $mdp);
            return $this->view('confirmation');
        } else {
            header('Location: app/Views/front/errors/error.php');
        }
    }

    public function pseudoCheck($pseudo) {
        $userManager = new \Projet\Models\UserModel();
        return $userManager->pseudoCheck($pseudo);
    }
}