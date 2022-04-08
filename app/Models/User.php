<?php

namespace Projet\Models;

class User extends Manager {

    public function createUser($lastname, $firstname, $mail, $password, $avatar, $date) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO `user` (`lastname`, firstname, `mail`, `password`, avatar, created_at) 
                              VALUES (?, ?, ?, ?, ?, ?)');
        $req->execute(array($lastname, $firstname, $mail, $password, $avatar, $date));

        return $req;
   }

   public function getPassword($mail, $pass) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, lastname, firstname, mail, `password`, avatar, created_at, `role` 
                              FROM user 
                              WHERE mail= ? ');
        $req->execute(array($mail));

        return $req;
   }

//    public function pseudoCheck($pseudo) {
//         $pdo = self::dbConnect();
//         $req = $pdo->prepare('SELECT COUNT(*) FROM user WHERE lastname=?');
//         $req->execute([$pseudo]);
//         $check = $req->fetch()[0];

//         return $check;
//    }

   public function nbUsers() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT COUNT(id) 
                              FROM user');
        $req->execute(array());
        $number = $req->fetch();
        
        return $number;
   }

   public function userList() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, lastname, firstname, mail, avatar, created_at 
                              FROM user');
        $req->execute(array());
        $list = $req->fetchAll();
        
        return $list;
   }

   public function deleteUser($id) {
     $pdo = self::dbConnect();
     $req = $pdo->prepare('DELETE FROM user WHERE id= ? ');
     $req->execute(array($id));

     return $req;
 }
}