<?php

namespace Projet\Models;

use Exception;

class Manager {
    protected function dbConnect() {
        try {
            $bdd = new \PDO(
                'mysql:host=localhost;
                dbname=projet-final;
                charset=utf8',
                'root',
                '');
            return $bdd;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}