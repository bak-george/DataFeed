<?php

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

use app\file\xml\XMLFile;

$options  = getopt('', ['file:', 'pushTo:']);
$fileName = (string) $options['file'];
$pushTo   = (string) $options['pushTo'];

$file = new XMLFile();

//chmod($filePath, 0755);
$products = $file->decoding($fileName);
$file->pushData($products, $pushTo);
