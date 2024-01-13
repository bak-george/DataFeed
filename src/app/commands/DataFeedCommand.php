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
    protected static $defaultName = 'dataFeed';
    protected static string $appDescription = 'A task about importing files and saving them into different kinds of data storages.';
    protected static string $helpMsg = '';
    protected static string $fileDescription = 'The name of the imported file. Please make sure to include it to folder "inputFiles"';

    protected static array $errorMessages  = [
        'fileType' => "Invalid file extension. Please use 'daily' or 'weekly'.",
        'script'   => "Error executing the script: "
    ];
    protected function configure(): void
    {
        $this->setName(self::$defaultName)
            ->setDescription(self::$appDescription)
            ->setHelp(self::$helpMsg)
            ->addOption('file', '-f',InputArgument::OPTIONAL, self::$fileDescription, 'feed.xml')
            ->addOption('whereToPush', '-p',InputArgument::OPTIONAL, 'Type of storage we push the data', 'database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $input->getOption('file');
        $pushTo   = $input->getOption('whereToPush');

        var_dump($filename);
        var_dump($pushTo);

        $fileExtension = ValidFileExtensions::checkExtension($filename);

        if ($fileExtension) {
            $scriptPath = __DIR__ . '/../file/' . $fileExtension .  '/';
            $commandBuild = ['php', 'import.php', '--file', $filename, '--pushTo', $pushTo];
            $importScript = new Process($commandBuild, $scriptPath);

            $importScript->run();

            if (!$importScript->isSuccessful()) {
                // Log an error if the script execution fails
                self::$errorMessages['script'] .= $importScript->getErrorOutput();

                $output->writeln("<error>" . self::$errorMessages['script'] .  "</error>");
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
