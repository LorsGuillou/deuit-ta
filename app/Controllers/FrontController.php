<?php

namespace Projet\Controllers;

class FrontController extends Controller {

    function home() {
        require ($this->view('front', 'home'));
    }

    function about() {
        require ($this->view('front', 'about'));
    }

    function rencontres() {
        require ($this->view('front', 'rencontres'));
    }

    function actu() {
        require ($this->view('front', 'actu'));
    }

    function contact() {
        require ($this->view('front', 'contact'));
    }

    function account() {
        require ($this->view('front', 'account'));
    }
}