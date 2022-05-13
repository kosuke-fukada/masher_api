<?php
declare(strict_types=1);

namespace App\Entities\Like;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Shared\AccountId;

class Like
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
     * Undocumented function
     *
     * @param LikeIdentifier $likeIdentifier
     * @return void
     */
    public function setLikeIdentifier(LikeIdentifier $likeIdentifier): void
    {
        $this->likeIdentifier = $likeIdentifier;
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

    /**
     * @param LikeCount $likeCount
     * @return void
     */
    public function updateLikeCount(LikeCount $likeCount): void
    {
        $this->likeCount = $likeCount;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => is_null($this->likeIdentifier()) ? null : $this->likeIdentifier()->toInt(),
            'user_id' => $this->userId()->toInt(),
            'tweet_id' => (string)$this->tweetId(),
            'author_id' => (string)$this->accountId(),
            'like_count' => $this->likeCount()->toInt(),
        ];
    }
}
