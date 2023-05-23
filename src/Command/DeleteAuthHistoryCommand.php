<?php

declare(strict_types=1);

namespace App\Command;

use App\DBConnection;
use DateTime;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DeleteAuthHistoryCommand extends Command
{
    public function __construct(private DBConnection $dbConn)
    {
        $this->dbConn->initConnection();
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->setName('app:auth-history:delete')
            ->setDescription('Очистка истории регистрации/аутентификации');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $outputStyle = new SymfonyStyle($input, $output);
        $date = new DateTime('-31 day');
        try {
            $sql = 'DELETE FROM public.auth_history WHERE last_auth_at < :date';
            $stmt = $this->dbConn->getConnection()->prepare($sql);
            $stmt->bindValue(':date', $date->format('Y-m-d H:i:s'));
            $stmt->execute();
        } catch (\Exception $exception) {
            $outputStyle->error($exception->getMessage());

            return Command::FAILURE;
        }

        $outputStyle->success('Migration executed. History cleared.');

        return Command::SUCCESS;
    }
}
