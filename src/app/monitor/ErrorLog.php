<?php

namespace app\monitor;

use Exception;

class ErrorLog
{
    private string $logDirectory;

    public function __construct(string $logDirectory)
    {
        $this->logDirectory = $logDirectory;
    }

    public function writeLog($message)
    {
        if (!is_dir($this->logDirectory)) {
            throw new Exception("Log directory does not exist: {$this->logDirectory}");
        }

        $timestamp = date('Y-m-d_H-i-s');
        $logFileName = $this->logDirectory . '/error_log_' . $timestamp . '.txt';
        $logMessage = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;


        file_put_contents($logFileName, $logMessage, FILE_APPEND | LOCK_EX);
    }
}