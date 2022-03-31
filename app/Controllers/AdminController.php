<?php

namespace Projet\Controllers;

class AdminController extends Controller {
    
    public function dashboard() {
        require ($this->view('admin', 'dashboard'));
    }

    public function users() {
        $userManager = new \Projet\Models\User();
        $users = $userManager->userList();
        require ($this->view('admin', 'users'));
    }

    public function mails() {
        require ($this->view('admin', 'mails'));
    }

    public function meetings() {
        require ($this->view('admin', 'meetings'));
    }

    public function blog() {
        require ($this->view('admin', 'blog'));
    }
}