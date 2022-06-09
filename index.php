<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {

    $frontController = new \Projet\Controllers\FrontController();
    $userController = new \Projet\Controllers\UserController();
    $noAuthorisation = new Exception ('Vous n\'avez pas l\'autorisation pour cette requête.', 401);

    if (isset($_GET['action'])) {
    
        // Aller à l'accueil
        if ($_GET['action'] == 'home') {

            $frontController->home();

        // Aller sur A propos
        } elseif ($_GET['action'] == 'about') {

            $frontController->about();

        // Aller sur Actualités
        } elseif ($_GET['action'] == 'blog') {

            if (isset($_GET['page']) && !empty($_GET['page'])) {

                $currentPage = (int) strip_tags($_GET['page']);

            } else {

                $currentPage = 1;

            }

            $frontController->blog($currentPage);

        // Lire un article en entier
        } elseif ($_GET['action'] == 'blogRead') {

            $id = htmlspecialchars($_GET['id']);
            $frontController->readBlog($id);

        // Commenter un article
        } elseif ($_GET['action'] == 'blogComment') {

            $data = [
                ':idUser' => htmlspecialchars($_SESSION['id']),
                ':idBlog' => htmlspecialchars($_GET['id']),
                ':comment' => htmlspecialchars($_POST['type-comment'])
            ];
            
            $userController->comment($data);
            $alert = '<p class="success">Votre commentaire a bien été publié !</p>';
            $frontController->readBlog($_GET['id'], $alert);

        // Supprimer son commentaire
        } elseif ($_GET['action'] == 'blogDeleteComment') {

            $id = htmlspecialchars($_GET['id']);
            $idPage = htmlspecialchars($_GET['idPage']);
            $userController->deleteComment($id);
            $alert = '<p class="success">Votre commentaire a bien été supprimé !</p>';
            $frontController->readBlog($idPage, $alert);

        // Aller sur Rencontres
        } elseif ($_GET['action'] == 'activities') {

            $frontController->activities();

        // Aller sur Contact
        } elseif ($_GET['action'] == 'contact') {

            if (empty($_SESSION)) {

                throw $noAuthorisation;

            } else {

                $frontController->contact();

            }

        // Formulaire de contact
        } elseif ($_GET['action'] == 'contactPost') {

            if (empty($_SESSION)) {

                throw $noAuthorisation;

            } else {

                $data = [
                    ':id' => htmlspecialchars($_SESSION['id']),
                    ':object' => htmlspecialchars($_POST['object']),
                    ':message' => htmlspecialchars($_POST['message'])
                ];

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
                    $userController->postMail($data);
                }

            }

        // Aller sur Connexion
        } elseif ($_GET['action'] == 'login') {

            $frontController->login();

        // Se connecter
        } elseif ($_GET['action'] == 'connect') {

            $mail = htmlspecialchars($_POST['login-mail']);
            $password = htmlspecialchars($_POST['login-pswd']);

            if (empty($mail) || empty($password)) {

                $alert = '<p class="form-error">Tout les champs doivent être remplis !</p>';
                $frontController->login($alert);

            } else {

                $userController->connect($mail, $password);

            }
        
        // Aller sur Créer un compte
        } elseif ($_GET['action'] == 'register') {

            $frontController->newUser();
    
        // Création de compte
        } elseif ($_GET['action'] == 'loginCreateUser') {

            $pass = htmlspecialchars($_POST['password']);
            $passCheck = htmlspecialchars($_POST['confirmPswd']);
            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $imgSize = $_FILES['image']['size'];

            if (($_FILES['image']['name'] == "")) {

                $avatar = 'blank.jpg';

            } else {

                $avatar = htmlspecialchars($frontController->getImg('front', 'avatars', $imgSize));

            }

            $data = [
                ':username' => htmlspecialchars($_POST['username']),
                ':mail' => htmlspecialchars($_POST['mail']),
                ':password' => $passHash,
                ':avatar' => $avatar
            ];
            
            if (empty($_POST['username']) || empty($_POST['mail']) || empty($_POST['password']) || empty($_POST['confirmPswd'])) {

                $alert = '<p class="form-error">Tout les champs doivent être remplis !</p>';
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

            } else {

                $userController->createUser($data);

            }

        // Aller sur la page compte
        } elseif ($_GET['action'] == 'account') {

            if (empty($_SESSION)) {

                throw $noAuthorisation;

            } else {

                $frontController->account();

            }

        // Modifier le pseudonyme
        } elseif ($_GET['action'] == 'accountEditUsername') {

            if (empty($_SESSION)) {

                throw $noAuthorisation;

            } else {
            
                $newUsername = htmlspecialchars($_POST['edit-username']);

                $data = [
                    ':id' => $_SESSION['id'],
                    ':username' => $newUsername
                ];

                if (empty($newUsername)) {

                    $alert = '<p class="error">Le champs Nouveau pseudonyme est vide !</p>';
                    $frontController->account($alert);

                } elseif ($_SESSION['username'] === $newUsername) {

                    $alert = '<p class="error">Vous utilisez déjà ce pseudonyme !</p>';
                    $frontController->account($alert);

                } else {

                    $_SESSION['username'] = $data[':username'];
                    $userController->editUsername($data);
                    $alert = '<p class="success">Le pseudonyme a été modifié avec succès !</p>';
                    $frontController->account($alert);

                }

            }

        // Modifier l'avatar
        } elseif ($_GET['action'] == 'accountEditAvatar') {

            if (empty($_SESSION)) {

                throw $noAuthorisation;

            } else {
            
                $data = [
                    ':id' => $_SESSION['id'],
                    ':avatar' => $userController->getImg('front', 'avatars', 100000)
                ];

                if ($_FILES['image']['name'] == "") {

                    $alert = '<p class="error">Vous n\'avez sélectionner aucune image !</p>';
                    $frontController->account($alert);

                } else {

                    $_SESSION['avatar'] = $data[':avatar'];
                    $userController->editAvatar($data);
                    $alert = '<p class="success">L\'avatar a été modifié avec succès !</p>';
                    $frontController->account($alert);
            
                }
        
            }

        // Modifier l'adresse mail
        } elseif ($_GET['action'] == 'accountEditMail') {

            if (empty($_SESSION)) {

                throw $noAuthorisation;

            } else {
            
                $newMail = htmlspecialchars($_POST['edit-mail']);

                $data = [
                    ':id' => $_SESSION['id'],
                    ':mail' => $newMail
                ];

                if (empty($newMail)) {

                    $alert = '<p class="error">Le champ Nouvelle adresse e-mail est vide !</p>';
                    $frontController->account($alert);

                } elseif (!filter_var($_POST['edit-mail'], FILTER_VALIDATE_EMAIL)) {

                    $alert = '<p class="error">Cette adresse mail est invalide !</p>';
                    $frontController->account($alert);

                } else {

                    $_SESSION['mail'] = $data[':mail'];
                    $userController->editMail($data);
                    $alert = '<p class="success">L\'adresse mail a été modifié avec succès !</p>';
                    $frontController->account($alert);

                }

            }

        // Modifier le mot de passe
        } elseif ($_GET['action'] == 'accountEditPswd') {

            if (empty($_SESSION)) {

                throw $noAuthorisation;

            } else {
            
                $newPass = htmlspecialchars($_POST['edit-password']);
                $newPassCheck = htmlspecialchars($_POST['edit-confirmPswd']);
                $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);

                $data = [
                    ':id' => $_SESSION['id'],
                    ':password' => $newPassHash
                ];

                if (empty($newPass) || empty($newPassCheck)) {

                    $alert = '<p class="error">Le champ Nouveau mot de passe ou le champ de confirmation est vide !</p>';
                    $frontController->account($alert);

                } elseif ($newPass != $newPassCheck) {

                    $alert = '<p class="error">Les mots de passes ne correspondent pas !</p>';
                    $frontController->account($alert);

                } else {

                    $_SESSION['password'] = $data[':password'];
                    $userController->editPswd($data);
                    $alert = '<p class="success">Le mot de passe a été modifié avec succès !</p>';
                    $frontController->account($alert);
            
                }

            }
        
        // Supprimer les commentaires depuis la page Compte
        } elseif ($_GET['action'] == 'accountDeleteComment') {

            if (empty($_SESSION)) {

                throw $noAuthorisation;

            } else {

                $id = htmlspecialchars($_GET['id']);
                $userController->deleteComment($id);
                $alert = '<p class="success">Votre commentaire a bien été supprimé !</p>';
                $frontController->account($alert);

            }

        // Se déconnecter
        } elseif ($_GET['action'] == 'logout') {

            session_destroy();
            header('Location: index.php');

        // JS désactivé
        } elseif ($_GET['action'] == 'noJSNav') {

            $frontController->noJSNAV();

        } else {

            throw new Exception('Cette action n\'existe pas');

        }
    
    // Arrivée sur le site
    } else {

        $frontController->home();

    }

} catch (Exception $e) {

    require 'app/Views/front/errors/error.php';
    
} catch (Error $e) {

    require 'app/Views/front/errors/error.php';

}