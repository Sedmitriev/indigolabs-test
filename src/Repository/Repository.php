<?php

declare(strict_types=1);

namespace App\Repository;


use App\DBConnection;

class Repository
{
    /**
     * RepositoryAbstract constructor.
     */
    public function __construct(protected DBConnection $dbConn)
    {
        $this->dbConn->initConnection();
    }

    /**
     * @return DBConnection
     */
    public function getConnection(): DBConnection
    {
        return $this->dbConn;
    }
}
