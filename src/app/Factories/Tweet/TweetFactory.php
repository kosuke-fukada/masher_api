<?php
declare(strict_types=1);

namespace App\Factories\Tweet;

use App\Entities\Tweet\Tweet;
use App\ValueObjects\Tweet\TweetId;
use App\Interfaces\Factories\Tweet\TweetFactoryInterface;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Shared\UserName;

class TweetFactory implements TweetFactoryInterface
{
    /**
     * @param string $tweetId
     * @param string $accountId
     * @param string $userName
     * @return Tweet
     */
    public function createTweet(
        string $tweetId,
        string $accountId,
        string $userName
    ): Tweet
    {
        return new Tweet(
            new TweetId($tweetId),
            new AccountId($accountId),
            new UserName($userName)
        );
    }
}
