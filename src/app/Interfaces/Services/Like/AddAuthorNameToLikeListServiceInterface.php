<?php
declare(strict_types=1);

namespace App\Interfaces\Services\Like;

use Illuminate\Support\Collection;
use App\ValueObjects\User\AccessToken;

interface AddAuthorNameToLikeListServiceInterface
{
    /**
     * @param Collection $likeList
     * @param AccessToken $accessToken
     * @return array
     */
    public function process(Collection $likeList, AccessToken $accessToken): array;
}
