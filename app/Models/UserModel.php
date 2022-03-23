<?php

namespace Projet\Models;

class UserModel extends Manager {

    public function createUser($firstname, $lastname, $mail, $password) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO `user` (`firstname`, `lastname`, `mail`, `password`) VALUE (?, ?, ?, ?)');
        $req->execute(array($firstname, $lastname, $mail, $password));

        return $req;
   } 
}