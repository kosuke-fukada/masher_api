<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\Like;

use App\Entities\Like\Like;

interface LikeFactoryInterface
{
    /**
     * @param integer $userId
     * @param string $tweetId
     * @param string $accountId
     * @param integer $likeCount
     * @return Like
     */
    public function createLike(
        int $userId,
        string $tweetId,
        string $accountId,
        int $likeCount
    ): Like;
}
