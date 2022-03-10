<?php

namespace Projet\Controllers;

class AdminController {

    function login() {
        require 'app/Views/admin/connexion.php';
    }

    function blog() {
        require 'app/Views/admin/blog.php';
    }
}