<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\Tweet;

use App\Entities\Tweet\Tweet;

interface TweetFactoryInterface
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
    ): Tweet;
}
