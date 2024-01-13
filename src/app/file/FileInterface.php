<?php

namespace app\file;
interface FileInterface
{
    public function setFileName(string $fileName);

    public function setFilePath(string $fileName);

    public function getFilePath();

    public function decoding(string $fileName);

    public function pushToMySQL(array $data);
}