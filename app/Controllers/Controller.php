<?php

namespace Projet\Controllers;

class Controller {

    public function view($viewName) {
        include ('app/Views/front/templates/' . $viewName . '.php');
    }
}