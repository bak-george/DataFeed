<?php

namespace app\file;
interface FileInterface
{
    public function setFileName($fileName);

    public function setFilePath($fileName);

    public function getFilePath();
}