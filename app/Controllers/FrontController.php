<?php

namespace Projet\Controllers;

class FrontController extends Controller {

    function home() {
        return $this->frontView('home');
    }

    function about() {
        return $this->frontView('about');
    }

    function rencontres() {
        return $this->frontView('rencontres');
    }

    function actu() {
        return $this->frontView('actu');
    }

    function contact() {
        return $this->frontView('contact');
    }
}