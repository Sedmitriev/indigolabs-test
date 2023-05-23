<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;

class UserRepository extends Repository
{
    public function findById(int $id): ?User
    {
        $sql = 'SELECT * FROM public.user WHERE id = '. $id;
        $user = $this->dbConn->query($sql);

        return $user ? $this->createObject($user) : null;
    }

    public function findByUuid(string $uuid): ?User
    {
        $sql = "SELECT * FROM public.user WHERE uuid = '".$uuid."'";
        $user = $this->dbConn->query($sql);

        return $user ? $this->createObject($user) : null;
    }

    public function insert(User &$user)
    {
        $sql = 'INSERT INTO public.user (id,uuid,first_name,last_name,username,is_bot,language_code,is_registered)'
            .' VALUES(:id, :uuid, :first_name, :last_name, :username, :is_bot, :language_code, :is_registered)';
        $stmt = $this->dbConn->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $user->getId());
        $stmt->bindValue(':uuid', $user->getUuid(), \PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $user->getFirstName(), \PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $user->getLastName(), \PDO::PARAM_STR);
        $stmt->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
        $stmt->bindValue(':is_bot', $user->isBot(), \PDO::PARAM_BOOL);
        $stmt->bindValue(':language_code', $user->getLanguageCode(), \PDO::PARAM_STR);
        $stmt->bindValue(':is_registered', $user->isRegistered(), \PDO::PARAM_BOOL);

        $stmt->execute();
    }

    public function update(User &$user)
    {
        $sql = 'UPDATE public.user SET uuid=:uuid,first_name=:first_name,last_name=:last_name,username=:username,is_bot=:is_bot,language_code=:language_code,is_registered=:is_registered'
            .' WHERE id = :id';
        $stmt = $this->dbConn->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $user->getId());
        $stmt->bindValue(':uuid', $user->getUuid(), \PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $user->getFirstName(), \PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $user->getLastName(), \PDO::PARAM_STR);
        $stmt->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
        $stmt->bindValue(':is_bot', $user->isBot(), \PDO::PARAM_BOOL);
        $stmt->bindValue(':language_code', $user->getLanguageCode(), \PDO::PARAM_STR);
        $stmt->bindValue(':is_registered', $user->isRegistered(), \PDO::PARAM_BOOL);

        $stmt->execute();
    }

    private function createObject(array $user): User
    {
        $userEntity = new User();
        $userEntity
            ->setId($user['id'])
            ->setUuid($user['uuid'])
            ->setFirstName($user['first_name'])
            ->setLastName($user['last_name'])
            ->setUsername($user['username'])
            ->setIsBot($user['is_bot'])
            ->setLanguageCode($user['language_code'])
            ->setIsRegistered($user['is_registered']);

        return $userEntity;
    }

    public function generateUuid()
    {
        $result = $this->dbConn->query('SELECT gen_random_uuid()');

        return $result ? $result['gen_random_uuid'] : random_bytes(36);
    }
}
