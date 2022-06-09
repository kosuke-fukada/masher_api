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
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param UserName $authorName
     * @return Tweet
     */
    public function createTweet(
        TweetId $tweetId,
        AuthorId $authorId,
        UserName $authorName
    ): Tweet
    {
        return new Tweet(
            $tweetId,
            $authorId,
            $authorName
        );
    }
}
