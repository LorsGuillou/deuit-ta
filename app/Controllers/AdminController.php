<?php

namespace Projet\Controllers;

class AdminController extends Controller {

    // Tableau de bord
    public function dashboard() {
        $userManager = new \Projet\Models\User();
        $contactManager = new \Projet\Models\Contact();
        $blogManager = new \Projet\Models\Blog();
        $nbUsers = $userManager->nbUsers();
        $nbMails = $contactManager->nbMails();
        $nbBlog = $blogManager->nbBlog();
        require ($this->view('admin', 'dashboard'));
    }

    // Méthodes Membres
    public function users() {
        $userManager = new \Projet\Models\User();
        $users = $userManager->userList();
        require ($this->view('admin', 'users'));
    }

    public function deleteUser($id) {
        $userManager = new \Projet\Models\User();
        $deleteMail = $userManager->deleteUser($id);
        header('Location: indexAdmin.php?action=users');
    }

    // Méthodes Mails
    public function mails() {
        $contactManager = new \Projet\Models\Contact();
        $mails = $contactManager->mailList();
        require ($this->view('admin', 'mails'));
    }

    public function readMail($id) {
        $contactManager = new \Projet\Models\Contact();
        $mail = $contactManager->readMail($id);
        require ($this->view('admin', 'readMail'));
    }

    public function deleteMail($id) {
        $contactManager = new \Projet\Models\Contact();
        $deleteMail = $contactManager->deleteMail($id);
        header('Location: indexAdmin.php?action=mails');
    }

    // Méthodes Activités
    public function activities() {
        require ($this->view('admin', 'activities'));
    }


    // Méthodes Articles
    public function blog() {
        $blogManager = new \Projet\Models\Blog();
        $blogs = $blogManager->blogList();
        require ($this->view('admin', 'blog'));
    }

    public function write() {
        require ($this->view('admin', 'write'));
    }

    public function publish($title, $excerpt, $img, $content, $date) {
        $blogManager = new \Projet\Models\Blog();
        $publish = $blogManager->publish($title, $excerpt, $img, $content, $date);
        require ($this->view('admin', 'confirmation'));
    }

    public function editBlog($id) {
        
    }

    public function deleteBlog($id) {
        $blogManager = new \Projet\Models\Blog();
        $deleteBlog = $blogManager->deleteBlog($id);
        header('Location: indexAdmin.php?action=blog');
    }
}