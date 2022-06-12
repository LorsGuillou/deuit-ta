<?php

namespace Projet\Controllers;

use Exception;

class FrontController extends Controller {

    // Gestion de la page d'accueil
    public function home() {
        $blogManager = new \Projet\Models\Blog();
        $blogs = $blogManager->blogHome();
        require ($this->view('front', 'home'));
    }

    // Gestion de la page A propos
    public function about() {
        require ($this->view('front', 'about'));
    }

    // Gestion de la page Blog, de l'affichage des articles et de la pagination
    public function blog($currentPage) {
        $blogManager = new \Projet\Models\Blog();
        $nbBlog = $blogManager->count();
        $byPage = 6;
        $pages = ceil($nbBlog[0] / $byPage);
        $firstBlog = ($currentPage * $byPage) - $byPage;
        $blogs = $blogManager->blogPage($firstBlog, $byPage);
        require ($this->view('front', 'blog'));
    }

    // Lecture d'un article, affichage des commentaires et des alertes associées
    public function readBlog($id, $alert = null) {
        $blogManager = new \Projet\Models\Blog();
        $commentManager = new \Projet\Models\Comments();
        $blog = $this->throw404IfEmpty($blogManager->readBlog($id));
        $number = $commentManager->nbComments($id);
        $comments = $commentManager->displayComments($id);
        require ($this->view('front', 'readBlog'));
    }

    // Gestion de la page Contact et des alertes associées
    public function contact($alert = null) {
        require ($this->view('front', 'contact'));
    }

    // Gestion de la page de connexion et des alertes associées
    public function login($alert = null) {
        require ($this->view('front', 'login'));
    }

    // Gestion de la page de création de compte et des alertes associées
    public function newUser($alert = null) {
        require ($this->view('front', 'register'));
    }

    // Gestion de la page compte, des commentaires de l'utilisateur, et les alertes associées
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

    // Page de navigation remplaçant le menu burger si JS est désactivé
    public function noJSNav() {
        require ($this->view('front', 'noJSNav'));
    }
}