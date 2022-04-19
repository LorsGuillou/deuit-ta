<?php

namespace Projet\Models;

class Comments extends Manager {

    public function comment($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO comments (idUser, idArticle, comment) 
                              VALUES (:idUser, :idArticle, :comment)');
        $req->execute($data);
        
        return $req;
    }

    public function nbComments($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT COUNT(id) 
                              FROM comments
                              WHERE idArticle = ?');
        $req->execute(array($id));
        $number = $req->fetch();
        
        return $number;
    }

    public function displayComments($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT users.lastname, users.firstname, comments.comment 
                            FROM comments
                            INNER JOIN users
                            ON users.id = comments.idUser
                            AND idArticle = ?');
        $req->execute(array($id));
        $liste = $req->fetchAll();

        return $liste;
    }

    public function deleteComment($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('DELETE FROM comments 
                            WHERE id = ?');
        $req->execute(array($id));

        return $req;
    }

}