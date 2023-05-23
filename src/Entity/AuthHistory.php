<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;

class AuthHistory
{
    private int $id;

    private User $user;

    private DateTime $lastAuthAt;

    private DateTime $createdAt;
}
