<?php

namespace Projet\Controllers;

class FrontController extends Controller {

    function home() {
        return $this->view('home');
    }

    function about() {
        return $this->view('about');
    }

    function rencontres() {
        return $this->view('rencontres');
    }

    function actu() {
        return $this->view('actu');
    }

    function contact() {
        return $this->view('contact');
    }
}