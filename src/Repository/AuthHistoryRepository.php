<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;

class AuthHistoryRepository extends Repository
{
    public function insert(User &$user)
    {
        $sql = 'INSERT INTO public.auth_history (user_id,last_auth_at,created_at)'
            .' VALUES (:user_id, current_timestamp, current_timestamp)';
        $stmt = $this->dbConn->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $user->getId());

        $stmt->execute();
    }

    public function update(User &$user)
    {
        $sql = 'UPDATE public.auth_history SET last_auth_at = current_timestamp'
            .' WHERE user_id = :user_id';
        $stmt = $this->dbConn->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $user->getId());

        $stmt->execute();
    }
}
