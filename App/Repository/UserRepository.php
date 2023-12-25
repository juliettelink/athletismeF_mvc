<?php

namespace App\Repository;

use App\Entity\User;
use App\Db\Mysql;
use App\Tools\StringTools;
use App\Entity\Entity;

class UserRepository 
{

    public function findOneById(int $id)
    {
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        $query = $pdo->prepare('SELECT * FROM user WHERE id_user = :id');
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $user = $query->fetch($pdo::FETCH_ASSOC);
        if ($user) {
            return User::createAndHydrate($user);;
        } else {
            return false;
        }
    }

    public function getAllUsers()
{
    try {
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        $query = $pdo->prepare('SELECT * FROM user');
        $query->execute();
        $users = $query->fetchAll(\PDO::FETCH_ASSOC);

        $userObjects = [];
        foreach ($users as $userData) {
            $userObjects[] = User::createAndHydrate($userData);
        }

        return $userObjects;
    } catch (\Exception $e) {
        throw new \Exception("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
    }
}

    public function findOneByEmail(string $email)
    {
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $query->bindValue(':email', $email, $pdo::PARAM_STR);
        $query->execute();
        $user = $query->fetch($pdo::FETCH_ASSOC);
        if ($user) {
            return User::createAndHydrate($user);;
        } else {
            return false;
        }
    }

    public function persist(User $user)
    {
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();
        
        if ($user->getIdUser() !== null) {
            $query = $pdo->prepare('UPDATE user SET first_name = :first_name, last_name = :last_name,  
                                                    email = :email, password = :password
                                                    WHERE id = :id'
                );
                $query->bindValue(':id', $user->getIdUser(), $pdo::PARAM_INT);

        } else {
            $query = $pdo->prepare('INSERT INTO user (first_name, last_name, email, password, role) 
                                                    VALUES (:first_name, :last_name, :email, :password, :role)'
            );
            $query->bindValue(':role', $user->getRole(), $pdo::PARAM_STR);

        }

        $query->bindValue(':first_name', $user->getFirstName(), $pdo::PARAM_STR);
        $query->bindValue(':last_name', $user->getLastName(), $pdo::PARAM_STR);
        $query->bindValue(':email', $user->getEmail(), $pdo::PARAM_STR);
        $query->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT), $pdo::PARAM_STR);

        return $query->execute();
    }

    public function delete(int $id): void
    {
        try{
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();
    
            $query = $pdo->prepare('DELETE FROM user WHERE id_user = :id');
            $query->bindValue(':id', $id, $pdo::PARAM_INT);
            $query->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }
    }
}