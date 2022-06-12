<?php

namespace Projet\Controllers;

class AdminController extends Controller {

    // Gestion du tableau de bord
    public function dashboard() {
        $userManager = new \Projet\Models\Users();
        $contactManager = new \Projet\Models\Contact();
        $blogManager = new \Projet\Models\Blog();
        $commentManager = new \Projet\Models\Comments();
        $nbUsers = $userManager->count();
        $nbMails = $contactManager->count();
        $nbBlog = $blogManager->count();
        $nbComments = $commentManager->count();
        require ($this->view('admin', 'dashboard'));
    }

    // Gestions des membres et des alertes associées
    // Listes des membres
    public function users($alert = null) {
        $userManager = new \Projet\Models\Users();
        $users = $userManager->userList();
        require ($this->view('admin', 'users'));
    }

    // Effacer un compte membre
    public function deleteUser($id) {
        $userManager = new \Projet\Models\Users();
        $deleteUser = $userManager->delete($id);
    }

    // Gestions des messages
    // Liste des messages
    public function mails($alert = null) {
        $contactManager = new \Projet\Models\Contact();
        $mails = $contactManager->mailList();
        require ($this->view('admin', 'mails'));
    }

    // Lecture de message
    public function readMail($id) {
        $contactManager = new \Projet\Models\Contact();
        $mail = $contactManager->readMail($id);
        require ($this->view('admin', 'readMail'));
    }

    // Effacer un message
    public function deleteMail($id) {
        $contactManager = new \Projet\Models\Contact();
        $deleteMail = $contactManager->delete($id);
    }

    // Gestions des articles et des alertes associées
    // Liste des articles
    public function blog($alert = null) {
        $blogManager = new \Projet\Models\Blog();
        $blogs = $blogManager->blogList();
        require ($this->view('admin', 'blog'));
    }

    // Aller sur la page de rédaction
    public function write() {
        $blogManager = new \Projet\Models\Blog();
        $blogs = $blogManager->blogList();
        require ($this->view('admin', 'writeBlog'));
    }

    // Aller sur la page d'édition
    public function edit($id) {
        $blogManager = new \Projet\Models\Blog();
        $blog = $blogManager->readBlog($id);
        require ($this->view('admin', 'editBlog'));
    }

    // Publier un article
    public function publish($data) {
        $blogManager = new \Projet\Models\Blog();
        $publish = $blogManager->publish($data);
    }

    // Editer un article
    public function editBlog($data) {
        $blogManager = new \Projet\Models\Blog();
        $edit = $blogManager->editBlog($data);
    }

    // Effacer un article
    public function deleteBlog($id) {
        $blogManager = new \Projet\Models\Blog();
        $deleteBlog = $blogManager->delete($id);
    }
}