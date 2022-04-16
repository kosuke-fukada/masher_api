<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class ExceptionBaseClass extends Exception
{
    public const STATUS_CODE_OK = 200;
    public const STATUS_CODE_NO_CONTENT = 204;
    public const STATUS_CODE_BAD_REQUEST = 400;
    public const STATUS_CODE_FORBIDDEN = 403;
    public const STATUS_CODE_NOT_FOUND = 404;
    public const STATUS_CODE_INTERNAL_SERVER_ERROR = 500;
}
