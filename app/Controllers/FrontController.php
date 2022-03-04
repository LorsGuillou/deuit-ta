<?php

namespace Projet\Controllers;

class FrontController {

    function home() {
        require 'app/Views/front/home.php';
    }

    function about() {
        require 'app/Views/front/about.php';
    }

    function contact() {
        require 'app/Views/front/about.php';
    }

}