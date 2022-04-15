<?php

namespace Projet\Models;

use FFI\Exception;

class Manager {

    private static $pdo = null;

    protected static function dbConnect() {
        if (isset(self::$pdo)) {
            return self::$pdo;
        } else {
            try {
                self::$pdo = new \PDO (
                'mysql:host=' . $_ENV['DB_HOST'] . ';
                dbname=' . $_ENV['DB_NAME'] . ';
                charset=utf8',
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD']
            );
                return self::$pdo;
            } catch (Exception $e) {
                die ('Erreur : ' . $e->getMessage());
            }
        }
    }
}