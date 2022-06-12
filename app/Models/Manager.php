<?php

namespace Projet\Models;

use FFI\Exception;

class Manager {

    // Singleton -> optimisation de l'accès à la base de données
    private static $pdo = null;

    // Fonction d'accès à la base de données
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
                self::$pdo->query("SET lc_time_names = 'fr_FR'");
                return self::$pdo;
            } catch (Exception $e) {
                die ('Erreur : ' . $e->getMessage());
            }
        }
    }

    // Fonction permettant de récupérer le nom d'une classe instanciée pour faire fonctionner les fonctions suivantes
    public static function getChild() {
        $child = get_called_class();
        $childName = explode('\\', $child);
        $res = end($childName);

        return $res;
    }

    // Compter le nombre d'instance de chaque classe
    public static function count() {
        $pdo = self::dbConnect();
        $child = self::getChild();
        $req = $pdo->prepare("SELECT COUNT(id) 
                              FROM {$child}");
        $req->execute(array());
        $number = $req->fetch();
        
        return $number;
    }

    // Effacer une instance de classe
    public static function delete($id) {
        $pdo = self::dbConnect();
        $child = self::getChild();
        $req = $pdo->prepare("DELETE FROM `{$child}` 
                            WHERE id = ?");
        $req->execute(array($id));

        return $req;
    }
}