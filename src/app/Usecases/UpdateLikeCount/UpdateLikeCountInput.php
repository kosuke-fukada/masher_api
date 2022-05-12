<?php
declare(strict_types=1);

namespace App\Usecases\UpdateLikeCount;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Like\LikeIdentifier;
use App\Interfaces\Usecases\UpdateLikeCount\UpdateLikeCountInputPort;

class UpdateLikeCountInput implements UpdateLikeCountInputPort
{
    /**
     * @var LikeIdentifier
     */
    private LikeIdentifier $likeIdentifier;

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
     * @var LikeCount
     */
    private LikeCount $likeCount;

    /**
     * @param LikeIdentifier $likeIdentifier
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AccountId $accountId
     * @param LikeCount $likeCount
     */
    public function __construct(
        LikeIdentifier $likeIdentifier,
        UserId $userId,
        TweetId $tweetId,
        AccountId $accountId,
        LikeCount $likeCount
    )
    {
        $this->likeIdentifier = $likeIdentifier;
        $this->userId = $userId;
        $this->tweetId = $tweetId;
        $this->accountId = $accountId;
        $this->likeCount = $likeCount;
    }

    /**
     * @return LikeIdentifier
     */
    public function likeIdentifier(): LikeIdentifier
    {
        return $this->likeIdentifier;
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

    /**
     * @return LikeCount
     */
    public function likeCount(): LikeCount
    {
        return $this->likeCount;
    }
}
