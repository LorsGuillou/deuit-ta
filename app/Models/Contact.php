<?php

namespace Projet\Models;

class Contact extends Manager {

    public function postMail($id, $name, $object, $message, $date) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO mail (idUser, userName, `object`, `message`, created_at) VALUES (?, ?, ?, ?, ?)');
        $req->execute(array($id, $name, $object, $message, $date));

        return $req;
    }
}