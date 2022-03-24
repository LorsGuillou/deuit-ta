<?php

namespace Projet\Controllers;

class Controller {

    public function frontView($viewName) {
        include ('app/Views/front/templates/' . $viewName . '.php');
    }

    public function adminView($viewName) {
        include ('app/Views/admin/templates' . $viewName . '.php');
    }

    public function dashboard() {
        include ('indexAdmin.php');
    }
}