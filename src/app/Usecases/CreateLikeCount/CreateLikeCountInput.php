<?php
declare(strict_types=1);

namespace App\Usecases\CreateLikeCount;

use App\Interfaces\Usecases\CreateLikeCount\CreateLikeCountInputPort;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;

class CreateLikeCountInput implements CreateLikeCountInputPort
{
    /**
     * @var LikeIdentifier|null
     */
    private ?LikeIdentifier $likeIdentifier = null;

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
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AccountId $accountId
     * @param LikeCount $likeCount
     */
    public function __construct(
        UserId $userId,
        TweetId $tweetId,
        AccountId $accountId,
        LikeCount $likeCount
    )
    {
        $this->userId = $userId;
        $this->tweetId = $tweetId;
        $this->accountId = $accountId;
        $this->likeCount = $likeCount;
    }

    /**
     * @return LikeIdentifier|null
     */
    public function likeIdentifier(): ?LikeIdentifier
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
