<?php
declare(strict_types=1);

namespace App\Factories\Tweet;

use App\Entities\Tweet\Tweet;
use App\ValueObjects\Tweet\TweetId;
use App\Interfaces\Factories\Tweet\TweetFactoryInterface;
use App\ValueObjects\Tweet\AuthorName;

class TweetFactory implements TweetFactoryInterface
{
    /**
     * @param string $tweetId
     * @param string $authorName
     * @return Tweet
     */
    public function createTweet(
        string $tweetId,
        string $authorName
    ): Tweet
    {
        return new Tweet(
            new TweetId($tweetId),
            new AuthorName($authorName)
        );
    }
}
