<?php

namespace App\Repository;

use App\Entity\Course;
use App\Db\Mysql;
use App\Tools\StringTools;



class CourseRepository
{
    public function findOneById(int $id)
    {
        // appel bdd
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        $query = $pdo->prepare('SELECT * FROM course WHERE id_course = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $course = $query->fetch($pdo::FETCH_ASSOC); //pour aller chercher 1 fois l'information
        //var_dump($course);


        //$course = ['id'=> 1, "name" =>'course test',"description"=>'description test',"date"=>'date test'];

        $courseEntity = new Course();
        // $courseEntity->setId($course['id_course']);
        // $courseEntity->setName($course['name']);
        // $courseEntity->setDescription($course['description']);
        // $courseEntity->setDate($course['date_course']);
        // $courseEntity->setImage($course['image']);

        foreach ($course as $key => $value){
            $courseEntity->{'set' .StringTools::toPascalCase($key)} ($value);
        }

        return $courseEntity;

    }

    public function findAll()
    {
        try {
            // appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $query = $pdo->query('SELECT * FROM course');
            $coursesData = $query->fetchAll($pdo::FETCH_ASSOC);

            $courseList = [];

            foreach ($coursesData as $courseData) {
                $courseEntity = new Course();

                foreach ($courseData as $key => $value) {
                    $setterMethod = 'set' . StringTools::toPascalCase($key);

                    // Vérifiez si la méthode existe dans la classe Course avant de l'appeler
                    if (method_exists($courseEntity, $setterMethod)) {
                        $courseEntity->{$setterMethod}($value);
                    }
                }

                $courseList[] = $courseEntity;
            }

            return $courseList;
        } catch (\Exception $e) {
            // Gérez les exceptions, par exemple, affichez un message d'erreur
            throw new \Exception("Erreur lors de la récupération de la liste des cours : " . $e->getMessage());
        }
    }
}