<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

enum OauthProviderName: string
{
    case TWITTER = 'twitter';
}
