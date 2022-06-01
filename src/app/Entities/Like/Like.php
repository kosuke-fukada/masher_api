<?php
declare(strict_types=1);

namespace App\Entities\Like;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Like\LikeIdentifier;

class Like
{
    /**
     * @var LikeIdentifier|null
     */
    private ?LikeIdentifier $likeIdentifier;

    /**
     * @var UserId
     */
    private UserId $userId;

    /**
     * @var TweetId
     */
    private TweetId $tweetId;

    /**
     * @var AuthorId
     */
    private AuthorId $authorId;

    /**
     * @var LikeCount
     */
    private LikeCount $likeCount;

    /**
     * @param LikeIdentifier|null $likeIdentifier
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param LikeCount $likeCount
     */
    public function __construct(
        ?LikeIdentifier $likeIdentifier,
        UserId $userId,
        TweetId $tweetId,
        AuthorId $authorId,
        LikeCount $likeCount
    )
    {
        $this->likeIdentifier = $likeIdentifier;
        $this->userId = $userId;
        $this->tweetId = $tweetId;
        $this->authorId = $authorId;
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
     * @return AuthorId
     */
    public function authorId(): AuthorId
    {
        return $this->authorId;
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
            'id' => $this->likeIdentifier()->toInt(),
            'user_id' => $this->userId()->toInt(),
            'tweet_id' => (string)$this->tweetId(),
            'author_id' => (string)$this->authorId(),
            'like_count' => $this->likeCount()->toInt(),
        ];
    }
}
