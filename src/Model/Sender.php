<?php

declare(strict_types=1);

namespace App\Model;

class Sender
{
    private int $id;
    private bool $isBot;
    private string $firstName;
    private string $lastName;
    private string $username;
    private string $languageCode;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Sender
     */
    public function setId(int $id): Sender
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBot(): bool
    {
        return $this->isBot;
    }

    /**
     * @param bool $isBot
     * @return Sender
     */
    public function setIsBot(bool $isBot): Sender
    {
        $this->isBot = $isBot;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Sender
     */
    public function setFirstName(string $firstName): Sender
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Sender
     */
    public function setLastName(string $lastName): Sender
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Sender
     */
    public function setUsername(string $username): Sender
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    /**
     * @param string $languageCode
     * @return Sender
     */
    public function setLanguageCode(string $languageCode): Sender
    {
        $this->languageCode = $languageCode;
        return $this;
    }
}
