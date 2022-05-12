<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Tweet\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Shared\AccountId;

interface GetTweetInputPort
{
    /**
     * @return TweetId
     */
    public function tweetId(): TweetId;

    /**
     * @return AccountId
     */
    public function accountId(): AccountId;

    /**
     * @return UserName
     */
    public function userName(): UserName;
}
