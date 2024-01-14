<?php

namespace app\file;

use app\monitor\MissingParamsException;
use Exception;


class OptionsValidation
{
    protected static array $extensions = ["xml"];
    protected static array $pushToTypes = ["database"];

    public static function checkExtension($fileName)
    {
        $fileInfo = pathinfo($fileName);
        $fileExtension = $fileInfo['extension'];

        if (in_array($fileExtension, self::$extensions)) {
            return $fileExtension;
        } else {
            throw new Exception('Wrong valid file type. Valid types: ' . implode(',', self::$extensions));
        }
    }

    public static function checkPushToType($pushTo)
    {
        if (in_array($pushTo, self::$pushToTypes)) {
            return true;
        } else {
            throw new Exception('Data storage unavailable. Valid storages: ' . implode(',', self::$pushToTypes));
        }
    }

    public static function checkValues($fileName, $pushTo) {
        if (empty($fileName) || empty($pushTo)) {
            throw new MissingParamsException();
        }
    }
}
