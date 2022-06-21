<?php
declare(strict_types=1);

namespace App\ValueObjects\Shared;

enum OrderKey: string
{
    case ID = 'id';
    case LIKE_COUNT = 'like_count';
    case UPDATED_AT = 'updated_at';
}
