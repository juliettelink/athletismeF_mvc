<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;


class UserController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'register':
                        $this->register();
                        break;
                    case 'list':
                        $this->list();
                        break;
                    case 'delete':
                            $this->delete();
                            break;
                    case 'confirmDelete':
                        $this->confirmDelete();
                        break;
                    default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function register()
    {
        try {
            $errors = [];
            $user = new User();

            if (isset($_POST['saveUser'])) {
                
                $user->hydrate($_POST);
                $user->setRole(ROLE_USER);

                $errors = $user->validate();

                if (empty($errors)) {
                    $userRepository = new UserRepository();
                    
                    $userRepository->persist($user);
                    header('Location: index.php?controller=auth&action=login');
                }
            }

            $this->render('user/add_edit', [
                'user' => '',
                'pageTitle' => 'Inscription',
                'errors' => $errors
            ]);

        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        } 

    }

    protected function list()
    {
        try {
            // Charge toutes les courses depuis la base de données
            $userRepository = new UserRepository();
            $users = $userRepository->getAllUsers();

            // Affiche la liste des courses
            $this->render('user/list', ['users' => $users]);
        } catch (\Exception $e) {
            $this->render('errors/default', ['error' => $e->getMessage()]);
        }
    }

    protected function delete()
    {
        try {
            if (!User::isAdmin()) {
                throw new \Exception("Accès interdit. Vous n'avez pas les droits nécessaires.");
            }
    
            if (isset($_GET['id'])) {
                $id_user = (int)$_GET['id'];
    
                $userRepository = new UserRepository();
                $user = $userRepository->findOneById($id_user);
                
                // Affiche la confirmation de suppression
                if ($user){
                $this->render('user/delete', ['user' => $user]);
                } else {
                    throw new \Exception("Utilisateur non trouvé.");
                }
            } else {
                throw new \Exception("l'id est manquant");
            }
        } catch (\Exception $e) {
        $this->render('errors/default', ['error' => $e->getMessage()]);
        }
    }  

    protected function confirmDelete()
    {
        try {
            if (isset($_POST['id'])) {
                $id_user = (int)$_POST['id'];

                // Supprime la course depuis le repository
                $userRepository = new UserRepository();
                $userRepository->delete($id_user);

                // Redirection vers la liste des courses après la suppression
                header('Location: ?controller=user&action=list');
                exit;
            } else {
                throw new \Exception("l'id est manquant");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', ['error' => $e->getMessage()]);
        }
    }

}
