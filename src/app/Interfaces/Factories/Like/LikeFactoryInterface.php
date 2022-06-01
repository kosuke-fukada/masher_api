<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\Like;

use App\Entities\Like\Like;
use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Like\LikeIdentifier;

interface LikeFactoryInterface
{
    /**
     * @param LikeIdentifier|null $likeIdentifier
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param LikeCount $likeCount
     * @return Like
     */
    public function createLike(
        ?LikeIdentifier $likeIdentifier,
        UserId $userId,
        TweetId $tweetId,
        AuthorId $authorId,
        LikeCount $likeCount
    ): Like;
}
