<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\User;
use App\Repository\CourseRepository;

class CourseController extends Controller
{
    public function route(): void
    {
        try{
            if (isset($_GET['action'])){
                switch ($_GET['action']) {
                    case 'show':
                            $this->show();
                        break;
                    case 'list':
                        $this->list();
                        break;
                    case 'edit':
                        $this->edit();
                        break;
                    case 'update':
                        $this->update();
                    case 'delete':
                        $this->delete();
                    case 'confirmDelete':
                            $this->confirmDelete();
                        break;
                    case 'add';
                            $this->add();
                        break;
                    case 'create';
                        $this-> create();
                        break;
                    default:
                        //Erreur
                        throw new \Exception("cette action n'existe pas : " .$_GET['action']);                        
                        break;
                }
            }else{
                throw new \Exception('aucune action détectée');
            }
        }catch(\Exception $e){
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function show()
    {
        try {
            if (isset($_GET['id'])){

                $id_course = (int)$_GET['id'];
                // charger la course par un appel au repository
                $courseRepository = new CourseRepository();
                $course = $courseRepository->findOneById($id_course);

                $this->render('course/show',[
                    'course' => $course
                ]);
            }else{
                throw new \Exception("l'id est manquant");
            }
        } catch(\Exception $e){
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
        
        
    }

        protected function list()
    {
        try {
            // Charge toutes les courses depuis la base de données
            $courseRepository = new CourseRepository();
            $courses = $courseRepository->findAll();

            // Affiche la liste des courses
            $this->render('course/list', ['courses' => $courses]);
        } catch (\Exception $e) {
            $this->render('errors/default', ['error' => $e->getMessage()]);
        }
    }

    protected function edit()
    {
        try {
            if (!User::isAdmin()) {
                throw new \Exception("Accès interdit. Vous n'avez pas les droits nécessaires.");
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Traitement du formulaire d'édition
                $this->update();
            } elseif (isset($_GET['id'])) {
                // Affiche le formulaire d'édition
                $id_course = (int)$_GET['id'];

                // Charge la course depuis le repository
                $courseRepository = new CourseRepository();
                $course = $courseRepository->findOneById($id_course);

                // Affiche le formulaire d'édition
                $this->render('course/edit', ['course' => $course]);
            } else {
                throw new \Exception("l'id est manquant");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', ['error' => $e->getMessage()]);
        }
    }

    private function update()
{
    try {
        // Validez les données du formulaire, assurez-vous qu'elles sont correctes
        // ...

        // Créez un objet Course avec les nouvelles données
        $updatedCourse = new Course();
        $updatedCourse->setIdCourse($_POST['id_course']);
        $updatedCourse->setName($_POST['name']);
        $updatedCourse->setDescription($_POST['description']);
        $updatedCourse->setDateCourse($_POST['date_course']);
        //pour le traitement de l'image
        $updatedCourse->setImage($this->handleImageUpload());

        // Mettez à jour la course dans la base de données
        $courseRepository = new CourseRepository();
        $courseRepository->update($updatedCourse);

        // Redirigez vers la liste des courses après la mise à jour
        header('Location: ?controller=course&action=list');
        exit;
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
                $id_course = (int)$_GET['id'];

                // Charge la course depuis le repository
                $courseRepository = new CourseRepository();
                $course = $courseRepository->findOneById($id_course);

                // Affiche la confirmation de suppression
                $this->render('course/delete', ['course' => $course]);
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
                $id_course = (int)$_POST['id'];

                // Supprime la course depuis le repository
                $courseRepository = new CourseRepository();
                $courseRepository->delete($id_course);

                // Redirection vers la liste des courses après la suppression
                header('Location: ?controller=course&action=list');
                exit;
            } else {
                throw new \Exception("l'id est manquant");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', ['error' => $e->getMessage()]);
        }
    }

    protected function add()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Traitement du formulaire d'ajout
                $this->create();
            } else {
                // Affiche le formulaire d'ajout
                $this->render('course/add');
            }
        } catch (\Exception $e) {
            $this->render('errors/default', ['error' => $e->getMessage()]);
        }
    }

    private function create()
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $date_course = $_POST['date_course'];
        
        //Traitement de l'image
        $imagePath = $this->handleImageUpload();


        $newCourse = new Course();
        $newCourse->setName($name);
        $newCourse->setDescription($description);
        $newCourse->setDateCourse($date_course);
        $newCourse->setImage($imagePath);


        // Ajoutez la nouvelle course à la base de données
        $courseRepository = new CourseRepository();
        $courseRepository->add($newCourse);

        // Redirigez vers la liste des courses après l'ajout
        header('Location: ?controller=course&action=list');
        exit;
    }

    private function handleImageUpload()
    {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $uploadDir = 'uploads/courses/'; 
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
    
            // Déplace le fichier téléchargé vers le dossier d'uploads
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                return $uploadFile;
            } else {
                // Gestion des erreurs lors du téléchargement du fichier
                throw new \Exception('Erreur lors du téléchargement du fichier.');
            }
        } elseif (!empty($_POST['external_image_url'])) {
            // Si une URL externe est fournie, téléchargez l'image depuis cette URL
            $externalImageUrl = $_POST['external_image_url'];
            $imageContent = file_get_contents($externalImageUrl);
    
            if ($imageContent !== false) {
                $uploadDir = 'uploads/courses/';
                $uploadFile = $uploadDir . basename($externalImageUrl);
                
                // Enregistrez le contenu de l'image dans le fichier local
                file_put_contents($uploadFile, $imageContent);
                
                return $uploadFile;
            } else {
                // Gestion des erreurs lors du téléchargement de l'image externe
                throw new \Exception('Erreur lors du téléchargement de l\'image externe.');
            }
        } else {
            // Aucun fichier téléchargé et aucune URL externe fournie
            return 'uploads/courses/defaultStade.jpg'; 
        }
    }
    
}