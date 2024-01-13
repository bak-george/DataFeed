<?php

require_once dirname(__DIR__, 4) . '/vendor/autoload.php';

use app\file\xml\XMLFile;

$options = getopt('', ['file:']);
$fileName = (string) $options['file'];

$file = new XMLFile();

//chmod($filePath, 0755);
$test = $file->decoding($fileName);

var_dump($test);
