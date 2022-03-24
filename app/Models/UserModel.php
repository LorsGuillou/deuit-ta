<?php

namespace Projet\Models;

class UserModel extends Manager {

    public function createUser($pseudo, $mail, $password) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO `user` (`pseudo`, `mail`, `password`) VALUE (?, ?, ?)');
        $req->execute(array($pseudo, $mail, $password));

        return $req;
   }

   public function pseudoCheck($pseudo) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT COUNT(*) FROM user WHERE pseudo=?');
        $req->execute([$pseudo]);
        $check = $req->fetch()[0];

        return $check;
   }
}