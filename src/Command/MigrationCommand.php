<?php

declare(strict_types=1);

namespace App\Command;

use App\DBConnection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MigrationCommand extends Command
{
    public function __construct(private DBConnection $dbConn)
    {
        $this->dbConn->initConnection();
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:migrate')
            ->addArgument('name', InputOption::VALUE_REQUIRED, 'Имя файла миграции')
            ->setDescription('Применение миграции');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $outputStyle = new SymfonyStyle($input, $output);
        $filename = $input->getArgument('name');
        try {
            $sql = file_get_contents(__DIR__.'/../../migrations/'.$filename.'.sql');
            $this->dbConn->exec($sql);
        } catch (\Exception $exception) {
            $outputStyle->error($exception->getMessage());

            return Command::FAILURE;
        }

        $outputStyle->success('Migration executed');

        return Command::SUCCESS;
    }
}
