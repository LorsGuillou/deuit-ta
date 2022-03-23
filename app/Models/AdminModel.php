<?php

namespace Projet\Models;


class AdminModel extends Manager {

    public function createAdmin($firstname, $lastname, $mail, $password) {
        $bdd = self::dbConnect();
        $user = $bdd->prepare('INSERT INTO `admin` (firstname, lastname, mail, password) VALUE (:firstname, :lastname, :mail, :password');
        $user->execute(array(
            'firstname' => $firstname, 
            'lastname' => $lastname, 
            'mail' => $mail, 
            'password' => $password
        ));

        return $user;
   } 
}