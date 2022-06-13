<?php

namespace Projet\Controllers;

use Exception;

class Controller {

    // Fonction retournant une vue selon son type (front / admin) et son nom
    public function view($viewType, $viewName) {
        return 'app/Views/' . $viewType . '/templates/' . $viewName . '.php';
    }

    // Gestion des images
    public function getImg($imgSide, $imgType, $maxSize) {

        $tmpName = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];
        $type = $_FILES['image']['type'];

        $getExtension = explode('.', $name);
        $extension = strtolower(end($getExtension));

        $allowedExt = ['jpg', 'jpeg', 'gif', 'png'];

        if (in_array($extension, $allowedExt) && $size <= $maxSize && $error === 0) {

            $uniqueName = uniqid('', true);
            $img = filter_var($uniqueName . '.' . $extension);
            move_uploaded_file($tmpName, './Public/' . $imgSide . '/img/' . $imgType . '/' . $img);
            
            return $img;

        } else {

            throw new Exception ('Le format de cette image n\'est pas valide.');

        }
    }

    // Gestions des ressources inexistantes / manquantes
    public function throw404IfEmpty($resource) {
        if (!$resource) {
            throw new Exception("La ressource demandée n'existe pas.", 404);
        } else {
            return $resource;
        }
    }
}