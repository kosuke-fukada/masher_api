<?php
declare(strict_types=1);

namespace App\Usecases\Like\GetLikeCount;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorId;
use App\Interfaces\Usecases\Like\GetLikeCount\GetLikeCountInputPort;

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
     * @var AuthorId
     */
    private AuthorId $authorId;

    /**
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     */
    public function __construct(
        UserId $userId,
        TweetId $tweetId,
        AuthorId $authorId
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
     * @return AuthorId
     */
    public function authorId(): AuthorId
    {
        return $this->authorId;
    }
}
