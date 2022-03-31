<?php

namespace Projet\Controllers;

class Controller {

    public function view($viewType, $viewName) {
        return 'app/Views/' . $viewType . '/templates/' . $viewName . '.php';
    }
}