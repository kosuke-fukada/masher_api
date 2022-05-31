<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Like\CreateLikeCount;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Like\LikeIdentifier;

interface CreateLikeCountInputPort
{
    /**
     * @return LikeIdentifier|null
     */
    public function likeIdentifier(): ?LikeIdentifier;

    /**
     * @return UserId
     */
    public function userId(): UserId;

    /**
     * @return TweetId
     */
    public function tweetId(): TweetId;

    /**
     * @return AuthorId
     */
    public function authorId(): AuthorId;

    /**
     * @return LikeCount
     */
    public function likeCount(): LikeCount;
}
