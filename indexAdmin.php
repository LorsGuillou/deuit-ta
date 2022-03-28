<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

try {

    $adminController = new \Projet\Controllers\AdminController();

    if (isset($_GET['action'])) {

        // Retour au tableau de bord
        if ($_GET['action'] == 'home') {

            $adminController->dashboard();

        } elseif ($_GET['action'] == 'logout') {

            session_destroy();
            header('Location: index.php');

        }

        

    // Arrivée sur l'administration
    } else {

        $adminController->dashboard();

    }

} catch (Exception $e) {
    require 'app/Views/front/errors/error.php';
}