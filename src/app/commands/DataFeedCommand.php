<?php

namespace app\commands;


use app\file\OptionsValidation;
use app\monitor\ErrorLog;
use Exception;
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

    protected function configure(): void
    {
        $this->setName(self::$defaultName)
            ->setDescription(self::$descriptions['app'])
            ->setHelp(self::$helpMsg)
            ->addOption('file', '-f',InputArgument::OPTIONAL, self::$descriptions['fileOption'])
            ->addOption('pushTo', '-p',InputArgument::OPTIONAL, self::$descriptions['pushTo']);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $filename = strtolower($input->getOption('file'));
            $pushTo   = strtolower($input->getOption('pushTo'));

            OptionsValidation::checkValues($filename, $pushTo);
            OptionsValidation::checkPushToType($pushTo);
            $fileExtension = OptionsValidation::checkExtension($filename);


            $scriptPath = __DIR__ . '/../file/' . $fileExtension .  '/';
            $commandBuild = ['php', 'import.php', '--file', $filename, '--pushTo', $pushTo];
            $importScript = new Process($commandBuild, $scriptPath);

            $importScript->run();

            if ($importScript->isSuccessful()) {
                $msg = "<info>" . $fileExtension ." file has successfully imported</info>" . PHP_EOL;

                switch ($pushTo) {
                    case 'database':
                        $msg .= "<info>Check the imported data: SELECT * FROM products WHERE file_name = '" . $filename . "'" . "<info>";
                        break;
                    case 'json':
                        $msg .= "<info>Check outputFiles/JSON to see the imported file.<info>";
                        break;
                }

                $output->writeln($msg);
                return Command::SUCCESS;
            } else {
                throw new Exception('Import Script failed');
            }
        } catch (Exception $e) {
            $logDirectory = dirname(__DIR__, 3) . '/outputFiles/errorLogs';
            $logFile = new ErrorLog($logDirectory);
            $logFile->writeLog('Error: ' . $e->getMessage());

            $output->writeln("<error>" . 'Error: ' . $e->getMessage() . "</error>");
            return Command::FAILURE;
        }
    }
}
