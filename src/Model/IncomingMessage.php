<?php

declare(strict_types=1);

namespace App\Model;

class IncomingMessage
{
    private int $id;
    private Sender $from;
    private int $date;
    private ?string $text = null;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return IncomingMessage
     */
    public function setId(int $id): IncomingMessage
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Sender
     */
    public function getFrom(): Sender
    {
        return $this->from;
    }

    /**
     * @param Sender $from
     * @return IncomingMessage
     */
    public function setFrom(Sender $from): IncomingMessage
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * @param int $date
     * @return IncomingMessage
     */
    public function setDate(int $date): IncomingMessage
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return IncomingMessage
     */
    public function setText(?string $text): IncomingMessage
    {
        $this->text = $text;
        return $this;
    }

}
