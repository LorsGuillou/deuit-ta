<?php

namespace Projet\Models;

class Contact extends Manager {

    // Rédaction d'un message
    public function postMail($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO contact (idUser, object, message) 
                            VALUES (:id, :object, :message)');
        $req->execute($data);

        return $req;
    }

    // Liste des messages sur la page admin
    public function mailList() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT contact.id, contact.object, DATE_FORMAT(contact.created_at, "%d %M %Y") as date, users.username
                            FROM contact 
                            INNER JOIN users
                            ON contact.idUser = users.id');
        $req->execute(array());
        $list = $req->fetchAll();

        return $list;
    }

    // Lecture de message
    public function readMail($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT contact.id, contact.object, contact.message, DATE_FORMAT(contact.created_at, "%d %M %Y") as date, users.username, users.mail 
                            FROM contact
                            INNER JOIN users
                            ON contact.idUser = users.id 
                            AND contact.id= ?');
        $req->execute(array($id));
        $mail = $req->fetch();

        return $mail;
    }
}