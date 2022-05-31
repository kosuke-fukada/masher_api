<?php
declare(strict_types=1);

namespace App\Usecases\Like\CreateLikeCount;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Like\LikeIdentifier;
use App\Interfaces\Usecases\Like\CreateLikeCount\CreateLikeCountInputPort;

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
     * @var AuthorId
     */
    private AuthorId $authorId;

    /**
     * @var LikeCount
     */
    private LikeCount $likeCount;

    /**
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param LikeCount $likeCount
     */
    public function __construct(
        UserId $userId,
        TweetId $tweetId,
        AuthorId $authorId,
        LikeCount $likeCount
    )
    {
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
}
