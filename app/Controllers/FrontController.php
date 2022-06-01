<?php

namespace Projet\Controllers;

use Exception;

class FrontController extends Controller {

    public function home() {
        $blogManager = new \Projet\Models\Blog();
        $blogs = $blogManager->blogHome();
        require ($this->view('front', 'home'));
    }

    public function about() {
        require ($this->view('front', 'about'));
    }

    public function blog($currentPage) {
        $blogManager = new \Projet\Models\Blog();
        $nbBlog = $blogManager->count();
        $byPage = 6;
        $pages = ceil($nbBlog[0] / $byPage);
        $firstBlog = ($currentPage * $byPage) - $byPage;
        $blogs = $blogManager->blogPage($firstBlog, $byPage);
        require ($this->view('front', 'blog'));
    }

    public function readBlog($id, $alert = null) {
        $blogManager = new \Projet\Models\Blog();
        $commentManager = new \Projet\Models\Comments();
        $blog = $this->throw404IfEmpty($blogManager->readBlog($id));
        $number = $commentManager->nbComments($id);
        $comments = $commentManager->displayComments($id);
        require ($this->view('front', 'readBlog'));
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

    public function account($alert = null) {
        $commentsManager = new \Projet\Models\Comments;
        if (empty($_SESSION)) {
            header('Location: login');
        } else {
            $id = $_SESSION['id'];
            $comments = $commentsManager->userComments($id);
            require ($this->view('front', 'account'));
        }
    }

    public function noJSNav() {
        require ($this->view('front', 'noJSNav'));
    }
}