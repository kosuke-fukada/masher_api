<?php
declare(strict_types=1);

namespace App\ValueObjects\Shared;

enum OrderValue: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}
