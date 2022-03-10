<?php

namespace Projet\Models;

class Manager {

    private static $bdd = null;

    protected static function dbConnect() {
        if (isset(self::$bdd)) {
            return self::$bdd;
        } else {
            self::$bdd = new \PDO(
                'mysql:host=localhost;
                dbname=projet-final;
                charset=utf8',
                'root',
                '');
        return self::$bdd;
        }
    }

    public static function all() {

        $objects = [];

        $child = get_called_class();
  
        $sqlQuery = "SELECT * FROM `{$child}`";
      
        foreach (self::dbConnect()->query($sqlQuery) as $res) {
        array_push(
            $objects, 
            new self($res)
            );
        }
        return $objects;
    }

    public static function find($id) {

        $names = [];
  
        $child = get_called_class();

        $sqlQuery = "SELECT `nom` OR `titre` FROM `{$child}` WHERE id=:id";
  
        $req = self::dbConnect()->prepare($sqlQuery);
        $req->execute(array(':id' => $id));
        array_push($names, new self($req));

        return $names;
      }
}