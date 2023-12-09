<?php

namespace App\Repository;

use App\Entity\Coureur;
use App\Db\Mysql;
use App\Tools\StringTools;



class CoureurRepository
{
    // public function findOneById(int $id)
    // {
    //     // appel bdd
    //     $mysql = Mysql::getInstance();
    //     $pdo = $mysql->getPDO();

    //     $query = $pdo->prepare('SELECT * FROM coureur WHERE id_coureur = :id');
    //     $query->bindValue(':id', $id, $pdo::PARAM_INT);
    //     $query->execute();
    //     $coureur = $query->fetch($pdo::FETCH_ASSOC); //pour aller chercher 1 fois l'information
        

    //     $coureurEntity = new Coureur();


    //     foreach ($coureur as $key => $value){
    //         $coureurEntity->{'set' .StringTools::toPascalCase($key)} ($value);
    //     }

    //     return $coureurEntity;

    // }

    public function findAll()
    {
        try {
            // appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $query = $pdo->query('SELECT * FROM coureur');
            $coursesData = $query->fetchAll($pdo::FETCH_ASSOC);

            $courseList = [];

            foreach ($coursesData as $courseData) {
                $coureurEntity = new Coureur();

                foreach ($courseData as $key => $value) {
                    $setterMethod = 'set' . StringTools::toPascalCase($key);

                    // Vérifiez si la méthode existe dans la classe Course avant de l'appeler
                    if (method_exists($coureurEntity, $setterMethod)) {
                        $coureurEntity->{$setterMethod}($value);
                    }
                }

                $coureurList[] = $coureurEntity;
            }

            return $coureurList;
        } catch (\Exception $e) {
            // Gérez les exceptions, par exemple, affichez un message d'erreur
            throw new \Exception("Erreur lors de la récupération de la liste des cours : " . $e->getMessage());
        }
    }
}