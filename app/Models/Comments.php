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
        $req = $pdo->prepare('SELECT users.lastname, users.firstname, comments.id, comments.idUser, comments.comment, comments.created_at
                            FROM comments
                            INNER JOIN users
                            ON users.id = comments.idUser
                            AND comments.idArticle = ?');
        $req->execute(array($id));
        $liste = $req->fetchAll();

        return $liste;
    }

    public function userComments($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT comments.id, comments.comment, comments.created_at, blog.title
                            FROM comments
                            INNER JOIN blog
                            ON blog.id = comments.idArticle
                            AND comments.idUser = ?');
        $req->execute(array($id));
        $liste = $req->fetchAll();

        return $liste;
    }
}