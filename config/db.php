<?php

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__, 1) . '/.env');

return [
    'host' => $_ENV['DB_HOST'],
    'dbname' => $_ENV['DB_NAME'],
    'user'  => $_ENV['DB_USER'],
    'port' => $_ENV['DB_PORT'],
    'charset' => $_ENV['DB_CHARSET'],
    'driver' => $_ENV['DB_DRIVER'],
];
