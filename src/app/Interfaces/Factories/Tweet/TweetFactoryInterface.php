<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\Tweet;

use App\Entities\Tweet\Tweet;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Tweet\TweetId;

interface TweetFactoryInterface
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
    ): Tweet;
}
