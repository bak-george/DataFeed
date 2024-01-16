<?php

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

use App\app\file\json\JSONFILE;
use app\monitor\ErrorLog;

$options  = getopt('', ['file:', 'pushTo:']);
$fileName = (string) $options['file'];
$pushTo   = (string) $options['pushTo'];
$logDirectory = dirname(__DIR__, 4) . '/outputFiles/errorLogs';
$logFile      = new ErrorLog($logDirectory);

try {
    $file = new JSONFILE();
    $products = $file->decoding($fileName);

    $file->pushData($products, $pushTo);
} catch (Exception $e) {
    $logFile->writeLog('Error: ' . $e->getMessage());

    exit('Error: ' . $e->getMessage());
}
