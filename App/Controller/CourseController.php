<?php

namespace App\Controller;

use App\Repository\CourseRepository;

class CourseController extends Controller
{
    public function route(): void
    {
        try{
            if (isset($_GET['action'])){
                switch ($_GET['action']) {
                    case 'show':
                        // appeler la methode show()
                        $this->show();
                        break;
                    case 'list':
                        break;
                    case 'edit':
                        break;
                    case 'add';
                        break;
                    case 'delete';
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


}