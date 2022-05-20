<?php

namespace Projet\Models;

class Blog extends Manager {

    public function publish($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO blog (titleFR, titleBZH, excerptFR, excerptBZH, img, contentFR, contentBZH) 
                            VALUES (:titleFR, :titleBZH, :excerptFR, :excerptBZH, :img, :contentFR, :contentBZH)');
        $req->execute($data);

        return $req;
    }

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

    public function blogList() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, titleFR, excerptFR, img, DATE_FORMAT(created_at, "%d %M %Y") as date
                            FROM blog');
        $req->execute(array());
        $list = $req->fetchAll();

        return $list;
    }

    public function readBlog($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, titleFR, titleBZH, excerptFR, excerptBZH, img, contentFR, contentBZH, DATE_FORMAT(created_at, "%d %M %Y") as date 
                            FROM blog 
                            WHERE id = ?');
        $req->execute(array($id));
        $blog = $req->fetch();

        return $blog;
    }

    public function editBlog($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('UPDATE blog
                            SET titleFR = :titleFR, titleBZH = :titleBZH, excerptFR = :excerptFR, excerptBZH = :excerptBZH, img = :img, contentFR = :contentFR, contentBZH = :contentBZH
                            WHERE id = :id');
        $req->execute($data);

        return $req;
    }

    public function blogHome() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, titleFR, titleBZH, excerptFR, excerptBZH, img, DATE_FORMAT(created_at, "%d %M %Y") as date 
                            FROM blog 
                            ORDER BY created_at 
                            DESC LIMIT 4');
        $req->execute(array());
        $blog = $req->fetchAll();
        
        return $blog;
    }
}