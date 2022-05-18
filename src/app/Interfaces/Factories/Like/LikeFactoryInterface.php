<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\Like;

use App\Entities\Like\Like;

interface LikeFactoryInterface
{
    /**
     * @param integer $userId
     * @param string $tweetId
     * @param string $authorId
     * @param integer $likeCount
     * @return Like
     */
    public function createLike(
        int $userId,
        string $tweetId,
        string $authorId,
        int $likeCount
    ): Like;
}
