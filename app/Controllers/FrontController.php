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

    public function actu($currentPage) {
        $blogManager = new \Projet\Models\Blog();
        $nbBlog = $blogManager->count();
        $byPage = 6;
        $pages = ceil($nbBlog[0] / $byPage);
        $firstBlog = ($currentPage * $byPage) - $byPage;
        $blogs = $blogManager->blogPage($firstBlog, $byPage);
        require ($this->view('front', 'blog'));
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

    public function contact($alert = null) {
        require ($this->view('front', 'contact'));
    }

    public function login($alert = null) {
        require ($this->view('front', 'login'));
    }

    public function newUser($alert = null) {
        require ($this->view('front', 'register'));
    }

    public function account($id) {
        $commentsManager = new \Projet\Models\Comments;
        $comments = $commentsManager->userComments($id);
        require ($this->view('front', 'account'));
    }
}