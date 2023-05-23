<?php

declare(strict_types=1);

namespace App\Command;

use PDO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class InstallCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('app:install')
            ->setDescription('Создание БД');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $outputStyle = new SymfonyStyle($input, $output);
        $dsn = 'pgsql:host=indigolabs_test.db;port=5432;dbname=postgres';
        try {
            $pdo = new PDO($dsn, $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
            $pdo->exec('CREATE DATABASE indigolabs_test;');
        } catch (\Exception $exception) {
            $outputStyle->error($exception->getMessage());

            return Command::FAILURE;
        }

        $outputStyle->success('Database is created');

        return Command::SUCCESS;
    }
}
