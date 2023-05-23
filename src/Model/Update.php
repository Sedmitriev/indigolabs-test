<?php

declare(strict_types=1);

namespace App\Model;

class Update
{
    private int $updateId;

    private ?IncomingMessage $message = null;

    /**
     * @return int
     */
    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    /**
     * @param int $updateId
     * @return Update
     */
    public function setUpdateId(int $updateId): Update
    {
        $this->updateId = $updateId;
        return $this;
    }

    /**
     * @return IncomingMessage|null
     */
    public function getMessage(): ?IncomingMessage
    {
        return $this->message;
    }

    /**
     * @param IncomingMessage|null $message
     * @return Update
     */
    public function setMessage(?IncomingMessage $message): Update
    {
        $this->message = $message;
        return $this;
    }

}
