<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

try {
    $adminController = new \Projet\Controllers\AdminController();

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'about') {
            $adminController->blog();
        }
    } else {
        $adminController->login();
    }

} catch (Exception $e) {
    require 'app/Views/front/error.php';
}