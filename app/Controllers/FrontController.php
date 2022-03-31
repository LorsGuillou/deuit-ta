<?php

namespace Projet\Controllers;

class FrontController extends Controller {

    function home() {
        return $this->view('front', 'home');
    }

    function about() {
        return $this->view('front', 'about');
    }

    function rencontres() {
        return $this->view('front', 'rencontres');
    }

    function actu() {
        return $this->view('front', 'actu');
    }

    function contact() {
        return $this->view('front', 'contact');
    }

    function account() {
        return $this->view('front', 'account');
    }
}