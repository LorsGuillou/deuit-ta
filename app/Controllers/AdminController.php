<?php

namespace Projet\Controllers;

class AdminController {

    public function login() {
        require 'app/Views/admin/connexion.php';
    }
    
    public function newAdmin() {
        require 'app/views/Admin/createAdmin.php';
    }

    public function createAdmin($lastname, $firstname, $mail, $mdp) {
        $userManager = new \Projet\Models\AdminModel();
        $user = $userManager->createAdmin($firstname, $lastname, $mail, $mdp);
    }



    public function blog() {
        require 'app/Views/admin/blog.php';
    }
}