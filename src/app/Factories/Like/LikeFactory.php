<?php
declare(strict_types=1);

namespace App\Factories\Like;

use App\Entities\Like\Like;
use App\Interfaces\Factories\Like\LikeFactoryInterface;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;

class LikeFactory implements LikeFactoryInterface
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
    ): Like
    {
        return new Like(
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($accountId),
            new LikeCount($likeCount)
        );
    }
}
