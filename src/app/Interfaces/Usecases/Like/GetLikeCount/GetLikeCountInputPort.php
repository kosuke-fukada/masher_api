<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Like\GetLikeCount;

use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;

interface GetLikeCountInputPort
{
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
}
