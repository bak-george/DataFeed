<?php

namespace app\file;
class OptionsValidation
{
    protected static array $extensions = ["xml"];
    protected static array $pushToType = ["database"];

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

    public static function checkPushToType($pushTo)
    {
        if (in_array($pushTo, self::$pushToType)) {
            return true;
        } else {
            return false;
        }
    }
}
