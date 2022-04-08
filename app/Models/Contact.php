<?php

namespace Projet\Models;

class Contact extends Manager {

    public function postMail($id, $object, $message, $date) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO contact (idUser, `object`, `message`, created_at) 
                            VALUES (?, ?, ?, ?)');
        $req->execute(array($id, $object, $message, $date));

        return $req;
    }

    public function nbMails() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT COUNT(id) 
                              FROM contact');
        $req->execute(array());
        $number = $req->fetch();
        
        return $number;
   }

    public function mailList() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT contact.id, contact.object, contact.created_at, user.lastname, user.firstname 
                            FROM contact 
                            INNER JOIN user
                            ON contact.idUser = user.id');
        $req->execute(array());
        $list = $req->fetchAll();

        return $list;
    }

    public function readMail($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT contact.id, contact.object, contact.message, contact.created_at, user.lastname, user.firstname 
                            FROM contact
                            INNER JOIN user
                            ON contact.idUser = user.id AND contact.id= ?');
        $req->execute(array($id));
        $mail = $req->fetch();

        return $mail;
    }

    public function deleteMail($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('DELETE FROM contact WHERE id = ?');
        $req->execute(array($id));

        return $req;
    }
}