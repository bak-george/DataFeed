<?php

namespace app\file;
class ValidFileExtensions
{
    protected static array $extensions = ["xml"];

    public static function checkExtension($fileName)
    {
        $fileInfo = pathinfo($fileName);
        $fileExtension = $fileInfo['extension'];

        if (in_array($fileExtension, self::$extensions)) {
            return $fileExtension;
        } else {
            return false;
        }
    }
}