<?php

namespace Projet\Controllers;

class AdminController extends Controller {
    
    public function dashboard() {
        $this->view('admin', 'dashboard');
    }

    public function users() {
        $userManager = new \Projet\Models\User();
        $users = $userManager->userList();
        $this->view('admin', 'users');
    }

    public function mails() {
        $this->view('admin', 'mails');
    }

    public function meetings() {
        $this->view('admin', 'meetings');
    }

    public function blog() {
        $this->view('admin', 'blog');
    }
}