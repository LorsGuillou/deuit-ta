<?php

namespace Projet\Controllers;

class AdminController extends Controller {

    // Tableau de bord
    public function dashboard() {
        $userManager = new \Projet\Models\Users();
        $contactManager = new \Projet\Models\Contact();
        $blogManager = new \Projet\Models\Blog();
        $nbUsers = $userManager->count();
        $nbMails = $contactManager->count();
        $nbBlog = $blogManager->count();
        require ($this->view('admin', 'dashboard'));
    }

    // Méthodes Membres
    public function users($alert = null) {
        $userManager = new \Projet\Models\Users();
        $users = $userManager->userList();
        require ($this->view('admin', 'users'));
    }

    public function deleteUser($id) {
        $userManager = new \Projet\Models\Users();
        $deleteUser = $userManager->delete($id);
    }

    // Méthodes Mails
    public function mails($alert = null) {
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
        $deleteMail = $contactManager->delete($id);
    }

    // Méthodes Activités
    public function activities() {
        require ($this->view('admin', 'activities'));
    }


    // Méthodes Articles
    public function blog($alert = null) {
        $blogManager = new \Projet\Models\Blog();
        $blogs = $blogManager->blogList();
        require ($this->view('admin', 'blog'));
    }

    public function write() {
        $blogManager = new \Projet\Models\Blog();
        $blogs = $blogManager->blogList();
        require ($this->view('admin', 'writeBlog'));
    }

    public function edit($id) {
        $blogManager = new \Projet\Models\Blog();
        $blog = $blogManager->readBlog($id);
        require ($this->view('admin', 'editBlog'));
    }

    public function publish($data) {
        $blogManager = new \Projet\Models\Blog();
        $publish = $blogManager->publish($data);
    }

    public function readBlog($id) {
        $blogManager = new \Projet\Models\Blog();
        $blog = $blogManager->readBlog($id);
        require ($this->view('admin', 'readBlog'));
    }

    public function editBlog($data) {
        $blogManager = new \Projet\Models\Blog();
        $edit = $blogManager->editBlog($data);
    }

    public function deleteBlog($id) {
        $blogManager = new \Projet\Models\Blog();
        $deleteBlog = $blogManager->delete($id);
    }
}