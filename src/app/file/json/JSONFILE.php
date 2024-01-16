<?php

namespace App\app\file\json;


use App\app\file\AbstractFile;

class JSONFILE extends AbstractFile
{
    public function decoding($fileName)
    {
        $this->setFileName($fileName);
        $this->setFilePath($fileName);

        $jsonContent = file_get_contents($this->getFilePath());

        return json_decode($jsonContent, true);
    }

    public function pushData($data, $storageType)
    {
        if ($storageType == "database") {
            $this->pushToMySQL($data);
        } else {
            throw new \Exception('Failed to push data into ' . $storageType  . ' storage');
        }
    }
}