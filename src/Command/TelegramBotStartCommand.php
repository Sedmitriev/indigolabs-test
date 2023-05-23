<?php

declare(strict_types=1);

namespace App\Command;

use App\Model\Update;
use App\Service\TelegramService;
use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TelegramBotStartCommand extends Command
{

    public function __construct(
        private TelegramService $telegramService,
        private UserService $userService
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:telegram-bot:start')
            ->setDescription('Запуск телеграм бота');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Start listening');
        $offset = 1;
        try {
            while ($offset) {
                $updates = $this->telegramService->getUpdates($offset, 5);
                if (empty($updates)) {
                    sleep(1);
                    continue;
                }
                /** @var Update $update */
                foreach ($updates as $update) {
                    if (!$update->getMessage()) {
                        continue;
                    }
                    $textMessage = $update->getMessage()->getText();
                    if ($textMessage === '/start') {
                        $url = $this->userService->getUserUrl($update->getMessage()->getFrom());
                        $this->telegramService->sendMessage($update->getMessage()->getFrom()->getId(), $url);
                    }
                }
                $offset = $updates[count($updates)-1]->getUpdateId() + 1;
            }
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
