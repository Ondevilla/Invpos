<?php

namespace App\Classes;

use Log;


class Common
{
    public static function generateExceptionArray($e) {
        $array = array(
            'message'          => $e->getMessage(),
            'lineError'        => $e->getLine(),
            'errorCode'        => isset($e->errorInfo[1]) ? $e->errorInfo[1] : null,
            'exceptionDetails' => $e,
        );

        Log::debug($array);

        return $array;
    }
}
