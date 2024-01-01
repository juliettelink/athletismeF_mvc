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


        $courseEntity = new Course();

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

    public function add(Course $course): void
    {
        try{

            
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $query = $pdo->prepare('INSERT INTO course(name, description, date_course, image) VALUE (?, ?, ?, ?)');
            $query->bindValue(1, $course->getName(), $pdo::PARAM_STR);
            $query->bindValue(2, $course->getDescription(), $pdo::PARAM_STR);
            $query->bindValue(3, $course->getDateCourse(), $pdo::PARAM_STR);
            $query->bindValue(4, $course->getImage(), $pdo::PARAM_STR);

            if (!file_exists(dirname($course->getImage()))) {
                mkdir(dirname($course->getImage()), 0777, true);
            }
            $query->execute();

        } catch (\Exception $e) {
            
            throw new \Exception("Erreur lors de l'ajout de la course : " . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        try {
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $query = $pdo->prepare('DELETE FROM course WHERE id_course = :id');
            $query->bindValue(':id', $id, $pdo::PARAM_INT);
            $query->execute();
        } catch (\Exception $e) {
            
            throw new \Exception("Erreur lors de la suppression de la course : " . $e->getMessage());
        }
    }

    public function update(Course $course)
    {
        try {
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            // si une nouvelle image a été spécifiée
            $imageUpdate = $course->getImage() ;//!== 'uploads/courses/defaultStade.jpg';

            // Préparez la requête SQL
            $sql = 'UPDATE course SET name = :name, description = :description, date_course = :date_course';
            if ($imageUpdate) {
                $sql .= ', image = :image';
            }
            $sql .= ' WHERE id_course = :id';

            $query = $pdo->prepare($sql);
            $query->bindValue(':id',$course->getIdCourse(), $pdo::PARAM_INT);
            $query->bindValue(':name',$course->getName(), $pdo::PARAM_STR);
            $query->bindValue(':description',$course->getDescription(), $pdo::PARAM_STR);
            $query->bindValue(':date_course',$course->getDateCourse(), $pdo::PARAM_STR);
            
            if ($imageUpdate) {
                $query->bindValue(':image', $course->getImage(), $pdo::PARAM_STR);
            }
            
            $query->execute();
        } catch (\Exception $e) {
            
            throw new \Exception("Erreur lors de la suppression de la course : " . $e->getMessage());
        }
    }
}