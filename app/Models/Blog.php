<?php

namespace Projet\Models;

class Blog extends Manager {

    public function publish($title, $excerpt, $img, $content) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO blog (title, excerpt, img, content) 
                            VALUES (?, ?, ?, ?)');
        $req->execute(array($title, $excerpt, $img, $content));

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
        $req = $pdo->prepare('SELECT id, title, excerpt, img, content, created_at, updated_at 
                            FROM blog 
                            WHERE id = ?');
        $req->execute(array($id));
        $blog = $req->fetch();

        return $blog;
    }

    public function editBlog($title, $excerpt, $img, $content, $id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('UPDATE blog
                            SET title = ?, excerpt = ?, img = ?, content = ?
                            WHERE id = ?');
        $req->execute(array($title, $excerpt, $img, $content, $id));

        return $req;
    }

    public function deleteBlog($id) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('DELETE FROM blog WHERE id = ?');
        $req->execute(array($id));

        return $req;
    }
}