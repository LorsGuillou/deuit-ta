<?php

namespace Projet\Controllers;

class AdminController extends Controller {
    
    public function dashboard() {
        $this->adminView('dashboard');
    }

    public function nbUsers() {
        $userManager = new \Projet\Models\User;
        $number = $userManager->nbUser();
        return $number;
    }
}