<?php

namespace Projet\Controllers;

class FrontController extends Controller {

    function home() {
        require ($this->view('front', 'home'));
    }

    function about() {
        require ($this->view('front', 'about'));
    }

    function activities() {
        require ($this->view('front', 'activities'));
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