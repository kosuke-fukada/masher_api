<?php
declare(strict_types=1);

namespace App\Usecases\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorName;
use App\Interfaces\Usecases\GetTweet\GetTweetInputPort;
use App\ValueObjects\Tweet\AuthorId;

class GetTweetInput implements GetTweetInputPort
{
    /**
     * @var TweetId
     */
    private TweetId $tweetId;

    /**
     * @var AuthorId
     */
    private AuthorId $authorId;

    /**
     * @var AuthorName
     */
    private AuthorName $authorName;

    /**
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param AuthorName $authorName
     */
    public function __construct(
        TweetId $tweetId,
        AuthorId $authorId,
        AuthorName $authorName
    )
    {
        $this->tweetId = $tweetId;
        $this->authorId = $authorId;
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
     * @return AuthorId
     */
    public function authorId(): AuthorId
    {
        return $this->authorId;
    }

    /**
     * @return AuthorName
     */
    public function authorName(): AuthorName
    {
        return $this->authorName;
    }
}
