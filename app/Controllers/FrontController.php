<?php

namespace Projet\Controllers;

class FrontController extends Controller {

    public function home() {
        $blogManager = new \Projet\Models\Blog();
        $blogs = $blogManager->blogHome();
        require ($this->view('front', 'home'));
    }

    public function about() {
        require ($this->view('front', 'about'));
    }

    public function actu() {
        $blogManager = new \Projet\Models\Blog();
        $blogs = $blogManager->blogList();
        require ($this->view('front', 'actu'));
    }

    public function readActu($id) {
        $blogManager = new \Projet\Models\Blog();
        $commentManager = new \Projet\Models\Comments();
        $blog = $blogManager->readBlog($id);
        $number = $commentManager->nbComments($id);
        $comments = $commentManager->displayComments($id);
        require ($this->view('front', 'readActu'));
    }

    public function activities() {
        require ($this->view('front', 'activities'));
    }

    public function contact() {
        require ($this->view('front', 'contact'));
    }

    public function login() {
        require ($this->view('front', 'login'));
    }

    public function newUser($error = null) {
        require ($this->view('front', 'register'));
    }

    public function account($id) {
        $commentsManager = new \Projet\Models\Comments;
        $comments = $commentsManager->userComments($id);
        require ($this->view('front', 'account'));
    }
}