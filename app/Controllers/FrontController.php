<?php

namespace Projet\Controllers;

class FrontController {

    function home() {
        require 'app/Views/front/home.php';
    }

    function about() {
        require 'app/Views/front/about.php';
    }

    function rencontres() {
        require 'app/Views/front/rencontres.php';
    }

    function actu() {
        require 'app/Views/front/actu.php';
    }

    function contact() {
        require 'app/Views/front/contact.php';
    }
}