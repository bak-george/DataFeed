<?php

namespace app\commands;


use app\file\OptionsValidation;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class DataFeedCommand extends Command
{
    protected static $defaultName = 'dataFeed';
    protected static string $helpMsg = '';

    protected static array $descriptions = [
        'app'        => 'A task about importing files and saving them into different kinds of data storages.',
        'fileOption' => 'The name of the imported file. Please make sure to include it to folder "inputFiles"',
        'pushTo'     => 'Type of storage we push the data'

    ];
    protected static array $errorMessages  = [
        'fileType' => "Invalid file extension. Please use 'daily' or 'weekly'.",
        'script'   => "Error executing the script: "
    ];
    protected function configure(): void
    {
        $this->setName(self::$defaultName)
            ->setDescription(self::$descriptions['app'])
            ->setHelp(self::$helpMsg)
            ->addOption('file', '-f',InputArgument::OPTIONAL, self::$descriptions['fileOption'])
            ->addOption('pushTo', '-p',InputArgument::OPTIONAL, self::$descriptions['pushTo'], 'database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $input->getOption('file');
        $pushTo   = $input->getOption('pushTo');

        $fileExtension = OptionsValidation::checkExtension($filename);

        if ($fileExtension && OptionsValidation::checkPushToType($pushTo)) {
            $scriptPath = __DIR__ . '/../file/' . $fileExtension .  '/';
            $commandBuild = ['php', 'import.php', '--file', $filename, '--pushTo', $pushTo];
            $importScript = new Process($commandBuild, $scriptPath);

            $importScript->run();

            if (!$importScript->isSuccessful()) {
                // Log an error if the script execution fails
                self::$errorMessages['script'] .= $importScript->getErrorOutput();

                $output->writeln("<error>" . self::$errorMessages['script'] .  "</error>");
                return Command::FAILURE;
            } else {
                $output->writeln("<info>" . $fileExtension ." file has successfully imported to database</info>");
            }
        } else {
            //log error to a file
            $output->writeln("<error>" . self::$errorMessages['fileExtensions'] . "</error>");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
