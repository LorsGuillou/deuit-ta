<?php

namespace Projet\Controllers;

class AdminController extends Controller {
    
    public function dashboard() {
        $userManager = new \Projet\Models\User();
        $contactManager = new \Projet\Models\Contact();
        $nbUsers = $userManager->nbUsers();
        $nbMails = $contactManager->nbMails();
        require ($this->view('admin', 'dashboard'));
    }

    public function users() {
        $userManager = new \Projet\Models\User();
        $users = $userManager->userList();
        require ($this->view('admin', 'users'));
    }

    public function mails() {
        $contactManager = new \Projet\Models\Contact();
        $mails = $contactManager->mailList();
        require ($this->view('admin', 'mails'));
    }

    public function meetings() {
        require ($this->view('admin', 'meetings'));
    }

    public function blog() {
        require ($this->view('admin', 'blog'));
    }

    public function deleteUser($id) {
        $userManager = new \Projet\Models\User();
        $deleteMail = $userManager->deleteUser($id);
        header('Location: indexAdmin.php?action=users');
    }

    public function deleteMail($id) {
        $contactManager = new \Projet\Models\Contact();
        $deleteMail = $contactManager->deleteMail($id);
        header('Location: indexAdmin.php?action=mails');
    }
}