<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Like\UpdateLikeCount;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Like\LikeIdentifier;

interface UpdateLikeCountInputPort
{
    /**
     * @return LikeIdentifier
     */
    public function likeIdentifier(): LikeIdentifier;

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
    public function accountId(): AccountId;

    /**
     * @return LikeCount
     */
    public function likeCount(): LikeCount;
}
