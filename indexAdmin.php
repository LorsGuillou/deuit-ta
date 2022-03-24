<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    $adminController = new \Projet\Controllers\AdminController();

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home') {
            $adminController->dashboard();
        }
    } else {
        $adminController->dashboard();
    }

} catch (Exception $e) {
    require 'app/Views/front/errors/error.php';
}