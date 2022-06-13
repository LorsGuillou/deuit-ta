<?php

namespace Projet\Controllers;

class UserController extends Controller {

    // Gestion de la création de compte, de ces conditions et des alertes associées
    public function createUser($userData) {
        $userManager = new \Projet\Models\Users();
        $frontController = new \Projet\Controllers\FrontController();

        $uniqueNameCheck = $userManager->doesNameExists($_POST['username']);
        $imgSize = $_FILES['image']['size'];
        $pass = htmlspecialchars($_POST['password']);
        $passCheck = htmlspecialchars($_POST['confirmPswd']);

        if (empty($_POST['username']) || empty($_POST['mail']) || empty($_POST['password']) || empty($_POST['confirmPswd'])) {
            $alert = '<p class="form-error">Tout les champs doivent être remplis !</p>';
            $frontController->newUser($alert);
        }  elseif ($uniqueNameCheck) {
            $alert = '<p class="form-error">Ce pseudonyme est déjà utilisé par l\'un de nos membres.</p>';
            $frontController->newUser($alert);
        } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $alert = '<p class="form-error">Cette adresse mail est invalide !</p>';
            $frontController->newUser($alert);
        } elseif($imgSize > 5000000) {
            $alert = '<p class="form-error">Le poids de l\'image est trop important !</p>';
            $frontController->newUser($alert);
        } elseif ($passCheck != $pass) {
            $alert = '<p class="form-error">Les mots de passes ne correspondent pas !</p>';
            $frontController->newUser($alert);
        } elseif (empty($_POST['RGPD'])) {
            $alert = '<p class="form-error">Vous devez agréer à notre politique de confidentialité pour vous inscrire !</p>';
            $frontController->newUser($alert);
        } else if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $userManager->createUser($userData);
            $success = '<p class="form-success">Votre compte a bien été créé ! Vous pouvez désormais vous connecter !</p>';
            $frontController->login($success);
        } else {
            header('Location: app/Views/front/errors/error.php');
        }
    }

    // Gestion de la connexion, des vérifications et des alertes associées
    public function connect($mail, $password) {
        $userManager = new \Projet\Models\Users();
        $frontController = new \Projet\Controllers\FrontController();
        $connect = $userManager->loginCheck($mail, $password);

        $userData = $connect->fetch();

        if (empty($_POST['login-mail']) || empty($_POST['login-pswd'])) {
            $alert = '<p class="form-error">Tout les champs doivent être remplis !</p>';
            $frontController->login($alert);
        } elseif (!empty($userData)) {
            $passwordCheck = password_verify($password, $userData['password']);
            if ($passwordCheck) {
                $_SESSION['id'] = $userData['id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['mail'] = $userData['mail'];
                $_SESSION['password'] = $userData['password'];
                $_SESSION['avatar'] = $userData['avatar'];
                $_SESSION['role'] = $userData['role'];
                if ($userData['role'] === 1) {
                    header('Location: admin/home');
                } else {
                    header('Location: account');
                }
            } else {
                $error = '<p class="form-error">Le mot de passe est incorrect !</p>';
                $frontController->login($error);
            }
        } else {
            $error = '<p class="form-error">Cette adresse e-mail ne correspond à aucun de nos utilisateurs !</p>';
            $frontController->login($error);
        } 
    }

    // Gestion de l'édition du compte : pseudonyme, avatar, adresse e-mail et mot de passe
    public function editUsername($data) {
        $userManager = new \Projet\Models\Users();
        $frontController = new \Projet\Controllers\FrontController();

        $newUsername = htmlspecialchars($_POST['edit-username']);
        $uniqueNameCheck = $userManager->doesNameExists($_POST['edit-username']);

        if ($uniqueNameCheck) {
            $alert = '<p class="error">Ce pseudonyme est déjà utilisé par un autre membre !</p>';
            $frontController->account($alert);
        } elseif (empty($newUsername)) {
            $alert = '<p class="error">Le champs Nouveau pseudonyme est vide !</p>';
            $frontController->account($alert);
        } elseif ($_SESSION['username'] === $newUsername) {
            $alert = '<p class="error">Vous utilisez déjà ce pseudonyme !</p>';
            $frontController->account($alert);
        } else {
            $userManager->editUsername($data);
            $_SESSION['username'] = $data[':username'];
            $alert = '<p class="success">Le pseudonyme a été modifié avec succès !</p>';
            $frontController->account($alert);
        }
    }

    public function editAvatar($data) {
        $userManager = new \Projet\Models\Users();
        $frontController = new \Projet\Controllers\FrontController();

        $imgSize = $_FILES['image']['size'];

        if ($imgSize > 5000000) {
            $alert = '<p class="form-error">Le poids de l\'image est trop important !</p>';
            $frontController->account($alert);
        } else {
            $userManager->editAvatar($data);
            $_SESSION['avatar'] = $data[':avatar'];
            $alert = '<p class="success">L\'avatar a été modifié avec succès !</p>';
            $frontController->account($alert);
        }
    }

    public function editMail($data) {
        $userManager = new \Projet\Models\Users();
        $frontController = new \Projet\Controllers\FrontController();

        $newMail = htmlspecialchars($_POST['edit-mail']);

        if (empty($newMail)) {
            $alert = '<p class="error">Le champ Nouvelle adresse e-mail est vide !</p>';
            $frontController->account($alert);
        } elseif (!filter_var($_POST['edit-mail'], FILTER_VALIDATE_EMAIL)) {
            $alert = '<p class="error">Cette adresse mail est invalide !</p>';
            $frontController->account($alert);
        } elseif (filter_var($_POST['edit-mail'], FILTER_VALIDATE_EMAIL)) {
            $userManager->editMail($data);
            $_SESSION['mail'] = $data[':mail'];
            $alert = '<p class="success">L\'adresse mail a été modifié avec succès !</p>';
            $frontController->account($alert);
        }
    }

    public function editPswd($data) {
        $userManager = new \Projet\Models\Users();
        $frontController = new \Projet\Controllers\FrontController();

        $newPass = htmlspecialchars($_POST['edit-password']);
        $newPassCheck = htmlspecialchars($_POST['edit-confirmPswd']);

        if (empty($newPass) || empty($newPassCheck)) {
            $alert = '<p class="error">Le champ Nouveau mot de passe ou le champ de confirmation est vide !</p>';
            $frontController->account($alert);
        } elseif ($newPass != $newPassCheck) {
            $alert = '<p class="error">Les mots de passes ne correspondent pas !</p>';
            $frontController->account($alert);
        } else {
            $userManager->editPswd($data);
            $_SESSION['password'] = $data[':password'];
            $alert = '<p class="success">Le mot de passe a été modifié avec succès !</p>';
            $frontController->account($alert);
        }
        
    }

    // Gestion des commentaires : publier et effacer
    public function comment($data) {
        $commentManager = new \Projet\Models\Comments();
        $frontController = new \Projet\Controllers\FrontController();

        $commentManager->comment($data);
        $alert = '<p class="success">Votre commentaire a bien été publié !</p>';
        $frontController->readBlog($_GET['id'], $alert);
    }

   public function deleteComment($id) {
       $commentManager = new \Projet\Models\Comments();
       $delete = $commentManager->delete($id);
       $frontController = new \Projet\Controllers\FrontController();

       $idPage = htmlspecialchars($_GET['idPage']);
       $alert = '<p class="success">Votre commentaire a bien été supprimé !</p>';
       $frontController->readBlog($idPage, $alert);
   }

   // Gestion de l'envoi de message à l'administrateur
    public function postMail($data) {
        $contactManager = new \Projet\Models\Contact();
        $frontController = new \Projet\Controllers\FrontController();
        $mail = $contactManager->postMail($data);

        if (empty($_POST['object'])) {
            $alert = '<p class="form-error">Veuillez précisez l\'objet de votre message</p>';
            $frontController->contact($alert);
        } elseif (empty($_POST['message'])) {
            $alert = '<p class="form-error">Votre message est vide</p>';
            $frontController->contact($alert);
        } elseif (empty($_POST['object']) && empty($_POST['message'])) {
            $alert = '<p class="form-error">Vous ne pouvez pas envoyer un message vide.</p>';
            $frontController->contact($alert); 
        } else {
            $alert = '<p class="form-success">Votre message nous a bien été transmis !</p>';
            $frontController->contact($alert);
            $mail = $contactManager->postMail($data);
        }
    }
}