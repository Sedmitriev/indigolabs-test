<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Update;
use App\Model\UpdatesResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TelegramService
{
    public function __construct(
        private HttpClientInterface $telegramBotApiClient,
        private SerializerInterface $serializer
    )
    {
    }

    public function getUpdates(int $offset, int $limit)
    {
        $updates = [];
        $response = $this->telegramBotApiClient->request('GET', 'getUpdates', [
            'query' => [
                'offset' => $offset,
                'limit' => $limit
            ]
        ]);
        /** @var UpdatesResponse $updatesResponse */
        $updatesResponse = $this->serializer->deserialize(
            $response->getContent(),
            UpdatesResponse::class,
            'json'
        );
        if (!$updatesResponse->isOk()) {

            return [];
        }
        foreach ($updatesResponse->getResult() as $updateArr) {
            $update = $this->serializer->deserialize(
                json_encode($updateArr),
                Update::class,
                'json'
            );
            $updates[] = $update;
        }

        return $updates;
    }

    public function sendMessage(int $userId, string $message)
    {
        $this->telegramBotApiClient->request('GET', 'sendMessage', [
            'query' => [
                'chat_id' => $userId,
                'text' => $message
            ]
        ]);
    }
}
