<?php
declare(strict_types=1);

namespace App\ValueObjects\Foundation;

enum StatusCode: int
{
    case STATUS_CODE_OK = 200;
    case STATUS_CODE_NO_CONTENT = 204;
    case STATUS_CODE_BAD_REQUEST = 400;
    case STATUS_CODE_FORBIDDEN = 403;
    case STATUS_CODE_NOT_FOUND = 404;
    case STATUS_CODE_INTERNAL_SERVER_ERROR = 500;
}
