<?php

namespace Projet\Controllers;

use Exception;

class Controller {

    public function view($viewType, $viewName) {
        return 'app/Views/' . $viewType . '/templates/' . $viewName . '.php';
    }

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

            echo "<script type='text/javascript'>alert('L'image n'est pas conforme.')</script>";

        }
    }

    public function throw404IfEmpty($resource) {
        if (!$resource) {
            throw new Exception("La ressource demandée n'existe pas.", 404);
        } else {
            return $resource;
        }
    }
}