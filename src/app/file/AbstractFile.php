<?php

namespace app\file;

class AbstractFile implements FileInterface
{
    protected $fileName;
    protected $filePath;

    protected $path;

    final public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    final public function setFilePath($fileName)
    {
       $this->path = dirname(__DIR__, 3) . '/inputFiles/' . $fileName;
       if (file_exists($this->path)) {
           return $this;
       } else {
           return false;
           //register error
       }
    }

    final public function getFilePath()
    {
        return $this->path;
    }
}