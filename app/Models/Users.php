<?php

namespace Projet\Models;

class Users extends Manager {

    public function createUser($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO users (lastname, firstname, mail, password, avatar) 
                              VALUES (:lastname, :firstname, :mail, :password, :avatar)');
        $req->execute($data);

        return $req;
   }

   public function getPassword($mail, $pass) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, lastname, firstname, mail, password, avatar, created_at, role 
                              FROM users 
                              WHERE mail= ?');
        $req->execute(array($mail));

        return $req;
   }

   public function userList() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, lastname, firstname, mail, avatar, created_at 
                              FROM users WHERE role = 0');
        $req->execute(array());
        $list = $req->fetchAll();
        
        return $list;
   }

   public function editUser($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('UPDATE users
                              SET avatar = :avatar
                              WHERE id = :id');
        $req->execute($data);
        
        return $req;
   }
}