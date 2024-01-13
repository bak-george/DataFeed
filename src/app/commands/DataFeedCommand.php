<?php

namespace app\commands;

use app\file\ValidFileExtensions;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class DataFeedCommand extends Command
{
    protected static string $defaultName = 'app:dataFeed';
    protected static string $appDescription = 'A task about importing files and saving them into different kinds of data storages.';
    protected static string $helpMsg = '';
    protected static string $fileDescription = 'The name of the imported file. Please make sure to include it to folder "inputFiles"';

    protected static array $errorMessages  = [
        'fileType' => "Invalid file extension. Please use 'daily' or 'weekly'."
    ];
    protected function configure(): void
    {
        $this->setName(self::$defaultName)
            ->setDescription(self::$appDescription)
            ->setHelp(self::$helpMsg)
            ->addArgument('file', InputArgument::OPTIONAL, self::$fileDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $input->getArgument('file');

        $fileExtension = ValidFileExtensions::checkExtension($filename);

        if ($fileExtension) {
            $scriptPath = __DIR__ . '/../file/' . $fileExtension .  '/';
            $commandBuild = ['php', 'import.php', '--file', $filename];
            $importScript = new Process($commandBuild, $scriptPath);

            $importScript->run();

            if (!$importScript->isSuccessful()) {
                // Log an error if the script execution fails
                $output->writeln("<error>Error executing the script: {$importScript->getErrorOutput()}</error>");
                return Command::FAILURE;
            }
        } else {
            //log error to a file
            $output->writeln("<error>" . self::$errorMessages['fileExtensions'] . "</error>");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}