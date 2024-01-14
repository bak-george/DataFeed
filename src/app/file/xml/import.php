<?php

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

use app\file\xml\XMLFile;
use app\monitor\ErrorLog;

$options  = getopt('', ['file:', 'pushTo:']);
$fileName = (string) $options['file'];
$pushTo   = (string) $options['pushTo'];
$logDirectory = dirname(__DIR__, 4) . '/outputFiles/errorLogs';
$logFile      = new ErrorLog($logDirectory);

try {
    $file = new XMLFile();

    $products = $file->decoding($fileName);

    var_dump($products['item'][0]);

    $file->pushData($products, $pushTo);
} catch (Exception $e) {
    $logFile->writeLog('Error: ' . $e->getMessage());

    exit('Error: ' . $e->getMessage());
}
