<?php
declare(strict_types=1);

namespace App\Usecases\Like\GetLikeCount;

use App\ValueObjects\Tweet\TweetId;
use App\Interfaces\Usecases\Like\GetLikeCount\GetLikeCountInputPort;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\User\UserId;

class GetLikeCountInput implements GetLikeCountInputPort
{
    /**
     * @var UserId
     */
    private UserId $userId;

    /**
     * @var TweetId
     */
    private TweetId $tweetId;

    /**
     * @var AccountId
     */
    private AccountId $authorId;

    /**
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AccountId $authorId
     */
    public function __construct(
        UserId $userId,
        TweetId $tweetId,
        AccountId $authorId
    )
    {
        $this->userId = $userId;
        $this->tweetId = $tweetId;
        $this->authorId = $authorId;
    }

    /**
     * @return UserId
     */
    public function userId(): UserId
    {
        return $this->userId;
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
}
