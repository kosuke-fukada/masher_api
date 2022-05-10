<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\GetTweet;

use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Tweet\AuthorName;
use App\ValueObjects\Tweet\TweetId;

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
     * @return AuthorName
     */
    public function authorName(): AuthorName;
}
