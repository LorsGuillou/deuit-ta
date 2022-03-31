<?php

namespace Projet\Controllers;

class Controller {

    public function view($viewType, $viewName) {
        include ('app/Views/' . $viewType . '/templates/' . $viewName . '.php');
    }
}