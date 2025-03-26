<?php

namespace App\Exceptions;

use Exception;

class ApplicationException extends Exception
{

    public static function notFound($message = 'По вашему запросу ничего не найдено')
    {
        return self::init($message, 404);

    }

    public static function init(string $message, int $code = 500)
    {
        return new self($message, $code);
    }

}
