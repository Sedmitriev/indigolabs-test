<?php

declare(strict_types=1);

namespace App\Model;

class UpdatesResponse
{
    private bool $ok;

    private array $result;

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->ok;
    }

    /**
     * @param bool $ok
     * @return UpdatesResponse
     */
    public function setOk(bool $ok): UpdatesResponse
    {
        $this->ok = $ok;
        return $this;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * @param array $result
     * @return UpdatesResponse
     */
    public function setResult(array $result): UpdatesResponse
    {
        $this->result = $result;
        return $this;
    }
}
