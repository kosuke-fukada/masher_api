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
    private AccountId $accountId;

    /**
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AccountId $accountId
     */
    public function __construct(
        UserId $userId,
        TweetId $tweetId,
        AccountId $accountId
    )
    {
        $this->userId = $userId;
        $this->tweetId = $tweetId;
        $this->accountId = $accountId;
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
    public function accountId(): AccountId
    {
        return $this->accountId;
    }
}
