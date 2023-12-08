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
}