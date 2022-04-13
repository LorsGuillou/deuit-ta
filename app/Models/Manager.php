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
                'mysql:host=localhost;
                dbname=deuit-ta;
                charset=utf8',
                'root',
                ''
            );
                return self::$pdo;
            } catch (Exception $e) {
                die ('Erreur : ' . $e->getMessage());
            }
        }
    }
}