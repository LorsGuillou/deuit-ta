<?php

namespace Projet\Controllers;

class UserController extends Controller {

    public function newUser() {
        return $this->view('register');
    }

    public function createUser($firstname, $lastname, $mail, $mdp) {
        $userManager = new \Projet\Models\UserModel();
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $newUser = $userManager->createUser($firstname, $lastname, $mail, $mdp);
            require 'app/Views/front/confirmation.php';
        } else {
            header('Location: app/Views/front/errors/error.php');
        }
    }
}