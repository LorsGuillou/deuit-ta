<?php

namespace Projet\Controllers;

class AdminController extends Controller {

    // Tableau de bord
    public function dashboard() {
        $userManager = new \Projet\Models\User();
        $contactManager = new \Projet\Models\Contact();
        $nbUsers = $userManager->nbUsers();
        $nbMails = $contactManager->nbMails();
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

    public function blog() {
        require ($this->view('admin', 'blog'));
    }

    
}