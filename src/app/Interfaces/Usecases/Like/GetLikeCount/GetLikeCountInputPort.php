<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Like\GetLikeCount;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorId;

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
     * @return AuthorId
     */
    public function authorId(): AuthorId;
}
