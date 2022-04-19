<?php

namespace Projet\Models;

class Contact extends Manager {

    public function postMail($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO contact (idUser, object, message) 
                            VALUES (:id, :object, :message)');
        $req->execute($data);

        return $req;
    }

    public function mailList() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT contact.id, contact.object, contact.created_at, users.lastname, users.firstname 
                            FROM contact 
                            INNER JOIN users
                            ON contact.idUser = users.id');
        $req->execute(array());
        $list = $req->fetchAll();

        return $list;
    }

    public function readMail($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT contact.id, contact.object, contact.message, contact.created_at, users.lastname, users.firstname 
                            FROM contact
                            INNER JOIN users
                            ON contact.idUser = users.id 
                            AND contact.id= ?');
        $req->execute(array($id));
        $mail = $req->fetch();

        return $mail;
    }
}