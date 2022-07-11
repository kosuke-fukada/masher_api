<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Tweet\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\User\AccessToken;

interface GetTweetInputPort
{
    /**
     * @return TweetId
     */
    public function tweetId(): TweetId;

    /**
     * @return AuthorId
     */
    public function authorId(): AuthorId;

    /**
     * @return UserName
     */
    public function authorName(): UserName;

    /**
     * @return AccessToken
     */
    public function accessToken(): AccessToken;
}
