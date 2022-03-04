<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

try {

    $frontController = new \Projet\Controllers\FrontController();

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'about') {
            $frontController->about();
        }
    } else {
        $frontController->home();
    }

} catch (Exception $e) {
    require 'app/Views/front/error.php';
}

