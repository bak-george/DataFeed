<?php

namespace app\file;

class AbstractFile implements FileInterface
{
    protected $fileName;

    final public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }
}