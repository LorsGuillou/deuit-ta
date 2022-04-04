<?php

namespace Projet\Models;

class Blog extends Manager {

    public function publish($title, $excerpt, $img, $content, $date) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO blog (title, excerpt, img, content, created_at) 
                            VALUES (?, ?, ?, ?, ?)');
        $req->execute(array($title, $excerpt, $img, $content, $date));

        return $req;
    }

    public function nbBlog() {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) 
                            FROM blog');
        $req->execute(array());
        $number = $req->fetch();

        return $number;
    }

    public function blogList() {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT id, title, excerpt, created_at 
                            FROM blog');
        $req->execute(array());
        $list = $req->fetchAll();

        return $list;
    }

    public function editBlog($title, $excerpt, $img, $content, $id) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('UPDATE blog
                            SET title = ?, excerpt = ?, img = ?, content = ?
                            WHERE id = ?');
        $req->execute(array($title, $excerpt, $img, $content, $id));

        return $req;
    }

    public function deleteBlog($id) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('DELETE FROM blog WHERE id = ?');
        $req->execute(array($id));

        return $req;
    }
}