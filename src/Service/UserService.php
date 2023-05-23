<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Model\Sender;
use App\Repository\AuthHistoryRepository;
use App\Repository\UserRepository;

class UserService
{

    public function __construct(
        private UserRepository $userRepository,
        private AuthHistoryRepository $authHistoryRepository
    )
    {
    }

    public function getUserUrl(Sender $sender): string
    {
        $user = $this->userRepository->findById($sender->getId());
        if (!$user) {
            $uuid = $this->userRepository->generateUuid();
            $user = new User();
            $user
                ->setId($sender->getId())
                ->setUuid($uuid)
                ->setIsRegistered(false)
                ->setFirstName($sender->getFirstName())
                ->setLastName($sender->getLastName())
                ->setUsername($sender->getUsername())
                ->setLanguageCode($sender->getLanguageCode())
                ->setIsBot($sender->isBot());

            $this->userRepository->insert($user);
        }
        if ($user->isRegistered()) {

            return $_ENV['BASE_URL'] . '/sign-in/' . $user->getUuid();
        }

        return $_ENV['BASE_URL'] . '/sign-up/' . $user->getUuid();
    }

    public function signUpByUuid(string $uuid): bool
    {
        $user = $this->userRepository->findByUuid($uuid);
        if (!$user) {

            return false;
        }
        try {
            $uuid = $this->userRepository->generateUuid();
            $user->setUuid($uuid);
            $user->setIsRegistered(true);
            $this->userRepository->update($user);
            $this->authHistoryRepository->insert($user);
        } catch (\Exception) {

            return false;
        }

        return true;
    }

    public function signInByUuid(string $uuid): bool
    {
        $user = $this->userRepository->findByUuid($uuid);
        if (!$user) {

            return false;
        }
        try {
            $uuid = $this->userRepository->generateUuid();
            $user->setUuid($uuid);
            $this->userRepository->update($user);
            $this->authHistoryRepository->update($user);
        } catch (\Exception) {

            return false;
        }

        return true;
    }
}
