<?php
declare(strict_types=1);

namespace App\Usecases\Like\UpdateLikeCount;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Like\LikeIdentifier;
use App\Interfaces\Usecases\Like\UpdateLikeCount\UpdateLikeCountInputPort;

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
     * @var AuthorId
     */
    private AuthorId $authorId;

    /**
     * @var LikeCount
     */
    private LikeCount $likeCount;

    /**
     * @param LikeIdentifier $likeIdentifier
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param LikeCount $likeCount
     */
    public function __construct(
        LikeIdentifier $likeIdentifier,
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
