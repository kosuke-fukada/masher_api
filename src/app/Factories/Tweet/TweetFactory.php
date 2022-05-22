<?php
declare(strict_types=1);

namespace App\Factories\Tweet;

use App\Entities\Tweet\Tweet;
use App\ValueObjects\Tweet\TweetId;
use App\Interfaces\Factories\Tweet\TweetFactoryInterface;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Tweet\AuthorId;

class TweetFactory implements TweetFactoryInterface
{
    /**
     * @param string $tweetId
     * @param string $authorId
     * @param string $authorName
     * @return Tweet
     */
    public function createTweet(
        string $tweetId,
        string $authorId,
        string $authorName
    ): Tweet
    {
        return new Tweet(
            new TweetId($tweetId),
            new AuthorId($authorId),
            new UserName($authorName)
        );
    }
}
