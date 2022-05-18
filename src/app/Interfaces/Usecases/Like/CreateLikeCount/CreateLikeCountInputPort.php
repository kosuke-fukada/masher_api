<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Like\CreateLikeCount;

use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;

interface CreateLikeCountInputPort
{
    /**
     * @return LikeIdentifier|null
     */
    public function likeIdentifier(): ?LikeIdentifier;

    /**
     * @return UserId
     */
    public function userId(): UserId;

    /**
     * @return TweetId
     */
    public function tweetId(): TweetId;

    /**
     * @return AccountId
     */
    public function authorId(): AccountId;

    /**
     * @return LikeCount
     */
    public function likeCount(): LikeCount;
}
