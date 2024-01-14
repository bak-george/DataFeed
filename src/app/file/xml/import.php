<?php

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

use app\file\xml\XMLFile;
use app\monitor\ErrorLog;
use Symfony\Component\Console\Command\Command;

$options  = getopt('', ['file:', 'pushTo:']);
$fileName = (string) $options['file'];
$pushTo   = (string) $options['pushTo'];

try {
$file = new XMLFile();

//chmod($filePath, 0755);
$products = $file->decoding($fileName);

var_dump($products['item'][0]);

$file->pushData($products, $pushTo);
} catch (Exception $e) {
    $logDirectory = dirname(__DIR__, 4) . '/outputFiles/errorLogs';
    $logFile = new ErrorLog($logDirectory);
    $logFile->writeLog('Error: ' . $e->getMessage());

    exit(1);
}