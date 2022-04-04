<?php

namespace Projet\Models;

class User extends Manager {

    public function createUser($lastname, $firstname, $mail, $password, $avatar, $date) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO `user` (`lastname`, firstname, `mail`, `password`, avatar, created_at) 
                              VALUE (?, ?, ?, ?, ?, ?)');
        $req->execute(array($lastname, $firstname, $mail, $password, $avatar, $date));

        return $req;
   }

   public function getPassword($mail, $pass) {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT id, lastname, firstname, mail, `password`, avatar, created_at, `role` 
                              FROM user 
                              WHERE mail= ? ');
        $req->execute(array($mail));

        return $req;
   }

//    public function pseudoCheck($pseudo) {
//         $bdd = self::dbConnect();
//         $req = $bdd->prepare('SELECT COUNT(*) FROM user WHERE lastname=?');
//         $req->execute([$pseudo]);
//         $check = $req->fetch()[0];

//         return $check;
//    }

   public function nbUsers() {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) 
                              FROM user');
        $req->execute();
        $number = $req->fetch();
        
        return $number;
   }

   public function userList() {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT id, lastname, firstname, mail, avatar, created_at 
                              FROM user');
        $req->execute();
        $list = $req->fetchAll();
        
        return $list;
   }

   public function deleteUser($id) {
     $bdd = self::dbConnect();
     $req = $bdd->prepare('DELETE FROM user WHERE id= ? ');
     $req->execute(array($id));

     return $req;
 }
}