<?php
declare(strict_types=1);

namespace App\Usecases\Tweet\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Shared\UserName;
use App\Interfaces\Usecases\Tweet\GetTweet\GetTweetInputPort;

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
     * @var UserName
     */
    private UserName $authorName;

    /**
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param UserName $authorName
     */
    public function __construct(
        TweetId $tweetId,
        AuthorId $authorId,
        UserName $authorName
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
     * @return UserName
     */
    public function authorName(): UserName
    {
        return $this->authorName;
    }
}
