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
        $req = $pdo->prepare('SELECT users.username, users.avatar, comments.id, comments.idUser, comments.comment, DATE_FORMAT(comments.created_at, "%d %M %Y") as date
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
        $req = $pdo->prepare('SELECT comments.id, comments.comment, DATE_FORMAT(comments.created_at, "%d %M %Y") as date, blog.id as link, blog.titleFR
                            FROM comments
                            INNER JOIN blog
                            ON blog.id = comments.idArticle
                            AND comments.idUser = ?');
        $req->execute(array($id));
        $liste = $req->fetchAll();

        return $liste;
    }
}