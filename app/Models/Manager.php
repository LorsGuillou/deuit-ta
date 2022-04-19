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

    public static function getChild() {
        $child = get_called_class();
        $childName = explode('\\', $child);
        $res = end($childName);

        return $res;
    }

    public static function count() {
        $pdo = self::dbConnect();
        $child = self::getChild();
        $req = $pdo->prepare("SELECT COUNT(id) 
                              FROM {$child}");
        $req->execute(array());
        $number = $req->fetch();
        
        return $number;
    }

    public static function delete($id) {
        $pdo = self::dbConnect();
        $child = self::getChild();
        $req = $pdo->prepare("DELETE FROM `{$child}` 
                            WHERE id = ?");
        $req->execute(array($id));

        return $req;
    }
}