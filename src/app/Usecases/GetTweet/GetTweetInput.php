<?php
declare(strict_types=1);

namespace App\Usecases\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorName;
use App\Interfaces\Usecases\GetTweet\GetTweetInputPort;

class GetTweetInput implements GetTweetInputPort
{
    /**
     * @var TweetId
     */
    private TweetId $tweetId;

    /**
     * @var AuthorName
     */
    private AuthorName $authorName;

    /**
     * @param TweetId $tweetId
     * @param AuthorName $authorName
     */
    public function __construct(
        TweetId $tweetId,
        AuthorName $authorName
    )
    {
        $this->tweetId = $tweetId;
        $this->authorName = $authorName;
    }

    /**
     * @return TweetId
     */
    public function tweetId(): TweetId
    {
        return $this->tweetId;
    }

    /**
     * @return AuthorName
     */
    public function authorName(): AuthorName
    {
        return $this->authorName;
    }
}
