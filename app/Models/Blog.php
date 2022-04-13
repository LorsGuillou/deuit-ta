<?php

namespace Projet\Models;

class Blog extends Manager {

    public function publish($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO blog (title, excerpt, img, content) 
                            VALUES (:title, :excerpt, :img, :content)');
        $req->execute($data);

        return $req;
    }

    public function nbBlog() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT COUNT(id) 
                            FROM blog');
        $req->execute(array());
        $number = $req->fetch();

        return $number;
    }

    public function blogList() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, title, excerpt, img, created_at
                            FROM blog');
        $req->execute(array());
        $list = $req->fetchAll();

        return $list;
    }

    public function readBlog($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, title, excerpt, img, content, created_at 
                            FROM blog 
                            WHERE id = ?');
        $req->execute(array($id));
        $blog = $req->fetch();

        return $blog;
    }

    public function editBlog($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('UPDATE blog
                            SET title = :title, excerpt = :excerpt, img = :img, content = :content
                            WHERE id = :id');
        $req->execute($data);

        return $req;
    }

    public function deleteBlog($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('DELETE FROM blog 
                            WHERE id = ?');
        $req->execute(array($id));

        return $req;
    }

    public function blogHome() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT title, excerpt, img, created_at 
                            FROM blog 
                            ORDER BY id 
                            DESC');
        $req->execute(array());
        $blog = $req->fetch();
        
        return $blog;
    }
}