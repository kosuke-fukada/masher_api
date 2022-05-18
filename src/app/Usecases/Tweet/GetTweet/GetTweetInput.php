<?php
declare(strict_types=1);

namespace App\Usecases\Tweet\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Shared\AccountId;
use App\Interfaces\Usecases\Tweet\GetTweet\GetTweetInputPort;

class GetTweetInput implements GetTweetInputPort
{
    /**
     * @var TweetId
     */
    private TweetId $tweetId;

    /**
     * @var AccountId
     */
    private AccountId $authorId;

    /**
     * @var UserName
     */
    private UserName $authorName;

    /**
     * @param TweetId $tweetId
     * @param AccountId $authorId
     * @param UserName $authorName
     */
    public function __construct(
        TweetId $tweetId,
        AccountId $authorId,
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
     * @return AccountId
     */
    public function authorId(): AccountId
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
