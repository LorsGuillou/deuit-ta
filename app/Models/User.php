<?php

namespace Projet\Models;

class User extends Manager {

    public function createUser($pseudo, $mail, $password) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO `user` (`pseudo`, `mail`, `password`) VALUE (?, ?, ?)');
        $req->execute(array($pseudo, $mail, $password));

        return $req;
   }

   public function getPassword($mail, $pass) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT id, pseudo, mail, `password`, `role` FROM user WHERE mail=?');
        $req->execute(array($mail));

        return $req;
   }

   public function pseudoCheck($pseudo) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT COUNT(*) FROM user WHERE pseudo=?');
        $req->execute([$pseudo]);
        $check = $req->fetch()[0];

        return $check;
   }

   public function nbUser() {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM user');
        $req->execute(array());
        return $req;
   }
}