<?php

namespace Projet\Models;

class Comments extends Manager {

    // Rédaction de commentaire
    public function comment($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO comments (idUser, idBlog, comment) 
                              VALUES (:idUser, :idBlog, :comment)');
        $req->execute($data);
        
        return $req;
    }

    // Nombre de commentaires sur un article donné
    public function nbComments($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT COUNT(id) 
                              FROM comments
                              WHERE idBlog = ?');
        $req->execute(array($id));
        $number = $req->fetch();
        
        return $number;
    }

    // Affichage des commentaires sur la page de l'article
    public function displayComments($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT users.username, users.avatar, comments.id, comments.idUser, comments.comment, DATE_FORMAT(comments.created_at, "%d %M %Y") as date
                            FROM comments
                            INNER JOIN users
                            ON users.id = comments.idUser
                            AND comments.idBlog = ?');
        $req->execute(array($id));
        $liste = $req->fetchAll();

        return $liste;
    }

    // Visionnage des commentaires de l'utilisateurs
    public function userComments($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT comments.id, comments.comment, DATE_FORMAT(comments.created_at, "%d %M %Y") as date, blog.id as link, blog.titleFR
                            FROM comments
                            INNER JOIN blog
                            ON blog.id = comments.idBlog
                            AND comments.idUser = ?');
        $req->execute(array($id));
        $liste = $req->fetchAll();

        return $liste;
    }
}