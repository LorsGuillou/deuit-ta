<?php

namespace Projet\Models;

class Blog extends Manager {

    // Création d'article
    public function publish($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO blog (titleFR, titleBZH, excerptFR, excerptBZH, img, contentFR, contentBZH) 
                            VALUES (:titleFR, :titleBZH, :excerptFR, :excerptBZH, :img, :contentFR, :contentBZH)');
        $req->execute($data);

        return $req;
    }

    // Affichage des articles dans la catégorie Blog, en limitant le nombre d'articles par page
    public function blogPage($firstBlog, $byPage) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, titleFR, titleBZH, excerptFR, excerptBZH, img, DATE_FORMAT(created_at, "%d %M %Y") as date 
                            FROM blog 
                            ORDER BY created_at 
                            DESC LIMIT :firstBlog, :byPage');
        $req->bindValue(':firstBlog', $firstBlog, $pdo::PARAM_INT);
        $req->bindValue(':byPage', $byPage, $pdo::PARAM_INT);
        $req->execute();
        $blog = $req->fetchAll();
        
        return $blog;
    }

    // Liste des articles dans la partie admin
    public function blogList() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, titleFR, excerptFR, img, DATE_FORMAT(created_at, "%d %M %Y") as date
                            FROM blog');
        $req->execute(array());
        $list = $req->fetchAll();

        return $list;
    }

    // Récupération des données d'un article en particulier pour sa lecture
    public function readBlog($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, titleFR, titleBZH, excerptFR, excerptBZH, img, contentFR, contentBZH, DATE_FORMAT(created_at, "%d %M %Y") as date 
                            FROM blog 
                            WHERE id = ?');
        $req->execute(array($id));
        $blog = $req->fetch();

        return $blog;
    }

    // Edition d'un blog en partie admin
    public function editBlog($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('UPDATE blog
                            SET titleFR = :titleFR, titleBZH = :titleBZH, excerptFR = :excerptFR, excerptBZH = :excerptBZH, img = :img, contentFR = :contentFR, contentBZH = :contentBZH
                            WHERE id = :id');
        $req->execute($data);

        return $req;
    }

    // Affichage des deux derniers articles pour la page d'accueil
    public function blogHome() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, titleFR, titleBZH, excerptFR, excerptBZH, img, DATE_FORMAT(created_at, "%d %M %Y") as date 
                            FROM blog 
                            ORDER BY created_at 
                            DESC LIMIT 2');
        $req->execute(array());
        $blog = $req->fetchAll();
        
        return $blog;
    }
}