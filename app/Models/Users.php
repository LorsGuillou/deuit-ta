<?php

namespace Projet\Models;

class Users extends Manager {

    public function createUser($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('INSERT INTO users (username, mail, password, avatar) 
                              VALUES (:username, :mail, :password, :avatar)');
        $req->execute($data);

        return $req;
   }

   public function doesNameExists($username) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT username
                              FROM users
                              WHERE username = ?');
        $req->execute(array($username));
        $check = $req->fetch();

        return $check;
   }

   public function loginCheck($mail, $password) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, username, mail, password, avatar, DATE_FORMAT(created_at, "%d %M %Y") as date, role 
                              FROM users 
                              WHERE mail = ?');
        $req->execute(array($mail));

        return $req;
   }

   public function userList() {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('SELECT id, username, mail, avatar, DATE_FORMAT(created_at, "%d %M %Y") as date 
                              FROM users WHERE role = 0');
        $req->execute(array());
        $list = $req->fetchAll();
        
        return $list;
   }

   public function editUsername($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('UPDATE users
                              SET username = :username
                              WHERE id = :id');
        $req->execute($data);
        
        return $req;
   }

   public function editAvatar($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('UPDATE users
                              SET avatar = :avatar
                              WHERE id = :id');
        $req->execute($data);
        
        return $req;
   }

   public function editMail($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('UPDATE users
                              SET mail = :mail
                              WHERE id = :id');
        $req->execute($data);
        
        return $req;
   }
   
   public function editPswd($data) {
        $pdo = self::dbConnect();
        $req = $pdo->prepare('UPDATE users
                              SET password = :password
                              WHERE id = :id');
        $req->execute($data);
        
        return $req;
   }
}